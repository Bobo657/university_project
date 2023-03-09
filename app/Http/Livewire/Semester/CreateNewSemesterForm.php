<?php

namespace App\Http\Livewire\Semester;

use App\Models\DuesSemester;
use App\Models\Semester;
use Livewire\Component;
use App\Rules\YearRange;

class CreateNewSemesterForm extends Component
{
    public $duration;
    public $levels = [];
    public $dues = [];
    protected $messages = [
        'duration.unique' => 'The semester already exists.'
    ];

    protected $validationAttributes = [
        'duration' => 'Semester',
        'dues.100' => 'dues',
        'dues.200' => 'dues',
        'dues.300' => 'dues',
        'dues.400' => 'dues',
        'dues.500' => 'dues'
    ];


    public function mount()
    {
        $this->levels = Semester::STUDENT_LEVELS;
    }

    protected function rules(): array
    {
        $rules = [
            'duration' => ['required', 'unique:semesters', new YearRange] //'|min:6|unique:semesters',
        ];

        foreach($this->levels as $level){
            $rules['dues.'.$level] = 'required';
        }

        return $rules;
    }

    public function createSemester() : void
    {
        $this->validate();

        try {
            $semester = Semester::create(['duration' => $this->duration]);

            foreach($this->dues as $key => $value){
                DuesSemester::updateOrCreate([
                    'amount' => $value,
                    'level' =>  $key,
                    'semester_id' => $semester->id
                ]);
            }
    
            session()->flash('message', 'Semester successfully created.');
            redirect()->to(route('semester.details', ['semester' => $semester->id]));

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function errorKey(){
        return "dues.100";
    }

    public function render()
    {
        
        return view('livewire.semester.create-new-semester-form');
    }
}
