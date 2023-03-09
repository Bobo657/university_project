<?php

namespace Tests\Feature\Livewire\Office;

use App\Http\Livewire\Office\CreatedOfficeList;
use App\Models\Office;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreatedOfficeListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $this->seed();
        $office = Office::inRandomOrder()->get()->first();

        Livewire::test(CreatedOfficeList::class)
        ->assertStatus(200)
        ->assertSee($office->name);
    }

     /** @test */
    public function user_can_delete_office()
    {
        $this->seed();
        $total = Office::count();
        $office = Office::inRandomOrder()->get()->first();

        $livewire = Livewire::test(CreatedOfficeList::class)
                    ->call('confirmDelete', $office->id)
                    ->assertSet('selected_record_id', $office->id)
                    ->assertDispatchedBrowserEvent('delete-notify', ['action' => 'removeSelectedOffice'])
                    ->emit('removeSelectedOffice')
                    ->assertSet('selected_record_id', '')
                    ->assertDispatchedBrowserEvent('display-notification', [
                        'message' => 'Office has been delete successfully'
                    ]);

        $this->assertNotEquals($total, Office::count());
    }
}
