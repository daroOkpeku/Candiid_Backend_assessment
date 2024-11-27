<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use App\Mail\SendRegisteremail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegisterListener
{
    /**
     * Create the event listener.
     */
    public function __construct(RegisterEvent $event)
    {
        $data = [
            'name'=>$event->firstname,
            'code'=>$event->code,
            'email'=> $event->email
         ];
         Mail::to($event->email)->send(new SendRegisteremail($data));
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }
}
