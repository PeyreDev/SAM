<?php

namespace App\Http\Livewire;

use App\Models\Source;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Livesourcesavailable extends Component
{
    public $sources;
    public $gaslinesources;
    public $check;
    public $available;

    public function mount()
    {
        $this->sources = Source::all();
        $this->gaslinesources = DB::table('gas_line_source')->get();
        $this->check = false;
        $this->available = 'bg-red-100';
    }

    public function available()
    {
        if ($this->check == true)
        {
            $this->available = "hidden";
        }
        elseif($this->check == false)
        {
            $this->available = 'bg-red-100';
        }
    }

    public function render()
    {
        return view('livewire.livesourcesavailable');
    }
}
