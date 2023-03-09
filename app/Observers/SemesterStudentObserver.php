<?php

namespace App\Observers;
use App\Models\SemesterStudent;

class SemesterStudentObserver
{
    
    public function creating(SemesterStudent $semesterStudent)
    {
        // Perform some action before the user is created
        abort_if($semesterStudent->amount == 0, 403, $message = "dues amount is zero");

        abort_if(SemesterStudent::firstWhere([
            'user_id' => $semesterStudent->user_id, 'semester_id' => $semesterStudent->semester_id
        ]), 403, $message = "Student already in semester list");
    }

    /**
     * Handle the SemesterStudent "created" event.
     */
    public function created(SemesterStudent $semesterStudent): void
    {
        //
    }

    /**
     * Handle the SemesterStudent "updated" event.
     */
    public function updated(SemesterStudent $semesterStudent): void
    {
        //
    }

    /**
     * Handle the SemesterStudent "deleted" event.
     */
    public function deleted(SemesterStudent $semesterStudent): void
    {
        //
    }

    /**
     * Handle the SemesterStudent "restored" event.
     */
    public function restored(SemesterStudent $semesterStudent): void
    {
        //
    }

    /**
     * Handle the SemesterStudent "force deleted" event.
     */
    public function forceDeleted(SemesterStudent $semesterStudent): void
    {
        //
    }
}
