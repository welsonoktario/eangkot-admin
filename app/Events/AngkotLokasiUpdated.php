<?php

namespace App\Events;

use App\Models\Angkot;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AngkotLokasiUpdated implements ShouldBroadcastNow
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
        return new PresenceChannel("angkot.{$this->angkot->id}");
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'angkot' => $this->angkot->toArray()
        ];
    }

    /**
     * The model event's broadcast name.
     *
     * @param  string  $event
     * @return string|null
     */
    public function broadcastAs()
    {
        return 'angkot.lokasi-updated';
    }
}
