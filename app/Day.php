<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{

    protected $fillable = [
        'day'
    ];

    public function habits() {
        return $this->belongsToMany(Habit::class);
    }

    public static function today() {

        $today = now()->toDateString();

        return self::firstOrCreate([
            'day' => $today
        ]);

    }
}
