<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Office\Contestants;
use App\Models\Ballot;

class ContestantsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function the_component_can_render()
    {
        $this->seed();

        $response = $this->get(route('awards.dashboard'))
                    ->assertStatus(200);

        Livewire::test(Contestants::class)
        ->assertStatus(200);
    }

    /** @test */
    public function the_award_nominee_can_be_deleted()
    {
        $this->seed();

        $total_nominees = Ballot::contestants()->count();
        $nominee = Ballot::contestants()->first();

        Livewire::test(Contestants::class)
                ->call('confirmDelete', $nominee->id)
                ->assertSet('selected_record_id', $nominee->id)
                ->assertDispatchedBrowserEvent('delete-notify', ['action' => 'removeSelectedContestant'])
                ->call('deleteRecord')
                ->assertDispatchedBrowserEvent('display-notification', ['message' => 'Office contestants has been delete successfully'])
                ->assertSet('selected_record_id', '');

        $this->assertNotEquals($total_nominees, Ballot::contestants()->count());
    }
}
