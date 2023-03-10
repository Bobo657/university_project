<?php

namespace App\Http\Livewire\Award;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Award;
use App\Models\Ballot;
use App\Models\Semester;
use App\Traits\TableWithFilters;

class NomineesAwardList extends Component
{
    use TableWithFilters;

    protected $listeners = ['removeSelectedNominee' => 'deleteNominee'];
    protected $actions = ['action' => 'removeSelectedNominee'];
    protected $resetProperties = ['search', 'noOfRecords', 'filter_semester_id', 'filter_award_id', 'search'];

    public $semesters;
    public $awards;
    public $filter_semester_id = "";
    public $filter_award_id = "";

    public function mount()
    {
        $this->semesters = Semester::select(['id', 'duration'])->get();
        $this->awards = Award::select(['id', 'name'])->get();
    }

    public function deleteNominee()
    {
        Ballot::findOrFail($this->recordId)->delete();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Award nominee has been deleted successfully'
        ]);

        $this->reset('recordId');
    }

    public function render()
    {
        $ballots =  Ballot::awardNominees()
                    ->with('ballotable:name,id')
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
                    ->paginate($this->noOfRecords);

        return view('livewire.award.nominees-award-list', ['ballots' => $ballots ]);
    }
}
