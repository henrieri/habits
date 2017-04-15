<?php


use App\Habit;
use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    public function run()
    {
        $daysToFill = 7;

        $habits = Habit::all();

        for ($i = 0; $i < $daysToFill; $i++) {

            $day = factory(App\Day::class)->create([

                'day' => now()->subDays($daysToFill - $i)

            ]);

            foreach ($habits as $habit) {
                $day->habits()->attach($habit, [
                    'fulfilled' => rand(0, 1)
                ]);
            }

        }
    }
    

}