<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        // dd('visit view');

        return view('admin.visit.index');
    }
}
