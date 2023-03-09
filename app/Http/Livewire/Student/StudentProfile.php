<?php

namespace App\Http\Livewire\Student;

use App\Models\Ballot;
use App\Models\User;
use App\Models\Vote;
use Livewire\Component;

class StudentProfile extends Component
{
    public $student;
    public $registered_semesters;
    public $votes;
    public $ballots;

    public function mount(User $student)
    {
        $this->registered_semesters = $student->levels->load('semester');

        $this->votes =   Vote::with([
                            'semester:id,duration',
                            'ballot' => function ($query) {
                                $query->select(['id','ballotable_type','ballotable_id'])
                                      ->with('ballotable:id,name');
                            },
                            'voteOwner:users.id,first_name,last_name,middle_name,profile_photo_path,gender'
                        ])
                        ->where('user_id', $student->id)->get();

        $this->ballots  = Ballot::with(['ballotable:id,name'])
                            ->where('user_id', $student->id)->get();

    }

    public function toggleStatus()
    {
        $this->student->toggleStatus();
    }

    public function toggleGraduation()
    {
        $this->student->toggleGraduation();
    }

    public function render()
    {
        return view('livewire.student.student-profile')
        ->extends('layouts.app')
        ->section('content');
    }
}
