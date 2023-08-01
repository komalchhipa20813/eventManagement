<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'event_id')->where('status',1);
    }
}
