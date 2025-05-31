<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {


        $data['data_agent'] = User::where('role', 'agent',)->select('name', 'created_at', 'email', 'profile', 'reference_code')->orderBy('created_at', 'ASC')->get();

        if (Auth::user()->role == 'Master') {
            $data['data_leads'] = PropertyLeadsModel::get();

            $data['data_properties'] = PropertiesModel::join('users', 'users.reference_code', '=', 'properties.internal_reference')
                ->select(
                    'users.reference_code',
                    'users.name',
                    'users.profile',
                    'properties.property_code',
                    'properties.property_name',
                    'properties.property_slug',
                    'properties.region',
                    'properties.type_acceptance',
                    'properties.created_at',
                )->get();
        } else {
            $data['data_leads'] = PropertyLeadsModel::where('agent_code', Auth::user()->reference_code)
                ->get();

            $data['data_properties'] = PropertiesModel::where('internal_reference', Auth::user()->reference_code)->join('users', 'users.reference_code', '=', 'properties.internal_reference')
                ->select(
                    'users.reference_code',
                    'users.name',
                    'users.profile',
                    'properties.property_code',
                    'properties.property_name',
                    'properties.property_slug',
                    'properties.region',
                    'properties.type_acceptance',
                    'properties.created_at',
                )->get();
        }
        return view('admin.dashboard.index', $data);
    }
}
