<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{

    protected $fillable = [
        'name',
        'description',
        'points'
    ];

    protected $appends = [
        'consistency',
        'started',
        'totalPoints',
        'daysDone'
    ];

    protected $hidden = [
        'reasons'
    ];

    public function days()
    {
        return $this->belongsToMany(Day::class)->withPivot(['fulfilled']);
    }

    public function today()
    {

        $today = now()->toDateString();

        return $this->days()->where('day', $today);
    }

    public function daysFulfilled()
    {
        return $this->belongsToMany(Day::class)->where('fulfilled', true)->withPivot(['fulfilled']);
    }

    public function getConsistencyAttribute()
    {
        return $this->calculateConsistency();
    }

    public function getTotalPointsAttribute()
    {
        return $this->calculateTotalPoints();
    }

    public function getStartedAttribute()
    {
        return $this->created_at->timestamp;
    }

    public function getDaysDoneAttribute()
    {
        return $this->days_count;
    }

    public function calculateConsistency()
    {
        return $this->days_count > 0 ? round($this->days_fulfilled_count / $this->days_count, 2) : 0;
    }

    public function calculateTotalPoints()
    {
        return $this->points * $this->days_fulfilled_count;
    }

    public function reasons()
    {
        return $this->hasMany(Reason::class);
    }

    public static function recommendedHabits()
    {

        $recommendedHabits = [
            [
                'name' => 'Meditation',
                'reasons' =>
                    [
                        'Train your concentration',
                        'Reduce anxiety and stress',
                        'Improve ability to stay in present',
                        'Improve your future self'
                    ],
            ],
            [
                'name' => 'Exercise',
                'reasons' =>
                    [
                        'Reduce stress',
                        'Stay in shape',
                        'Clear your mind',
                        'Improve your future self'
                    ],
            ],
            [
                'name' => 'Cold shower',
                'reasons' =>
                    [
                        'Overcome a challenge',
                        'Reduce stress',
                        'Wake yourself up in the morning',
                    ],
            ],
            [
                'name' => 'Journal',
                'reasons' =>
                    [
                        'Understand yourself better',
                        'Remember and work towards your goals',
                        'Reach peace of mind by writing out your thoughts',
                        'Practice your writing skills',
                        'Have your memories written out',
                        'Reflect on how to improve your life'
                    ],
            ],
            [
                'name' => 'Read a book',
                'reasons' =>
                    [
                        'Gain knowledge',
                        'Improve concentration',
                        'Improve vocabulary',
                        'Practice your thinking capabilities'
                    ]
            ],
            [
                'name' => 'Wake up without snoozing',
                'reasons' => [
                    'Show that you are ready to face the day',
                    'Increase productive time'
                ]
            ],
            [
                'name' => 'Work on a side project',
                'reasons' => [
                    'Do something for yourself',
                    'Achieve something',
                    'Learn about new technologies',
                    'Practice coding skills',
                    'Practice entrepreneurship'
                ]
            ]
        ];

        return $recommendedHabits;

    }
}
