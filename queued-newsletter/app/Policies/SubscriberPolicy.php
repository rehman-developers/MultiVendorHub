<?php
// app/Policies/SubscriberPolicy.php

namespace App\Policies;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubscriberPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Subscriber $subscriber): bool
    {
        return $user->id === $subscriber->user_id;
    }
}