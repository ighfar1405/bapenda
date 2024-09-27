<?php

namespace App\Events;

use App\Entity\Transaction\Skrd;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SkrdCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Entity\Transaction\Skrd
     */
    public $skrd;

    /**
     * Create a new event instance.
     *
     * @param  \App\Entity\Transaction\Skrd  $order
     * @return void
     */
    public function __construct($skrd)
    {
        $this->skrd = $skrd;
    }
}
