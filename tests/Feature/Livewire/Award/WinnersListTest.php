<?php

namespace Tests\Feature\Livewire\Award;

use App\Http\Livewire\Award\WinnersList;
use App\Models\Ballot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class WinnersListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $this->seed();

        Livewire::test(WinnersList::class)
        ->assertStatus(200);
    }

    public function user_can_declare_winner_ongoing_election()
    {
        $this->seed();

        Livewire::test(WinnersList::class)
        ->assertDontSeeHtml('Get election winners')
        ->set('election_ongoing', true)
        ->assertSeeHtml('Get election winners');
    }


   
}
