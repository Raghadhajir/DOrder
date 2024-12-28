<?php

namespace App\Observers;

use App\Models\User;

class UserAccountObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->isDirty('package_id') || $user->isDirty('subscription_fees')) {
            // قم بتحديث القيمة بناءً على الشرط
            if (empty($user->package_id) && empty($user->subscription_fees)) {
                $user->active = false;
            } elseif (empty($user->package_id) && ($user->subscription_fees) == 0) {
                $user->active = false;
            } else {
                $user->active = true;
            }
        }
        $user->saveQuietly();
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
