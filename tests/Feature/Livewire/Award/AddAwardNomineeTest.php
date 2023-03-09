<?php

namespace Tests\Feature\Livewire\Award;

use App\Http\Livewire\Award\AddAwardNominee;
use App\Models\Award;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AddAwardNomineeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
       Livewire::test(AddAwardNominee::class)
       ->assertStatus(200);
    }

    /** @test */
    public function the_user_can_add_award_nominee()
    {
        $this->seed();
        $user = User::inRandomOrder()->get()->first();
        $awards = Award::inRandomOrder()->get();
        $award = $awards->first();
        
        $nominees = $award->ballots()->count();

        Livewire::test(AddAwardNominee::class)
        ->assertStatus(200)
        ->emit('addNominee', $award->id)
        ->assertSet('award', $award)
        ->assertSet('showModal', true)
        ->set('reg_no', $user->reg_no)
        ->call('addNominee')
        ->assertDispatchedBrowserEvent('display-notification', ['message' => 'Student has been added as successfully']);

        $nominees += 1;
        $award->ballots->count();
        $this->assertEquals($nominees,  $award->ballots->count());
    }

    /** @test */
    public function the_nominee_add_form_will_be_validated()
    {
        $this->seed();
        $awards = Award::inRandomOrder()->get();
        $award = $awards->first();

        Livewire::test(AddAwardNominee::class)
        ->emit('addNominee', $award->id)
        ->assertSet('award', $award)
        ->assertSet('showModal', true)
        ->set('reg_no', '')
        ->call('addNominee')
        ->assertHasErrors(['reg_no' => 'required'])
        ->set('reg_no', '657747')
        ->call('addNominee')
        ->assertHasErrors(['reg_no']);
    }
}
 