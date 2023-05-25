<?php

namespace App\Http\Livewire;

use App\Models\Equipment;
use App\Models\Maintenance;
use Livewire\Component;
use MongoDB\Driver\Session;

class Livemaintenancesindex extends Component
{
    public $equipments;
    public $maintenances;
    public $equipmentSelected;

    public function mount()
    {
        $this->equipments = Equipment::all();
        $this->maintenances = Maintenance::all();
    }

    public function render()
    {
        session(['equipment' => $this->equipmentSelected]);

        return view('livewire.livemaintenancesindex');
    }
}
