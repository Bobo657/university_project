<?php

namespace Tests\Feature\Livewire\Semester;

use App\Http\Livewire\Semester\CreatedSemestersList;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreatedSemestersListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(CreatedSemestersList::class);
        $component->assertStatus(200);
    }

    /** @test */
    public function the_component_display_created_semesters()
    {
        $semesters = $this->generate_semesters();
        
        Livewire::test(CreatedSemestersList::class)
                    ->assertSee($semesters->first()->duration)
                    ->assertSee($semesters->first()->color)
                    ->assertSee($semesters->first()->created_at->format('d F Y'))
                    ->assertStatus(200);

                    $this->assertEquals('2', $semesters->count());
    }

    private function generate_semesters(){
        return  Semester::factory(2)->state(new Sequence(
            ['duration' => '2010 - 2011', 'current' => false], 
            ['duration' => '2011 - 2012']
        ))->create();
    }
}
