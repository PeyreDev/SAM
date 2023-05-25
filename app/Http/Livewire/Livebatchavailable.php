<?php

namespace App\Http\Livewire;

use App\Models\Substrate_batch;
use App\Models\Tag;
use Livewire\Component;

class Livebatchavailable extends Component
{
    public $substrateBatches;
    public $tags;
    public $check;
    public $available;

    public function mount()
    {
        $this->substrateBatches = Substrate_batch::all();
        $this->tags = Tag::all();
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
        return view('livewire.livebatchavailable');
    }
}
