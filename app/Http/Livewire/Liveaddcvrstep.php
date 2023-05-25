<?php

namespace App\Http\Livewire;

use App\Models\Equipment;
use App\Models\Gas_line;
use App\Models\Tag;
use Livewire\Component;

class Liveaddcvrstep extends Component
{
    public $equipments;
    public $nbrStep, $nbrFlow;
    public $tagsMaterial;
    public $equipSelectedId, $equipmentSelected;
    public $gasLines;
    public $flowsPerStep;

    public function mount()
    {
        $this->equipments = Equipment::all();
        $this->tagsMaterial = Tag::where('tagcat_id', 1)->get(); // tagcat_id : 1 => Material

        $this->nbrStep = 1; // 1 because add cvr included add minimum 1 cvr step
    }

    public function addStep()
    {
        $this->nbrStep++;
        $this->nbrFlow = 0; // when we add a step we recount the flows at 0
    }

    public function addFlow()
    {
        $this->nbrFlow++;
        $this->flowsPerStep[$this->nbrStep] = $this->nbrFlow; // array for count flows per step
    }

    public function selectEquip()
    {
        $this->equipmentSelected = Equipment::where('id', $this->equipSelectedId)->first();
        $this->gasLines = $this->equipmentSelected->gasLines()->get();
    }

    public function render()
    {
        session([
            'nbrSteps' => $this->nbrStep,
            'nbrFlows'  => $this->nbrFlow,
        ]);

        return view('livewire.liveaddcvrstep');
    }
}
