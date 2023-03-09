<?php

namespace Tests\Feature\Livewire\Vote;

use App\Http\Livewire\Vote\VotersList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VotersListTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(VotersList::class);

        $component->assertStatus(200);
    }
}
