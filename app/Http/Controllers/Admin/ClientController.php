<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\PropertyLeadsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clientEmails = ClientModel::pluck('email')->toArray();

        // dd($clientEmails);

        // If Master : get all data
        $data['data_client'] = Auth::user()->role == 'Master'
            ? ClientModel::get()
            : ClientModel::where('reference_code', Auth::user()->reference_code)->get();

        $rawDataLeads = Auth::user()->role == 'Master'
            ? PropertyLeadsModel::whereNotIn('cust_email', $clientEmails)->where('prospect_status', 1)->get()->groupBy('cust_email')

            : PropertyLeadsModel::whereNotIn('cust_email', $clientEmails)
            ->where('agent_code', Auth::user()->reference_code)->where('prospect_status', 1)->get()->groupBy('cust_email');

        $finalData = [];

        foreach ($rawDataLeads as $email => $leads) {
            $lead = $leads->first();

            $finalData[] = [
                'id' => $lead->id,
                'cust_name' => $lead->cust_name,
                'cust_email' => $lead->cust_email,
                'cust_telp' => $lead->cust_telp,
            ];
        }

        $data['data_leads'] = collect($finalData);

        return view('admin.clients.index', $data);
    }

    public function store(Request $request)
    {
        // dd(Auth::user()->reference_code);

        $request->validate([
            'client_name' => 'required',
            'client_email' => 'required|unique:property_client,email',
            'client_phone' => 'required',

        ]);
        $nameParts = explode(' ', $request->client_name);
        $firstName = array_shift($nameParts);
        $lastName  = implode(' ', $nameParts);

        // Jika lastName kosong, gunakan firstName sebagai lastName
        if (empty($lastName)) {
            $lastName = $firstName;
        }

        ClientModel::create([
            'reference_code' => Auth::user()->reference_code,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $request->client_email,
            'phone_number' => $request->client_phone,
        ]);

        $flashData = [
            'judul' => 'Add New Client Success',
            'pesan' => 'New Client successfully added',
            'swalFlashIcon' => 'success',
        ];

        return back()->with('flashData', $flashData);
    }

    public function update(Request $request, $id)
    {
        ClientModel::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        $flashData = [
            'judul' => 'Edit Success',
            'pesan' => 'Data Client Edited Successfully',
            'swalFlashIcon' => 'success',
        ];

        return redirect()->route('clients.index')->with('flashData', $flashData);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $data_client = ClientModel::when($query, function ($q) use ($query) {
            $q->where(function ($q2) use ($query) {
                $q2->where('first_name', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            });
        })
            ->get();

        return view('admin.clients.partials.data-clients', compact('data_client'))->render();
    }

    public function dataFromLeads(Request $request)
    {
        if ($request->leadsData === null) {
            return back()->withErrors(['dataLeads' => 'Please Check Data Leads']);
        }
        foreach ($request->leadsData as $leads) {
            $dataLeads = PropertyLeadsModel::where('id', $leads)->first();

            $fullName = $dataLeads->cust_name;
            $parts = explode(" ", $fullName);

            $firstName = array_shift($parts);
            $lastName = implode(" ", $parts);

            ClientModel::create([
                'reference_code' => Auth::user()->reference_code,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $dataLeads->cust_email,
                'phone_number' => $dataLeads->cust_telp,
            ]);

            PropertyLeadsModel::destroy($dataLeads->id);
        }

        $flashData = [
            'judul' => 'Add New Client Success',
            'pesan' => 'New Client successfully added',
            'swalFlashIcon' => 'success',
        ];

        return back()->with('flashData', $flashData);
    }


    public function destroy($id)
    {
        ClientModel::destroy($id);

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Data Client Deleted Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }
}
