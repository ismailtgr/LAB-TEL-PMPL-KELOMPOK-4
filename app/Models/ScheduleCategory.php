<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}