<?php

namespace App\Events;

use App\Models\Angkot;
use App\Models\Pesanan;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PesananCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $angkot, $pesanan;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Int $angkot, Pesanan $pesanan)
    {
        $this->angkot = $angkot;
        $this->pesanan = $pesanan;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("angkot.{$this->angkot}.pesanan");
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return ['pesanan' => $this->pesanan];
    }
}
