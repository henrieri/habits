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
        ])->each(function ($user) {

            foreach ($this->recommendedHabits() as $habitData) {
                $model = $user->habits()->save(factory(App\Habit::class)->make([
                    'name' => $habitData['name']
                ]));


                foreach($habitData['reasons'] as $reason) {
                    $model->reasons()->save(factory(App\Reason::class)->make(
                        ['name' => $reason]));
                }
            }

        });

    }

    private function recommendedHabits()
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
