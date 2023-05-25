<?php
//**********************************************************************************************************************
//  O.Briot : 7 june 2021   v1.0
//
//**********************************************************************************************************************

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class UserFiles extends ModalComponent
{
    public $confirming;
    public $selected;
    public $stringtoremove;
    public $user;
    public $fileload;
    public $filesave;
    public $filename;
    public $description;
    public $isLoadVisible;

    use WithPagination;
    use WithFileUploads;

    public function mount()
    {
        $this->user = auth()->user();
        $documents = $this->user->documents;
        $this->stringtoremove = 'users/'.$this->user->username.'/';
        $this->confirming = array();
        $this->confirming += [0 => 0];
        for ($i = 0; $i < count($documents); $i++){
            $this->confirming += [$documents[$i]->id => 0];
        }
        $this->filename = 'no file selected yet ...';
        $this->isLoadVisible = false;
    }

    public function updatedSelected()
    {
        $last = array_search(false, $this->selected);
        if (empty($last)){
            $last = end($this->selected);
            $pathimage = $this->user->documents()->find($last)->path;
            $this->emit("openModal", "popup-user-image", ["name" => "imagepopup", "path" => "$pathimage"]);
            }
        else unset($this->selected[$last]);
    }

    public function confirmDelete($id)
    {
        $this->confirming[$id] = $id;
    }

    public function kill($id, $del=false)
    {
        if ($del and ($id == $this->confirming[$id])){
            // erase from disk storage
            $pathfile = 'documents/'.$this->user->documents()->find($id)->path;
            $ok = Storage::disk('sam')->delete($pathfile);
            // clean up the database
            Document::destroy($id);
            // to reload the page correctly, data must be refreshed
            $this->user->refresh();
            }
        $this->confirming[$id] = 0;
    }

    public function UpdatedFileload()
    {
        $this->filename = $this->fileload->getClientOriginalName();
    }

    public function upload()
    {
        // prevent running validation on closing
        if (!$this->isLoadVisible) return;

        $this->validate([
            'fileload' => 'required|file', // not empty
            'description' => 'required|string',
        ]);
        // close selection window
        $this->isLoadVisible = false;
        // Store file on disk
        $this->fileload->storeAs('documents/'.$this->stringtoremove,$this->filename,'sam');
        // Add to database
        $document = new Document();
        $document->name = $this->description;
        $document->path = 'users/'.$this->user->username.'/'.$this->filename;
        $document->related_type = 'App\Models\User';
        $document->related_id = $this->user->id;
        $document->save();
        // clear variables
        unset($this->fileload);
        $this->filename = 'no file selected yet';
        unset($this->description);
    }

    public function render()
    {
        $documents = $this->user->documents()->paginate(6);

        return view('livewire.user-files', compact('documents'));
    }
}
