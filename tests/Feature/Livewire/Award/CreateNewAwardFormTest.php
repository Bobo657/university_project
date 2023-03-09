<?php

namespace Tests\Feature\Livewire\Award;

use App\Http\Livewire\Award\CreateNewAwardForm;
use App\Models\Award;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateNewAwardFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        Livewire::test(CreateNewAwardForm::class)
        ->assertStatus(200);
    }

    /** @test */
    public function user_can_create_new_award()
    {
        Livewire::test(CreateNewAwardForm::class)
        ->set('name', 'Best Couple Award')
        ->call('createAward')
        ->assertDispatchedBrowserEvent('display-notification', [
            'message' => 'Award has been created successfully'
        ])
        ->assertEmitted('award_updated');

        $this->assertEquals(1, Award::count());
    }

    /** @test */
    public function validate_award_creation_fields()
    {
        Award::factory()->create(['name' => 'Best Couple Award']);

        Livewire::test(CreateNewAwardForm::class)
        ->set('name', 'Best Couple Award')
        ->call('createAward')
        ->assertHasErrors(['name' => 'unique'])
        ->set('name', '')
        ->call('createAward')
        ->assertHasErrors(['name' => 'required']);
    }
}
