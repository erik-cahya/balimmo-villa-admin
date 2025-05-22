<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // dd($this->data['properties']);

        return $this->subject('Contoh Notifikasi')
                    ->view('emails.notifikasi', $this->data);
                    // ->with(['nama' => $this->data['name'], 'villaData' => $this->data['villaData']]);
    }
}
