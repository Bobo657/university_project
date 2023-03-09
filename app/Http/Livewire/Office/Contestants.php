<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Office;
use App\Models\Ballot;
use App\Models\Semester;

class Contestants extends Component
{
    use WithPagination;

    protected $listeners = ['removeSelectedContestant' => 'deleteRecord'];
    public $selected_record_id;
    public $search;
    public $offices;
    public $semesters;
    public $contestants;
    public $no_of_records = 20;
    public $filter_semester_id = "";
    public $filter_office_id = "";

    public function mount()
    {
        $this->semesters = Semester::select(['id', 'duration'])->get();
        $this->offices = Office::select(['id', 'name'])->get();
    }

    public function resetParameters()
    {
        $this->resetPage();
        $this->reset(['filter_semester_id', 'filter_office_id', 'search']);
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
        $this->dispatchBrowserEvent('delete-notify', ['action' => 'removeSelectedContestant']);
    }

    public function deleteRecord()
    {
        Ballot::findOrFail($this->selected_record_id)->delete();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Office contestants has been delete successfully'
        ]);
        $this->reset('selected_record_id');
    }

    public function render()
    {
        $ballots =  Ballot::officeContestants()->with([
                        'semester:id,duration',
                        'user:id,middle_name,last_name,first_name,gender'
                    ])
                    ->withCount('votes')
                    ->when(!empty($this->search), function ($q) {
                        return $q->whereHas('user', function ($query) {
                            $query->where('users.first_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('users.middle_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('users.last_name', 'LIKE', "%{$this->search}%");
                        });
                    })
                    ->when(!empty($this->filter_semester_id), function ($q) {
                        return $q->where('semester_id', $this->filter_semester_id);
                    })
                    ->when(!empty($this->filter_office_id), function ($q) {
                        return $q->where('ballotable_id', $this->filter_office_id);
                    })
                    ->paginate($this->no_of_records);

        return view('livewire.office.contestants', ['ballots' => $ballots]);
    }
}

