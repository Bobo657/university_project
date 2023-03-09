<?php

namespace Tests\Feature\Livewire\Semester;

use App\Http\Livewire\Semester\CreateNewSemesterForm;
use App\Models\DuesSemester;
use App\Models\Semester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateNewSemesterFormTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(CreateNewSemesterForm::class);

        $component->assertStatus(200);
    }

     /** @test */
    public function the_user_can_create_new_semester()
    {
        $component = Livewire::test(CreateNewSemesterForm::class)
                      ->set('duration', '2021 - 2022')
                      ->set('dues.100', '2000')
                      ->set('dues.200', '2000')
                      ->set('dues.300', '2000')
                      ->set('dues.400', '2000')
                      ->set('dues.500', '2000')
                      ->call('createSemester');

        $this->assertEquals('1', Semester::count());
        $this->assertEquals('5', DuesSemester::count());
    }

     /** @test */
     public function the_dues_is_required_new_semester()
     {
        Livewire::test(CreateNewSemesterForm::class)
        ->set('duration', '2021 - 2022')
        ->set('dues.100', '')
        ->set('dues.200', '')
        ->set('dues.300', '')
        ->set('dues.400', '')
        ->set('dues.500', '')
        ->call('createSemester')
        ->assertHasErrors(['dues.100', 'dues.200', 'dues.300', 'dues.400', 'dues.500' ]);       
    }

    /** @test */
    public function test_the_validation_duration_new_semester()
    {
        Semester::factory()->create(['duration'  => '2021 - 2022']);

        Livewire::test(CreateNewSemesterForm::class)
        ->set('duration', '')
        ->call('createSemester')
        ->assertHasErrors(['duration' => 'required'])
        ->set('duration', '2021 - 2022')
        ->call('createSemester')
        ->assertHasErrors(['duration' => 'unique'])
        ->set('duration', '2021 - ')
        ->call('createSemester')
        ->assertHasErrors('duration');
    }
} 
