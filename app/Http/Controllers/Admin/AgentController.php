<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use App\Models\PropertyLegalModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AgentController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Master');
    }

    public function index()
    {

        // if ($redirect = $this->checkMasterRole()) {
        //     return $redirect;
        // }

        $loggedInUser = User::withCount('properties')->find(Auth::id());
        $otherUsers = User::where('id', '!=', Auth::id())->withCount('properties')->get();
        $data['data_agent'] = collect([$loggedInUser])->merge($otherUsers);

        return view('admin.agent.index', $data);
    }

    // public function index()
    // {
    //     $data_agent = User::withCount('properties')->paginate(2);
    //     return view('admin.agent.index', compact('data_agent'));
    // }

    public function store(Request $request)
    {

        // dd($request->role);
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone_number' => 'required',
            'role' => 'required',
            'initial_name' => 'required',
            'number_id' => 'required|numeric',
            'password' => 'required|confirmed|min:8',

        ]);

        // Generate number ID jika tidak diisi
        $numberID = $request->number_id == null ? random_int(1000, 99999) : $request->number_id;

        // Generate reference code
        $reference_code = $request->role == 'Master'
            ? 'BPM-' . Str::upper($request->initial_name) . '-' . $numberID
            : 'BPA-' . Str::upper($request->initial_name) . '-' . $numberID;

        // Cek apakah reference_code sudah digunakan
        if (User::where('reference_code', $reference_code)->exists()) {
            return back()
                ->withErrors(['number_id' => 'Code number already exists. Please choose a different Number ID.'])
                ->withInput();
        }


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'reference_code' => $reference_code,
            'role' => strtolower($request->role),
            'status' => 1
        ]);

        $flashData = [
            'judul' => 'Create Agent Success',
            'pesan' => 'New Agent Added Successfully',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('agent.index')->with('flashData', $flashData);
    }

    public function destroy(string $id)
    {

        // User::destroy($id);
        User::where('id', $id)->update([
            'status' => 0
        ]);

        $flashData = [
            'judul' => 'Disabled Success',
            'pesan' => 'Disabled Agent Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }

    public function reactivate($id)
    {
        User::where('id', $id)->update([
            'status' => 1
        ]);

        $flashData = [
            'judul' => 'Activation Account Success',
            'pesan' => 'Account Agent Successfully Activate',
            'swalFlashIcon' => 'success',
        ];
        return response()->json($flashData);
    }

    public function detailAgent($refcode)
    {
        // dd($refcode);
        // $user = Auth::user();

        $data['profile'] = User::where('reference_code', $refcode)->first();

        $property = PropertiesModel::where('internal_reference', $refcode)->first();

        $data['propertiesCount'] = PropertiesModel::where('internal_reference', $refcode)->count();

        $data['leaseholdCount'] = 0;
        $data['freeholdCount'] = 0;

        if ($property) {
            $propertyId = $property->id;

            $data['leaseholdCount'] = PropertyLegalModel::where('properties_id', $propertyId)
                ->where('legal_status', 'Leasehold')
                ->count();

            $data['freeholdCount'] = PropertyLegalModel::where('properties_id', $propertyId)
                ->where('legal_status', 'Freehold')
                ->count();
        }

        return view('admin.agent.detail-agent', $data);
    }

    public function agentProperty($refcode)
    {

        $data['agent_properties'] = PropertiesModel::where('internal_reference', $refcode)
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->with(['featuredImage' => function ($query) {
                $query->select('image_path', 'property_gallery.id');
                $query->where('is_featured', 1);
            }])
            ->get();

        foreach ($data['agent_properties'] as $item) {
            $item->formatted_price = $this->shortPriceIDR($item->selling_price_idr);
        }

        // dd($data['agent_properties']);
        return view('admin.agent.detail-properties', $data);
    }

    private function shortPriceIDR($priceIDR)
    {
        if ($priceIDR >= 1000000000) {
            return 'IDR ' . number_format($priceIDR / 1000000000, 1) . 'B';
        } elseif ($priceIDR >= 1000000) {
            return 'IDR ' . number_format($priceIDR / 1000000, 1) . 'M';
        } elseif ($priceIDR >= 1000) {
            return 'IDR ' . number_format($priceIDR / 1000, 0) . 'K';
        } else {
            return 'IDR ' . number_format($priceIDR, 0, ',', '.');
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $data_agent = User::when($query, function ($q) use ($query) {
            $q->where(function ($q2) use ($query) {
                $q2->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            });
        })
            ->get();

        return view('admin.agent.partials.data-agent', compact('data_agent'))->render();
    }

    // public function search(Request $request)
    // {
    //     $query = $request->get('query');
    //     $page = $request->get('page', 1);
    //     $perPage = 10;

    //     $data_agent = User::when($query, function ($q) use ($query) {
    //         $q->where(function ($q2) use ($query) {
    //             $q2->where('name', 'like', "%{$query}%")
    //                 ->orWhere('email', 'like', "%{$query}%");
    //         });
    //     })
    //         ->paginate($perPage, ['*'], 'page', $page);

    //     return view('admin.agent.partials.data-agent', compact('data_agent'))->render();
    // }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Temukan user berdasarkan reference_code
        $user = User::where('reference_code', $request->reference_code)->first();

        // dd($user->id);
        if (!$user) {
            return back()->withErrors(['user' => 'User not found']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

        // Jika user yang sedang login adalah user yang diubah
        if (Auth::id() === $user->id) {
            // Auth::logout(); // Logout user
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('flashData', [
                'judul' => 'Change Password Success',
                'pesan' => 'Agent Password successfully changed',
                'swalFlashIcon' => 'success',
            ]);
        }

        // Jika bukan user yang sedang login
        return redirect()->back()->with('flashData', [
            'judul' => 'Change Password Success',
            'pesan' => 'Agent Password successfully changed',
            'swalFlashIcon' => 'success',
        ]);
    }
}
