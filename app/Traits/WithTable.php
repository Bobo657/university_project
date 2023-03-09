<?php

namespace App\Traits;
use Livewire\WithPagination;

trait WithTable
{
    use  WithPagination;

    public $search;
    public $no_of_records = 10;
    public $from_date;
    public $to_date;
    public $active;
    public $filter = ['search', 'from_date', 'to_date', 'active'];
    public $selected_record_id;

    public function resetParameters()
    {
        $this->resetPage();
        $this->reset($this->filter);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingNoOfRecords()
    {
        $this->resetPage();
    }

    public function confirmDelete($record_id)
    {
        $this->selected_record_id = $record_id;
        $this->dispatchBrowserEvent('delete-notify', $this->action);
    }
}
