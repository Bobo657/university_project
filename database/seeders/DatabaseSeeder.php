<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\User;
use App\Models\AcademicRecord;
use App\Models\AcademicSession;
use App\Models\Award;
use App\Models\Office;
use App\Models\Contestant;
use App\Models\Vote;
use Database\Seeders\AcademicSessionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AcademicSessionSeeder::class);

        $academicsessions = AcademicSession::all();

        User::factory(100)
        ->create()
        ->each(function ($user) use ($academicsessions) {
            foreach ($academicsessions as $academicsession) {
                AcademicRecord::factory()->create([
                    'academic_session_id' => $academicsession->id,
                    'user_id' => $user->id,
                    'dues' => 2900
                ]);
            }
        });

        Office::factory()
        ->count(4)
        ->state(new Sequence(
            ['name' => 'President'],
            ['name' => 'Vice President'],
            ['name' => 'Social'],
            ['name' => 'Games'],
        ))
        ->create()
        ->each(function ($office) {
            Contestant::factory()
            ->count(4)
            ->state(new Sequence(
                ['user_id' => random_int(1, 100)],
                ['user_id' => random_int(1, 100)],
                ['user_id' => random_int(1, 100)],
            ))
            ->create([
                'contestantable_type' => 'office',
                'contestantable_id' => $office->id
            ])
            ->each(function ($contestant) {
                $no = random_int(40, 100);
                Vote::factory()->count($no)->create([
                    'contestant_id' => $contestant->id
                ]);
            });
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
            Contestant::factory()
            ->count(3)
            ->state(new Sequence(
                ['user_id' => random_int(1, 100)],
                ['user_id' => random_int(1, 100)],
                ['user_id' => random_int(1, 100)],
            ))
            ->create([
                'contestantable_type' => 'award',
                'contestantable_id' => $award->id
            ])->each(function ($contestant) {
                $no = random_int(40, 100);
                Vote::factory()->count($no)->create([
                    'contestant_id' => $contestant->id
                ]);
            });
        });
    }
}
