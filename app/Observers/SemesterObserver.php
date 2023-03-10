<?php

namespace App\Observers;

use App\Models\Semester;

class SemesterObserver
{

    public function creating(Semester $semester)
    {
        // abort_if(Semester::active(), 403, $message = "It is not possible to create a new semester while there is already an ongoing semester.");
        cache()->forget('active_semester');
        Semester::where('current', true)->update(['current' => false]);
        $semester->current = true;
    }

    /**
     * Handle the Semester "created" event.
     */
    public function created(Semester $semester): void
    {
       
    }

    /**
     * Handle the Semester "updated" event.
     */
    public function updated(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "deleted" event.
     */
    public function deleted(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "restored" event.
     */
    public function restored(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "force deleted" event.
     */
    public function forceDeleted(Semester $semester): void
    {
        //
    }
}
