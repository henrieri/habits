<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function habits() {
        return $this->hasMany(Habit::class);
    }

    public static function boot()
    {
        static::created(function ($user) {

            foreach (Habit::recommendedHabits() as $habitData) {
                $model = $user->habits()->save(factory(Habit::class)->make([
                    'name' => $habitData['name']
                ]));


                foreach($habitData['reasons'] as $reason) {
                    $model->reasons()->save(factory(Reason::class)->make(
                        ['name' => $reason]));
                }
            }

        });


        parent::boot();
    }
}
