<?php

namespace Tests\Feature\Livewire\Award;

use App\Http\Livewire\Award\NomineesAwardList;
use App\Models\Ballot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NomineesAwardListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $this->seed();

        $response = $this->get(route('awards.dashboard'))
                    ->assertStatus(200);

        Livewire::test(NomineesAwardList::class);
    }

    /** @test */
    public function the_award_nominee_can_be_deleted()
    {
        $this->seed();

        $total_nominees = Ballot::awardNominees()->count();
        $nominee = Ballot::awardNominees()->first();

        Livewire::test(NomineesAwardList::class)
                ->call('confirmDelete', $nominee->id)
                ->assertSet('selected_record_id', $nominee->id)
                ->assertDispatchedBrowserEvent('delete-notify', ['action' => 'removeSelectedNominee'])
                ->call('deleteRecord')
                ->assertDispatchedBrowserEvent('display-notification', ['message' => 'Award nominee has been delete successfully'])
                ->assertSet('selected_record_id', '');

                $this->assertNotEquals($total_nominees, Ballot::awardNominees()->count());
    }
}
