<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function index(){

        $data['data_agent'] = User::orderByRaw("id = ? DESC", [Auth::user()->id])
        ->get();

        $data['count_agent'] = User::count();

        return view('admin.agent.index', $data);
    }
}
