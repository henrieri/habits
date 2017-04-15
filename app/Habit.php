<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{

    protected $fillable = [
        'name', 'description', 'points'
    ];

    protected $appends = [
        'consistency', 'started', 'totalPoints', 'daysDone'
    ];

    protected $hidden = [
        'reasons'
    ];

    public function days() {
        return $this->belongsToMany(Day::class)->withPivot(['fulfilled']);
    }

    public function daysFulfilled() {
        return $this->belongsToMany(Day::class)->where('fulfilled', true)->withPivot(['fulfilled']);
    }

    public function getConsistencyAttribute() {
        return $this->calculateConsistency();
    }

    public function getTotalPointsAttribute() {
        return $this->calculateTotalPoints();
    }

    public function getStartedAttribute() {
        return $this->created_at->timestamp;
    }

    public function getDaysDoneAttribute() {
        return $this->days_count;
    }
    
    public function calculateConsistency() {
        return $this->days_count > 0 ? round($this->days_fulfilled_count / $this->days_count, 2) : 0;
    }

    public function calculateTotalPoints() {
        return $this->points * $this->days_fulfilled_count;
    }

    public function reasons() {
        return $this->hasMany(Reason::class);
    }
}
