<?php

namespace App\Traits;

use Livewire\WithPagination;

trait TableWithFilters
{
    use  WithPagination;

    public $search;
    public $noOfRecords = 20;
    public $fromDate;
    public $toDate;
    public $recordId;

    public function resetParameters()
    {
        $this->resetPage();
        $this->reset($this->resetProperties);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, $this->resetProperties)) {
            $this->resetPage();
        }
    }

    public function confirmDelete($record_id)
    {
        $this->recordId = $record_id;
        $this->dispatchBrowserEvent('delete-notify', $this->actions);
    }
}
