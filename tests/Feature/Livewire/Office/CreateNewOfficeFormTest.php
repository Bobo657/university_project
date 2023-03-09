<?php

namespace Tests\Feature\Livewire\Office;

use App\Http\Livewire\Office\CreateNewOfficeForm;
use App\Models\Office;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateNewOfficeFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        Livewire::test(CreateNewOfficeForm::class)
        ->assertStatus(200);
    }

    /** @test */
    public function user_can_create_new_award()
    {
        Livewire::test(CreateNewOfficeForm::class)
        ->set('name', 'Best Couple Office')
        ->call('createOffice')
        ->assertDispatchedBrowserEvent('display-notification', [
            'message' => 'Office has been created successfully'
        ])
        ->assertEmitted('office_updated');

        $this->assertEquals(1, Office::count());
    }

    /** @test */
    public function validate_office_creation_fields()
    {
        Office::factory()->create(['name' => 'Best Couple Office']);

        Livewire::test(CreateNewOfficeForm::class)
        ->set('name', 'Best Couple Office')
        ->call('createOffice')
        ->assertHasErrors(['name' => 'unique'])
        ->set('name', '')
        ->call('createOffice')
        ->assertHasErrors(['name' => 'required']);
    }
}
