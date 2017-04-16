<?php

use App\Habit;
use App\Reason;
use Illuminate\Database\Seeder;

class UsersAndHabitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'email' => 'henri.erilaid@gmail.com',
            'name' => 'Henri'
        ]);

        /*  ->each(function ($user) {

            foreach (App\Habit::recommendedHabits() as $habitData) {
                $model = $user->habits()->save(factory(App\Habit::class)->make([
                    'name' => $habitData['name']
                ]));


                foreach($habitData['reasons'] as $reason) {
                    $model->reasons()->save(factory(App\Reason::class)->make(
                        ['name' => $reason]));
                }
            }

        });*/

    }
}
