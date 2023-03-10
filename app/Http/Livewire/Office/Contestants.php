<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;
use App\Traits\TableWithFilters;
use App\Models\Office;
use App\Models\Ballot;
use App\Models\Semester;
use Illuminate\Support\Facades\DB;

class Contestants extends Component
{
    use TableWithFilters;
    
    protected $listeners = ['removeSelectedContestant' => 'deleteContestant'];
    protected $actions = ['action' => 'removeSelectedContestant'];
    protected $resetProperties = ['search', 'noOfRecords', 'filter_office_id',];

    public $offices = [];
    public $semesters;
    public $contestants;
    public $semesterId = "";
    public $filter_office_id = "";

    public function mount()
    {
        $this->semesterId = cache('active_semester')->id;
        $this->semesters = Semester::select(['id', 'duration'])->get();
        $this->offices = Office::select(['id', 'name'])->get();
    }

    public function deleteContestant()
    {
        Ballot::findOrFail($this->recordId)->delete();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Office contestants has been delete successfully'
        ]);

        $this->reset('recordId');
    }

    public function render()
    {
        $ballots =  $this->getBallots();

        return view('livewire.office.contestants', ['ballots' => $ballots]);
    }

    protected function getBallots()
    {

        $ballots = Ballot::officeContestants()
                    ->with('ballotable:name,id')
                    ->withCount('votes')
                    ->where('semester_id', $this->semesterId)
                    ->when(!empty($this->search), function ($query) {
                        $query->whereHas('user', function ($innerQuery) {
                            $innerQuery->where(
                                DB::raw('concat(first_name, " ",middle_name," ",last_name)'), 
                                'LIKE', 
                                "%{$this->search}%"
                            );
                        });
                    })
                    ->when(!empty($this->filter_office_id), function ($query) {
                        $query->where('ballotable_id', $this->filter_office_id);
                    })
                    ->paginate($this->noOfRecords);

        return $ballots;
    }
}

