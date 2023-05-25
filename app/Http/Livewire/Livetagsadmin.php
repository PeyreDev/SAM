<?php

namespace App\Http\Livewire;

use App\Models\Equipment;
use App\Models\Tag;
use App\Models\Tagcat;
use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Livetagsadmin extends Component
{
    public $catSelectedId, $tagSelectedId;
    public $tagCats, $tagCatSelect, $tagCatSelectName;
    public $tags, $tagSelected, $tagSelectedName;
    public $elementNbr, $occurenceNbr, $tagNbrEquip;
    public $newCat, $newTag, $editCat, $editTag;
    public $disable, $disableEditCat, $disableEditTag, $disableEmpty, $disableDeleteCat, $disableDeleteTag;
    public $inputNewCat, $inputEditCat, $inputNewTag, $inputEditTag;
    public $deleteConfirmCat, $deleteConfirmTag;

    public function mount()
    {
        $this->tagCats = Tagcat::all()->sortBy('keyword');
        $this->tagCatSelect = [];
        $this->tagCatSelectName = '';
        $this->tags = [];
        $this->tagSelected = [];
        $this->tagSelectedName = '';
        $this->elementNbr = '';
        $this->newCat = false; //boolean : 1 => button's pressed, 0 => button is not pressed
        $this->newTag = false; //boolean : 1 => button's pressed, 0 => button is not pressed
        $this->editCat = false;
        $this->editTag = false;
        $this->disable = '';
        $this->disableEditCat = 'disabled'; //edit disabled when no category is selected
        $this->disableEditTag = 'disabled'; //edit disabled when no tag is selected
        $this->disableEmpty = 'disabled';
        $this->disableDeleteCat = '';
        $this->inputNewCat = '';
        $this->inputEditCat = '';
        $this->inputNewTag = '';
        $this->inputEditTag = '';
        $this->deleteConfirmCat = false;
    }

    public function updatedCatSelectedId()
    {
        $this->tags = Tag::where('tagcat_id', $this->catSelectedId)->orderBy('keyword', 'asc')->get();
        $this->tagCatSelect = Tagcat::where('id', $this->catSelectedId)->first();
        $this->tagCatSelectName = $this->tagCatSelect->keyword;

        //we overwrite the old values
        $this->tagSelected = [];
        $this->tagSelectedId = '';
        $this->tagSelectedName = '';
        $this->elementNbr = '';
        $this->disableEditCat = '';
        $this->disableEditTag = 'disabled';

        if($this->tags->isEmpty())
        {
            $this->disableDeleteCat = '';
        }
        else
        {
            $this->disableDeleteCat = 'disabled';
        }
    }

    public function updatedTagSelectedId()
    {
        $this->tagSelected = Tag::where('id', $this->tagSelectedId)->first();
        $this->tagSelectedName = $this->tagSelected->keyword;
        $this->disableEditTag = '';

        //we count occurrences of the selected tag in DB
        $this->occurenceNbr = DB::table('taggables')->where('tag_id', $this->tagSelectedId)->count();
        $this->tagNbrEquip = Equipment::where('equipment_type', $this->tagSelectedId)->count();
        $this->elementNbr = $this->occurenceNbr + $this->tagNbrEquip;

        if($this->elementNbr > 0)
        {
            $this->disableDeleteTag = 'disabled';
        }
        else
        {
            $this->disableDeleteTag = '';
        }
    }

    public function newCat() //Called when the 'new' category button's pressed
    {
        $this->inputNewCat = '';
        $this->newCat = true;
        $this->disable = 'disabled'; // disable the selection field
        $this->disableEditTag = 'disabled';
        $this->disableEmpty = 'disabled';
    }

    public function updatedInputNewCat()
    {
        if($this->inputNewCat == '' || $this->inputNewCat == null)
        {
            $this->disableEmpty = 'disabled';
        }
        else
        {
            $this->disableEmpty = '';
        }
    }

    public function newCatAccept()
    {
        Tagcat::insert([
            'keyword' => $this->inputNewCat
        ]);

        $this->tagCats = Tagcat::all(); // recharge all categories with the new added
        $this->newCat = false;
        $this->disable = '';
        $this->disableEditCat = '';

        //reloads all properties on the new category
        $this->tagCatSelect = Tagcat::where('keyword', $this->inputNewCat)->first();
        $this->catSelectedId = $this->tagCatSelect->id;
        $this->tagCatSelectName = $this->tagCatSelect->keyword;

        $this->tags = Tag::where('tagcat_id', $this->catSelectedId)->orderBy('keyword', 'asc')->get();
        $this->tagSelected = [];
        $this->tagSelectedName = '';
        $this->elementNbr = '';

        if($this->tags->isEmpty())
        {
            $this->disableDeleteCat = '';
        }
        else
        {
            $this->disableDeleteCat = 'disabled';
        }
    }

    public function newCatCancel()
    {
        $this->newCat = false;
        $this->disable = '';
        $this->disableEditTag = '';
    }

    public function catDelete()
    {
        $this->deleteConfirmCat = true;
    }

    public function catDeleteConfirm()
    {
        Tag::where('tagcat_id', $this->catSelectedId)->delete();
        Tagcat::where('id', $this->catSelectedId)->delete();

        $this->tags = Tag::where('tagcat_id', $this->catSelectedId)->get(); // recharge all tags without the deleted
        $this->tagSelected = [];
        $this->tagSelectedName = '';
        $this->elementNbr = '';

        $this->tagCats = Tagcat::all(); // recharge all categories without the deleted
        $this->tagCatSelect = [];
        $this->tagCatSelectName = '';

        $this->disableEditCat = 'disabled';
        $this->deleteConfirmCat = false;
    }

    public function catDeleteCancel()
    {
        $this->deleteConfirmCat = false;
    }

    public function catEdit()
    {
        $this->editCat = true;
        $this->disable = 'disabled';
        $this->disableEditTag = 'disabled';
        $this->disableEmpty = 'disabled';

        //we disable all of tags during the editing
        $this->tagSelected = [];
        $this->tagSelectedId = '';
        $this->tagSelectedName = '';
        $this->elementNbr = '';

        //we pre-filled with the selected category
        $this->inputEditCat = $this->tagCatSelectName;
    }

    public function updatedInputEditCat()
    {
        if($this->inputEditCat == '' || $this->inputEditCat == null)
        {
            $this->disableEmpty = 'disabled';
        }
        else
        {
            $this->disableEmpty = '';
        }
    }

    public function editCatCancel()
    {
        $this->editCat = false;
        $this->disable = '';
    }

    public function editCatAccept()
    {
        Tagcat::where('id', $this->catSelectedId)->update(['keyword' => $this->inputEditCat]);

        $this->tagCats = Tagcat::all(); // recharge all categories
        $this->editCat = false;
        $this->disable = '';

        $this->tagCatSelect = Tagcat::where('keyword', $this->inputEditCat)->first();
        $this->catSelectedId = $this->tagCatSelect->id;
        $this->tagCatSelectName = $this->tagCatSelect->keyword;
    }

    public function newTag()
    {
        $this->newTag = true;
        $this->disable = 'disabled'; // disable the selection field
        $this->inputNewTag = '';
        $this->disableEditCat = 'disabled';
        $this->disableEmpty = 'disabled';
    }

    public function updatedInputNewTag()
    {
        if($this->inputNewTag == '' || $this->inputNewTag == null)
        {
            $this->disableEmpty = 'disabled';
        }
        else
        {
            $this->disableEmpty = '';
        }
    }

    public function newTagCancel()
    {
        $this->newTag = false;
        $this->disable = '';
        $this->disableEditCat = '';
    }

    public function newTagAccept()
    {
        Tag::insert([
            'keyword'   => $this->inputNewTag,
            'tagcat_id' => $this->catSelectedId
        ]);

        $this->tags = Tag::where('tagcat_id', $this->catSelectedId)->get();

        //reloads all properties on the new tag
        $this->tagSelected = Tag::where('keyword', $this->inputNewTag)->first();
        $this->tagSelectedId = $this->tagSelected->id;
        $this->tagSelectedName = $this->tagSelected->keyword;
        $this->occurenceNbr = DB::table('taggables')->where('tag_id', $this->tagSelectedId)->count();
        $this->tagNbrEquip = Equipment::where('equipment_type', $this->tagSelectedId)->count();
        $this->elementNbr = $this->occurenceNbr + $this->tagNbrEquip;

        $this->newTag = false;
        $this->disable = '';
        $this->disableEditCat = '';
        $this->disableEditTag = '';

        $this->disableDeleteCat = 'disabled';
    }

    public function tagDelete()
    {
        $this->deleteConfirmTag = true;
    }

    public function tagDeleteConfirm()
    {
        Tag::where('id', $this->tagSelectedId)->delete();

        $this->tags = Tag::where('tagcat_id', $this->catSelectedId)->get(); // recharge all tags without the deleted
        $this->tagSelected = [];
        $this->tagSelectedName = '';
        $this->elementNbr = '';
        $this->disableEditTag = 'disabled';
        $this->deleteConfirmTag = false;

        if($this->tags->isEmpty())
        {
            $this->disableDeleteCat = '';
        }
        else
        {
            $this->disableDeleteCat = 'disabled';
        }
    }

    public function tagDeleteCancel()
    {
        $this->deleteConfirmTag = false;
    }

    public function tagEdit()
    {
        $this->editTag = true;
        $this->disable = 'disabled';
        $this->disableEditCat = 'disabled';
        $this->disableEmpty = 'disabled';

        //we pre-filled with the selected tag
        $this->inputEditTag = $this->tagSelectedName;
    }

    public function updatedInputEditTag()
    {
        if($this->inputEditTag == '' || $this->inputEditTag == null)
        {
            $this->disableEmpty = 'disabled';
        }
        else
        {
            $this->disableEmpty = '';
        }
    }

    public function editTagCancel()
    {
        $this->editTag = false;
        $this->disable = '';
        $this->disableEditCat = '';
    }

    public function editTagAccept()
    {
        Tag::where('id', $this->tagSelectedId)->update(['keyword' => $this->inputEditTag]);

        $this->editTag = false;
        $this->disable = '';

        $this->tagSelected = [];
        $this->tagSelectedName = $this->inputEditTag;
        $this->occurenceNbr = DB::table('taggables')->where('tag_id', $this->tagSelectedId)->count();
        $this->tagNbrEquip = Equipment::where('equipment_type', $this->tagSelectedId)->count();
        $this->elementNbr = $this->occurenceNbr + $this->tagNbrEquip;

        $this->tags = Tag::where('tagcat_id', $this->catSelectedId)->get();

        $this->disableEditCat = '';
    }

    public function render()
    {
        return view('livewire.livetagsadmin');
    }
}
