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
        $data['data_client'] = ClientModel::get();


        $clientEmails = ClientModel::pluck('email')->toArray();


        $data['data_leads'] = PropertyLeadsModel::whereNotIn('cust_email', $clientEmails)->where('agent_code', Auth::user()->reference_code)->get();
        return view('admin.clients.index', $data);
    }

    public function store(Request $request)
    {
        // dd(Auth::user()->reference_code);
        ClientModel::create([
            'reference_code' => Auth::user()->reference_code,
            'first_name' => $request->client_first_name,
            'last_name' => $request->client_last_name,
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
        }

        $flashData = [
            'judul' => 'Add New Client Success',
            'pesan' => 'New Client successfully added',
            'swalFlashIcon' => 'success',
        ];

        return back()->with('flashData', $flashData);
    }
}
