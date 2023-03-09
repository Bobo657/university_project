<?php

namespace Tests\Feature\Livewire\Semester;

use App\Http\Livewire\Semester\SemesterLevelDues;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SemesterLevelDuesTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(SemesterLevelDues::class);

        $component->assertStatus(200);
    }
}
