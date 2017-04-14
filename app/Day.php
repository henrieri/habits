<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function habits() {
        return $this->belongsToMany(Habit::class);
    }
}
