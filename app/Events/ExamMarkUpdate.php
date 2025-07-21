<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Exam;
use App\ClassRoom;

class ExamMarkUpdate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $exam;
    public $class_room;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Exam $exam, ClassRoom $class_room)
    {
        $this->exam = $exam;
        $this->class_room = $class_room;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
