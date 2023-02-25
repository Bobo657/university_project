<?php

namespace Tests\Feature\Livewire\Student;

use App\Http\Livewire\Student\RegisteredStudentsList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegisteredStudentsListTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(RegisteredStudentsList::class);

        $this->get('/registered/students')->assertSeeLivewire('student.registered-students-list');
        $component->assertStatus(200);
    }
}
