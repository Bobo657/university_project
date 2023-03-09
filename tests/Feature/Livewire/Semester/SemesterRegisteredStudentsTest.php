<?php

namespace Tests\Feature\Livewire\Semester;

use App\Http\Livewire\Semester\SemesterRegisteredStudents;
use App\Models\SemesterStudent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SemesterRegisteredStudentsTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function the_component_can_render()
    {
        $this->seed();

        $component = Livewire::test(SemesterRegisteredStudents::class)
                     ->assertStatus(200);

        $response = $this->get('/semseters/registered/students')->assertStatus(200);
                    $this->assertEquals('50', SemesterStudent::count());
    }

     /** @test */
     public function the_user_delete_student()
     {
        $this->seed();

        $total  =  SemesterStudent::count();

         $component = Livewire::test(SemesterRegisteredStudents::class)
                     ->call('confirmDelete', 1)
                     ->assertSet('selected_record_id', 1)
                     ->assertDispatchedBrowserEvent('delete-notify', ['action' => 'removeSelectedStudentFromSemester'])
                     ->emit('removeSelectedStudentFromSemester')
                     ->assertDispatchedBrowserEvent('display-notification');
 
         $this->assertEquals($total - 1, SemesterStudent::count());
     }
 

     /** @test */
     public function the_user_can_reset_all_search_filters()
     {
        $this->seed();
         $Livewire = Livewire::test(SemesterRegisteredStudents::class)
                     ->set('from_date', '2023-07-01')
                     ->assertSet('from_date', '2023-07-01')
                     ->set('to_date', '2023-07-01')
                     ->assertSet('to_date', '2023-07-01')
                     ->set('level', '100')
                     ->assertSet('level', '100')
                     ->set('selected_semester_id', '1')
                     ->assertSet('selected_semester_id', '1')
                     ->set('search', 'john doe')
                     ->assertSet('search', 'john doe')
                     ->call('resetParameters');
         
         $Livewire->assertSet('selected_semester_id', null)
                 ->assertSet('search', null)
                 ->assertSet('from_date', null)
                 ->assertSet('to_date', null)
                 ->assertSet('level', null);
     }

     /** @test */
    public function the_list_level_search_field_is_working()
    {
        $this->seed();

        Livewire::test(SemesterRegisteredStudents::class)
        ->set('level', '100')
        ->assertSet('level', '100')
        ->assertDontSeeHtml('<td class="whitespace-nowrap px-4 py-3 sm:px-5">300Level</td>');
    }

     /** @test */
     public function the_list_payment_status_select_filter_is_working()
     {
         $this->seed();
 
         Livewire::test(SemesterRegisteredStudents::class)
         ->set('has_paid', '0')
         ->assertSet('has_paid', '0')
         ->assertDontSeeHtml('<div class="badge bg-success/10 text-success dark:bg-success/15">Paid</div>');
     }

     /** @test */
     public function the_list_semester_select_filter_is_working()
     {
         $this->seed();
 
         Livewire::test(SemesterRegisteredStudents::class)
         ->set('selected_semester_id', '1')
         ->assertSet('selected_semester_id', '1')
         ->assertDontSeeHtml('<td class="whitespace-nowrap px-4 py-3 sm:px-5">2011 - 2012 </td>');
     }


     
}
