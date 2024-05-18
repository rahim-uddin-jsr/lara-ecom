<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Mail\ProductCreatedMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendProductCreatedNotification
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
    public function handle(ProductCreated $event): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new ProductCreatedMail($event->product));
        }
    }
}
