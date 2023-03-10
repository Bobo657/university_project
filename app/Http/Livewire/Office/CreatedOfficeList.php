<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use Livewire\Component;

class CreatedOfficeList extends Component
{
    public $offices;
    public $selectedOfficeId;

    protected $listeners = [
        'office_updated' => 'refreshOffices',
        'removeSelectedOffice' => 'deleteOffice'
    ];

    public function mount()
    {
        $this->refreshOffices();
    }

    public function confirmDelete($record_id)
    {
        $this->selectedOfficeId = $record_id;
        $this->dispatchBrowserEvent('delete-notify', ['action' => 'removeSelectedOffice']);
    }

    public function deleteOffice()
    {
        Office::findOrFail($this->selectedOfficeId)->delete();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Office has been deleted successfully'
        ]);

        $this->reset('selectedOfficeId');
        $this->refreshOffices();
    }

    public function refreshOffices()
    {
        $this->offices = Office::select(['name', 'id'])->withCount(['ballots', 'votes'])->get();
    }

    public function render()
    {
        return view('livewire.office.created-office-list');
    }
}
