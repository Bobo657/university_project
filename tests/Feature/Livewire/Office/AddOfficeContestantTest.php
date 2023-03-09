<?php

namespace Tests\Feature\Livewire\Office;

use App\Http\Livewire\Office\AddOfficeContestant;
use App\Models\Office;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AddOfficeContestantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        Livewire::test(AddOfficeContestant::class)
        ->assertStatus(200);
    }

    /** @test */
    public function the_user_can_add_office_nominee()
    {
        $this->seed();
        $user = User::inRandomOrder()->get()->first();
        $offices = Office::inRandomOrder()->get();
        $office = $offices->first();

        $contestants = $office->ballots()->count();

        Livewire::test(AddOfficeContestant::class)
        ->assertStatus(200)
        ->emit('addContestant', $office->id)
        ->assertSet('office', $office)
        ->assertSet('showModal', true)
        ->set('reg_no', $user->reg_no)
        ->call('addContestant')
        ->assertDispatchedBrowserEvent('display-notification', ['message' => 'Student has been added as successfully']);

        $contestants += 1;
        $office->ballots->count();
        $this->assertEquals($contestants, $office->ballots->count());
    }

    /** @test */
     public function the_nominee_add_form_will_be_validated()
     {
         $this->seed();
         $offices = Office::inRandomOrder()->get();
         $office = $offices->first();

         Livewire::test(AddOfficeContestant::class)
         ->emit('addContestant', $office->id)
         ->assertSet('office', $office)
         ->assertSet('showModal', true)
         ->set('reg_no', '')
         ->call('addContestant')
         ->assertHasErrors(['reg_no' => 'required'])
         ->set('reg_no', '657747')
         ->call('addContestant')
         ->assertHasErrors(['reg_no']);
     }
}
