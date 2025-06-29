<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotaryController extends Controller
{
    public function index()
    {
        $data['data_notary'] = User::where('role', 'Notary')->get();
        return view('admin.notary.index', $data);
    }
}
