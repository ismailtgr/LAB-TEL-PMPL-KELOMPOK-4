<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ScheduleCategory;

class Schedule extends Model
{
    protected $fillable = [
        'title',
        'schedule_category_id',
        'description',
        'instructor',
        'date',
        'start_time',
        'end_time',
        'student_count',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(ScheduleCategory::class, 'schedule_category_id');
    }
}
