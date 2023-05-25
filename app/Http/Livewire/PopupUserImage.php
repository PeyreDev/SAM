<?php
//**********************************************************************************************************************
//  O.Briot : 8 june 2021   v1.0
//
//**********************************************************************************************************************

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PopupUserImage extends ModalComponent
{
    public $name;
    public $path_image;
    public $file_ext;

    public function mount($name, $path)
    {
        $this->name = $name;
        $this->path_image = $path;
        $tokens = explode('.', $path);
        $this->file_ext = end($tokens);
    }

    public static function modalMaxWidth(): string
    {
        // 'sm'
        // 'md'
        // 'lg'
        // 'xl'
        // '2xl'
        // '3xl'
        // '4xl'
        // '5xl'
        // '6xl'
        // '7xl'
        return 'lg';
    }

    public function render()
    {
        return view('livewire.popup-user-image');
    }
}
