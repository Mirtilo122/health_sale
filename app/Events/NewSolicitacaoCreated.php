<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;


class NewSolicitacaoCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $status;
    public $count;

    public function __construct($status, $count)
    {
        $this->status = $status;
        $this->count = $count;
    }

    public function broadcastOn()
    {
        return new Channel('solicitacoes');
    }
}
