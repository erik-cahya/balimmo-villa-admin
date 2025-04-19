<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {
        Mail::to('erikcp38@gmail.com')->send(new NotifikasiEmail([
            'nama' => 'John Doe'
        ]));

        return "Email terkirim!";
    }
}