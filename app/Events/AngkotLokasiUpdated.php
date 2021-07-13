<?php

namespace App\Events;

use App\Models\Angkot;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AngkotLokasiUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $angkot;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Angkot $angkot)
    {
        $this->angkot = $angkot;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('angkot.' . $this->angkot->id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    /* public function broadcastWith()
    {
        return ['lokasi' => $this->angkot->lokasi];
    } */
}
