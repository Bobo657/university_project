<?php

namespace App\Http\Livewire\Award;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Award;
use App\Models\Ballot;
use App\Models\Semester;

class NomineesAwardList extends Component
{
    use WithPagination;

    protected $listeners = ['removeSelectedNominee' => 'deleteRecord'];
    public $selected_record_id;
    public $search;
    public $semesters;
    public $awards;
    public $no_of_records = 20;
    public $filter_semester_id = "";
    public $filter_award_id = "";

    public function mount()
    {
        $this->semesters = Semester::select(['id', 'duration'])->get();
        $this->awards = Award::select(['id', 'name'])->get();
    }

    public function resetParameters()
    {
        $this->resetPage();
        $this->reset(['filter_semester_id', 'filter_award_id', 'search']);
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
        $this->dispatchBrowserEvent('delete-notify', ['action' => 'removeSelectedNominee']);
    }

    public function deleteRecord()
    {
        Ballot::findOrFail($this->selected_record_id)->delete();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Award nominee has been delete successfully'
        ]);
        $this->reset('selected_record_id');
    }

    public function render()
    {
        $ballots =  Ballot::awardNominees()->with([
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
                    ->when(!empty($this->filter_award_id), function ($q) {
                        return $q->where('ballotable_id', $this->filter_award_id);
                    })
                    ->paginate($this->no_of_records);

        return view('livewire.award.nominees-award-list', ['ballots' => $ballots ]);
    }
}
