<?php

namespace Tests\Feature\Livewire\Student;

use App\Http\Livewire\Student\StudentProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StudentProfileTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(StudentProfile::class);

        $component->assertStatus(200);
    }
}
