<?php

namespace App\Http\Livewire;

use App\Models\Localisation;
use App\Models\Substrate_batch;
use App\Models\Tag;
use Livewire\Component;

class Livesamplescreate extends Component
{
    public $localisations, $substrateBatches, $tagsMaterial, $tagsOrientation;
    public $sampleFrom;
    public $hiddenBatch, $hiddenExternal;

    public function mount()
    {
        $this->localisations = Localisation::all();
        $this->substrateBatches = Substrate_batch::where('remaining_quantity', '>', 0)->get();
        $this->tagsMaterial = Tag::where('tagcat_id', 1)->get(); //tagcat_id = 1 : material
        $this->tagsOrientation = Tag::where('tagcat_id', 6)->get(); // tagcat_id = 6 : orientation
        $this->sampleFrom = '';
        $this->hiddenBatch = '';
        $this->hiddenExternal = 'hidden';
    }

    public function fromSelection()
    {
        if($this->sampleFrom == 'fromBatch')
        {
            $this->hiddenBatch = '';
            $this->hiddenExternal = 'hidden';
        }
        elseif($this->sampleFrom == 'fromExternal')
        {
            $this->hiddenBatch = 'hidden';
            $this->hiddenExternal = '';
        }
    }

    public function render()
    {
        return view('livewire.livesamplescreate');
    }
}
