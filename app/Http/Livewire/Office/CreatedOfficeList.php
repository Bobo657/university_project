<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use Livewire\Component;

class CreatedOfficeList extends Component
{
    public $offices;
    public $selected_record_id;

    protected $listeners = [
        'office_updated' => 'getOffices',
        'removeSelectedOffice' => 'deleteRecord'
    ];

    public function mount()
    {
        $this->getOffices();
    }

    public function confirmDelete($record_id)
    {
        $this->selected_record_id = $record_id;
        $this->dispatchBrowserEvent('delete-notify', ['action' => 'removeSelectedOffice']);
    }

    public function deleteRecord()
    {
        Office::findOrFail($this->selected_record_id)->delete();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Office has been delete successfully'
        ]);

        $this->reset('selected_record_id');
        $this->getOffices();
    }

    public function getOffices()
    {
        $this->offices = Office::select(['name', 'id'])->withCount(['ballots', 'votes'])->get();
    }

    public function render()
    {
        return view('livewire.office.created-office-list');
    }
}
