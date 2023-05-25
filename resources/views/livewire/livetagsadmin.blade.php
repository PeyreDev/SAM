<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg my-5">
        <div class="sm:flex sm:flex-row sm:items-center sm:justify-around flex-col">
            <span class="md:w-36">Select category :</span>
            <div class="flex flex-row items-center md:justify-between md:w-1/2 w-full justify-around">
                <div class="my-5">
                    <select {{ $disable }} wire:model='catSelectedId' class="disabled:opacity-50 h-8 text-xs sm:text-sm md:w-60 w-40">
                        @if($newCat == true)
                            <option hidden="hidden" value="0">--Please choose an option--</option>
                        @elseif($newCat == false)
                            <option hidden="hidden" value="0">--Please choose an option--</option>
                            @foreach($tagCats as $tagCat)
                                <option value="{{ $tagCat->id }}"> {{ $tagCat->keyword }} </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button {{ $disable }} wire:click="newCat" class="disabled:opacity-50 w-12 shadow-lg rounded-md bg-gray-100 hover:bg-gray-50 text-blue-600 hover:text-blue-900 ">New</button>
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200 w-full">
            <thead>
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-40">
                    Name
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr class="flex flex-row items-center justify-between">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 md:w-80 min-w-40">
                    @if($newCat == false && $editCat == false)
                        {{ $tagCatSelectName }}
                    @elseif($newCat == true)
                        <input wire:model="inputNewCat" type="text" class="w-60 h-7 text-sm">
                    @elseif($editCat == true)
                        <input wire:model="inputEditCat" type="text" class="w-60 h-7 text-sm">
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right flex flex-col md:block">
                    @if($newCat == false && $editCat == false && $deleteConfirmCat == false)
                        <button {{ $disableEditCat }} wire:click="catEdit" class="disabled:opacity-50 text-blue-600 hover:text-blue-900 mb-2 mr-2">Edit</button>
                        <button {{ $disableEditCat }} {{ $disableDeleteCat }} wire:click="catDelete" class="disabled:opacity-50 text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Delete</button>
                    @elseif($newCat == true)
                        <button {{ $disableEmpty }} wire:click="newCatAccept" class="disabled:opacity-50 text-blue-600 hover:text-blue-900 mb-2 mr-2">Accept</button>
                        <button wire:click="newCatCancel" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Cancel</button>
                    @elseif($editCat == true)
                        <button {{ $disableEmpty }} wire:click="editCatAccept" class="disabled:opacity-50 text-blue-600 hover:text-blue-900 mb-2 mr-2">Accept</button>
                        <button wire:click="editCatCancel" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Cancel</button>
                    @elseif($deleteConfirmCat == true)
                        <button wire:click="catDeleteConfirm" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Yes</button>
                        <button wire:click="catDeleteCancel" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">No</button>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg my-5">
        <div class="md:flex md:flex-row md:items-center md:justify-around flex-col">
            <span class="md:w-36">Select related tag :</span>
            <div class="flex flex-row items-center md:justify-between md:w-1/2 w-full justify-around">
                <div class="my-5">
                    <select {{ $disable }} wire:model="tagSelectedId" class="disabled:opacity-50 h-8 text-xs sm:text-sm md:w-60 w-40">
                        @if($newTag == true || $newCat == true)
                            <option hidden="hidden" value="0">--Please choose an option--</option>
                        @elseif($newTag == false || $newCat == false)
                            <option hidden="hidden" value="0">--Please choose an option--</option>
                            @foreach($tags as $tag)
                                <option wire:key="{{ $tag->id }}" value="{{ $tag->id }}"> {{ $tag->keyword }} </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button {{ $disable }} {{ $disableEditCat }} wire:click="newTag" class="disabled:opacity-50 w-12 shadow-lg rounded-md bg-gray-100 hover:bg-gray-50 text-blue-600 hover:text-blue-900">New</button>
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200 w-full">
            <thead>
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Related elements number
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 w-80">
                    @if($newTag == false && $newCat == false && $editTag == false)
                        {{ $tagSelectedName }}
                    @elseif($newTag == true)
                        <input required wire:model="inputNewTag" type="text" class="w-60 h-7 text-sm">
                    @elseif($editTag == true)
                        <input required wire:model="inputEditTag" type="text" class="w-60 h-7 text-sm">
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    @if($newTag == false && $newCat == false && $editTag == false)
                        {{ $elementNbr }}
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right flex flex-col md:block">
                    @if($newTag == false && $editTag == false && $deleteConfirmTag == false)
                        <button {{ $disableEditTag }} wire:click="tagEdit" class="disabled:opacity-50 text-blue-600 hover:text-blue-900 mb-2 mr-2">Edit</button>
                        <button {{ $disableEditTag }} {{ $disableDeleteTag }} wire:click="tagDelete" class="disabled:opacity-50 text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Delete</button>
                    @elseif($newTag == true)
                        <button {{ $disableEmpty }} wire:click="newTagAccept" class="disabled:opacity-50 text-blue-600 hover:text-blue-900 mb-2 mr-2">Accept</button>
                        <button wire:click="newTagCancel" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Cancel</button>
                    @elseif($editTag == true)
                        <button {{ $disableEmpty }} wire:click="editTagAccept" class="disabled:opacity-50 text-blue-600 hover:text-blue-900 mb-2 mr-2">Accept</button>
                        <button wire:click="editTagCancel" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Cancel</button>
                    @elseif($deleteConfirmTag == true)
                        <button wire:click="tagDeleteConfirm" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Yes</button>
                        <button wire:click="tagDeleteCancel" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">No</button>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
