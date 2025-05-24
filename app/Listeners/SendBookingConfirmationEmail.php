<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingConfirmationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking;
        Mail::to($booking->cust_email)->send(new BookingConfirmationEmail($booking));
    }
}
