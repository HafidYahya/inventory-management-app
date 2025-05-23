<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RfidTagScanned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tagData;

    public function __construct($tagData)
    {
        $this->tagData = $tagData;
    }

    public function broadcastOn()
    {
        return new Channel('rfid-channel');
    }

    public function broadcastAs()
    {
        return 'tag.scanned';
    }
}