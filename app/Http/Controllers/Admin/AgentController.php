<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index(){

        $data['data_agent'] = User::get();
        return view('admin.agent.index', $data);
    }
}
