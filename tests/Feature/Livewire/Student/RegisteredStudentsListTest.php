<?php

namespace Tests\Feature\Livewire\Student;

use App\Http\Livewire\Student\RegisteredStudentsList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegisteredStudentsListTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function the_component_can_render()
    {
        $users = User::factory(10)->create();

        $component = Livewire::test(RegisteredStudentsList::class)
                    ->assertSet('stats.total_students', 10);

        $response = $this->get('/registered/students');
        $response->assertStatus(200);
        $this->assertEquals('10', User::count());
    }

    /** @test */
    public function the_user_delete_student()
    {
        $users = User::factory(10)->create();
        $component = Livewire::test(RegisteredStudentsList::class)
                    ->call('confirmDelete', 1)
                    ->assertSet('selected_record_id', 1)
                    ->assertDispatchedBrowserEvent('delete-notify', ['action' => 'removeSelectedStudent'])
                    ->emit('removeSelectedStudent')
                    ->assertDispatchedBrowserEvent('display-notification');

        $this->assertEquals('9', User::count());
    }

    /** @test */
    public function the_user_can_change_user_status()
    {
        $users = User::factory(10)->create();
        $active_users = $users->where('active', 1)->first();

        $component = Livewire::test(RegisteredStudentsList::class)
                    ->call('toggleStatus', $active_users->id);

        $this->assertEquals('0', $active_users->fresh()->active);
    }

    /** @test */
    public function the_user_gender_search_field_is_working()
    {
        $users = User::factory(10)->create();
        Livewire::test(RegisteredStudentsList::class)
        ->set('gender', 'Male')
        ->assertSet('gender', 'Male')
        ->assertDontSeeHtml('<td class="whitespace-nowrap px-4 py-3 sm:px-5">Female </td>');
    }

     /** @test */
    public function the_user_email_verification_filter_field_is_working()
    {
        $users = User::factory(10)->create();

        Livewire::test(RegisteredStudentsList::class)
        ->set('email_verification', '0')
        ->assertSet('email_verification', '0')
        ->assertDontSeeHtml('<span>Verified</span>');
    }

     /** @test */
    public function the_user_can_reset_all_search_filters()
    {
        $Livewire = Livewire::test(RegisteredStudentsList::class)
                    ->set('from_date', '2023-07-01')
                    ->assertSet('from_date', '2023-07-01')
                    ->set('to_date', '2023-07-01')
                    ->assertSet('to_date', '2023-07-01')
                    ->set('gender', 'Male')
                    ->assertSet('gender', 'Male')
                    ->set('email_verification', '1')
                    ->assertSet('email_verification', '1')
                    ->set('search', 'john doe')
                    ->assertSet('search', 'john doe')
                    ->set('active', '1')
                    ->assertSet('active', '1')
                    ->call('resetParameters');

        $Livewire->assertSet('gender', null)
                ->assertSet('email_verification', null)
                ->assertSet('search', null)
                ->assertSet('from_date', null)
                ->assertSet('to_date', null)
                ->assertSet('active', null);
    }
}
