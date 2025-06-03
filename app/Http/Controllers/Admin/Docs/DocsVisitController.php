<?php

namespace App\Http\Controllers\Admin\Docs;

use App\Http\Controllers\Controller;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DocsVisitController extends Controller
{
    public function index()
    {
        // dd('visit view');

        return view('admin.docs.visit.index');
    }

    public function create()
    {
        return view('admin.docs.visit.create');
    }

    public function generateEnglishPDF()
    {
        $pdf = PDF::loadView('admin.docs.visit.pdf.english.english-pdf')->setPaper('A4', 'portrait');
        return $pdf->stream('docs.pdf');
    }
}
