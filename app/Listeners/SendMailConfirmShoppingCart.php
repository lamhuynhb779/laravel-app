<?php

namespace App\Listeners;

use App\Events\OrderShoppingCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// Implement Interface ShouldQueue để đưa các listener vào queue đối với những task tốn time xử lý
class SendMailConfirmShoppingCart implements ShouldQueue
// class SendMailConfirmShoppingCart
{

    /**
     * The number of times the queued listener may be attempted.
     *
     * @var int
     */
    // public $tries = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShoppingCart  $event
     * @return void
     */
    public function handle(OrderShoppingCart $event)
    {
        // Access the order using $event->order...
        echo "<script>console.log(" . ($event->getOrder()) . ");</script>";

    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\OrderShipped  $event
     * @param  \Throwable  $exception
     * @return void
     */
    // public function failed(OrderShipped $event, $exception)
    // {
    //     //
    // }

    /**
     * Determine the time at which the listener should timeout.
     *
     * @return \DateTime
     */
    // public function retryUntil()
    // {
    //     return now()->addMinutes(5);
    // }
}
