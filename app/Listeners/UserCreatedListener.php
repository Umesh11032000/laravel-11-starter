<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreatedListener
{
    public User $user;
    public mixed $password;

    /**
     * Create the event listener.
     */
    public function __construct(User $user, mixed $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $user = $event->user;
        $password = $event->password;

        $user->notify(new UserCreatedNotification($user, $password));
    }
}
