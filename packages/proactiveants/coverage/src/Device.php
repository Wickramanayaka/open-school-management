<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Database\Eloquent\Model;
use App\ClassRoom;

class Device extends Model
{
    protected $fillable = ['device_id','class_room_id','online','last_sync'];

    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
