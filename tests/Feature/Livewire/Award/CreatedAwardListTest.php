<?php

namespace Tests\Feature\Livewire\Award;

use App\Http\Livewire\Award\CreatedAwardList;
use App\Models\Award;
use App\Models\Ballot;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreatedAwardListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $this->seed();
        $award = Award::inRandomOrder()->get()->first();
        
        Livewire::test(CreatedAwardList::class)
        ->assertStatus(200)
        ->assertSee($award->name);
    }

     /** @test */
    public function user_can_delete_award()
    {
        $this->seed();

        $total = Award::count();
        $award = Award::inRandomOrder()->get()->first();
        
        $livewire = Livewire::test(CreatedAwardList::class)
                    ->call('confirmDelete', $award->id)
                    ->assertSet('selected_record_id', $award->id)
                    ->assertDispatchedBrowserEvent('delete-notify', ['action' => 'removeSelectedAward'])
                    ->emit('removeSelectedAward')
                    ->assertSet('selected_record_id', '')
                    ->assertDispatchedBrowserEvent('display-notification', [
                        'message' => 'Award has been delete successfully'
                    ]);

        $this->assertNotEquals($total, Award::count());
    }
}
