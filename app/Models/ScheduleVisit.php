<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleVisit extends Model
{
    use SoftDeletes;

    protected $table = 'schedule_visits';

    protected $fillable = [
        'tenant_id',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'move_in_date',
        'preferred_communication',
        'availability',
        'message',
    ];

    protected $casts = [
        'move_in_date' => 'date',
        'preferred_communication' => 'array',
        'availability' => 'array',
    ];
}
