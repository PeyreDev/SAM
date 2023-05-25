<?php

namespace App\Http\Livewire;

use App\Models\Process_step;
use App\Models\Sample;
use Livewire\Component;

class Livesamplesindex extends Component
{
    public $samples;
    public $checkAvailable;
    public $checkScraped;
    public $availableDisplay; //take value hidden or empty for display
    public $scrapedDisplay; //take value hidden or empty for display
    public $selectedSamples;
    public $selectedProcess;

    public function mount()
    {
        $this->samples = Sample::all();
        $this->availableDisplay = '';
        $this->scrapedDisplay = '';
    }

    public function available()
    {
        if($this->checkAvailable == true)
        {
            $this->availableDisplay = 'hidden';
        }
        elseif($this->checkAvailable == false)
        {
            $this->availableDisplay = '';
        }
    }

    public function scraped()
    {
        if($this->checkScraped == true)
        {
            $this->scrapedDisplay = 'hidden';
        }
        elseif($this->checkScraped == false)
        {
            $this->scrapedDisplay = '';
        }
    }

    public function render()
    {
        // selectedSamples = array(sample name => sample id) when he's selected
        // when unselect : selectedSamples = array(sample name => false)
        // we look for the values 'false' in the array and we delete them

        $element = false;

        if(isset($this->selectedSamples))
        {
            unset($this->selectedSamples[array_search($element, $this->selectedSamples)]);
        }

        session(['selectedSamples' => $this->selectedSamples]);

        return view('livewire.livesamplesindex');
    }
}
