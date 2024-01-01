<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'event_id',
        'creator_id',
        'attendee1_id',
        'attendee2_id',
        'meeting_link'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function attendee1()
    {
        return $this->belongsTo(User::class, 'attendee1_id');
    }
    public function attendee2()
    {
        return $this->belongsTo(User::class, 'attendee2_id');
    }

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];
}
