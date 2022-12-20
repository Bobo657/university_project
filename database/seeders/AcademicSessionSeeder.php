<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcademicSession;

class AcademicSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademicSession::create(['duration' => '2017/2018']);

        AcademicSession::create(['duration' => '2018/2019']);

        AcademicSession::create(['duration' => '2019/2020']);
    }
}
