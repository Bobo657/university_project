<?php

namespace App\Http\Livewire\Award;

use App\Models\Award;
use Livewire\Component;

class CreatedAwardList extends Component
{
    public $awards;
    public $selected_record_id;

    protected $listeners = [
        'award_updated' => 'getAwards',
        'removeSelectedAward' => 'deleteRecord'
    ];

    public function  mount()
    {
       $this->getAwards();
    }

    public function confirmDelete($record_id)
    {
        $this->selected_record_id = $record_id;
        $this->dispatchBrowserEvent('delete-notify', ['action' => 'removeSelectedAward']);
    }

    public function deleteRecord()
    {
        Award::findOrFail($this->selected_record_id)->delete();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Award has been delete successfully'
        ]);

       $this->reset('selected_record_id');
       $this->getAwards();
    }

    public function getAwards()
    {
        $this->awards = Award::select(['name', 'id'])->withCount(['ballots', 'votes'])->get();
    }

    public function render()
    {
        return view('livewire.award.created-award-list');
    }
}
