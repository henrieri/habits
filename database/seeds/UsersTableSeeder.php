<?php

use App\Habit;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
        ])->each( function($user) {
            for ($i = 0; $i < 5; $i++) {
                $user->habits()->save(factory(App\Habit::class)->make());
            }
        });

        $daysToFill = 7;

        $habits = Habit::all();

        for ($i = 0; $i < $daysToFill; $i++) {

            $day = factory(App\Day::class)->create([

                'day' => now()->subDays($daysToFill - $i)

            ]);

            foreach($habits as $habit) {
                $day->habits()->attach($habit, [
                    'fulfilled' => rand(0,1)
                ]);
            }

        }
    }
}
