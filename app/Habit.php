<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    public function days() {
        return $this->belongsToMany(Day::class)->withPivot(['fulfilled']);
    }

    public function daysFulfilled() {
        return $this->belongsToMany(Day::class)->where('fulfilled', true)->withPivot(['fulfilled']);
    }

    public function toArray() {

        return [
            'name' => $this->name,
            'started' => $this->created_at->timestamp,
            'points' => $this->points,
            'daysCount' => $this->days_count,
            'consistency' => $this->calculateConsistency(),
            'totalPoints' => $this->calculateTotalPoints()
        ];
    }



    public function calculateConsistency() {
        return $this->days_count > 0 ? round($this->days_fulfilled_count / $this->days_count, 2) : 0;
    }

    public function calculateTotalPoints() {
        return $this->points * $this->days_fulfilled_count;
    }
}
