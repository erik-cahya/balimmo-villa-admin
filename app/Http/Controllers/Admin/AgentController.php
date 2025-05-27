<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AgentController extends Controller
{
    private function checkMasterRole()
    {
        if (Auth::check() && Auth::user()->role == 'Agent') {
            return redirect()->route('dashboard.index');
        }
    }

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

    public function store(Request $request)
    {

        // dd($request->role);
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone_number' => 'required',
            'role' => 'required',
            'initial_name' => 'required',
        ]);

        do {
            $reference_code = $request->role == 'Master' ? 'BPM-' .  Str::upper($request->initial_name) . '-' . random_int(1000, 9999) : 'BPA-' .  Str::upper($request->initial_name) . '-' . random_int(1000, 9999);
        } while (User::where('reference_code', $reference_code)->exists());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'reference_code' => $reference_code,
            'role' => strtolower($request->role),
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
        User::destroy($id);
        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Delete Agent Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
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
}
