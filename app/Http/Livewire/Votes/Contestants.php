<?php

namespace App\Http\Livewire\Votes;

use Livewire\Component;
use DB;

class Contestants extends Component
{
    public $contestants;
    public $academic_session_id;
    protected $listeners = ['academic_session_changed' => 'mount'];

    public function mount($academic_session_id)
    {
        $this->academic_session_id = $academic_session_id;

        $this->contestants = DB::table('contestants as con')
                             ->select(
                                 DB::raw('CONCAT(contestant.first_name," ",contestant.middle_name," ",contestant.last_name) AS full_name'),
                                 'con.id',
                                 'awards.name as award',
                                 DB::raw('(select count(*) as votes from `votes` where `con`.`id` = `votes`.`contestant_id`) as votes_count')
                             )
                             ->leftJoin('awards', 'awards.id', '=', 'con.contestantable_id')
                             ->leftJoin('users as contestant', 'contestant.id', '=', 'con.user_id')
                             ->where('con.academic_session_id', $this->academic_session_id)
                             ->where('con.contestantable_type', 'award')
                             ->get();
    }

    public function render()
    {
        return view('livewire.votes.contestants', [
            'contestants' => $this->contestants
        ]);
    }
}
