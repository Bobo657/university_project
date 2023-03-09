<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Award;
use App\Models\Ballot;
use App\Models\DuesSemester;
use App\Models\Office;
use App\Models\Semester;
use App\Models\SemesterStudent;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Semester::factory(1)->state(new Sequence(
            ['duration' => '2010 - 2011', 'current' => true]
        ))
        ->create()
        ->each(function ($semester) {
            $levels = Semester::STUDENT_LEVELS;

            foreach ($levels as $level) {
                DuesSemester::factory()->create([
                    'level' => $level,
                    'semester_id' => $semester->id,
                    'amount' => $level == 100 ? 2000 : 1800
                ]);
            }
        });

        \App\Models\User::factory(50)->create()
        ->each(function ($student) {
            $random_index = array_rand(Semester::STUDENT_LEVELS);
            $level = Semester::STUDENT_LEVELS[$random_index];

            SemesterStudent::factory()
            ->create([
                'user_id' => $student->id,
                'level' => $level,
                'paid' => random_int(0, 1),
                'amount' => DuesSemester::where([
                                'level' => $level,
                                'semester_id' => 1
                            ])->first()->amount
            ]);
        });

        Award::factory()
        ->count(3)
        ->state(new Sequence(
            ['name' => 'Best Dress'],
            ['name' => 'Mr Popular'],
            ['name' => 'Best Couple'],
        ))
        ->create()
        ->each(function ($award) {
            $array = [1 + $award->id, 5 + $award->id, 9 + $award->id, 20 + $award->id];

            foreach ($array as $val) {
                $ballot =  $award->ballots()->create([
                            'user_id' => $val,
                            'semester_id' => 1,
                            'ballotable_type' => 'award',
                            'ballotable_id' => $award->id
                          ]);

                $random = random_int(1, 49);
            }
        });

        \App\Models\User::all()->each(function ($user) {
            Vote::create([
                'user_id' => $user->id,
                'semester_id' => 1,
                'ballot_id' => Ballot::awardNominees()->
                                inRandomOrder()->select('id')
                                ->first()->id
            ]);
        });

        Office::factory()
        ->count(3)
        ->state(new Sequence(
            ['name' => 'President'],
            ['name' => 'Vice President'],
            ['name' => 'Director of Socials'],
        ))
        ->create()
        ->each(function ($office) {
            $array = [1 + $office->id, 30 + $office->id, 10 + $office->id, 15 + $office->id];
            foreach ($array as $val) {
                $ballot =  $office->ballots()->create([
                                'user_id' => $val,
                                'semester_id' => 1,
                                'ballotable_type' => 'office',
                                'ballotable_id' => $office->id
                           ]);

                $random = random_int(1, 49);
            }
        });

        \App\Models\User::all()->each(function ($user) {
            Vote::create([
                'user_id' => $user->id,
                'semester_id' => 1,
                'ballot_id' => Ballot::officeContestants()->
                                inRandomOrder()->select('id')
                                ->first()->id
            ]);
        });
    }
}
