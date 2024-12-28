<?php

namespace App\Observers;

use App\Models\AdminNotification;
use App\Models\Order;

class OrderAdd
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
         AdminNotification::create([
           'title' => "new order",
            'body' => $order->order,
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'read' => 0
        ]);
        // $notiy->saveQuietly();
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
