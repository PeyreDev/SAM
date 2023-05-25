<div>
    {{-------------------------------------------------------------------------------------------------------------------------------------------------------------}}
    {{--       O.BRIOT 10/06/2021   v1.0    User files management                                                                                                --}}
    {{-------------------------------------------------------------------------------------------------------------------------------------------------------------}}
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NAME/PATH
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    COMMENT
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ACTIONS
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($documents as $document)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <input type="checkbox" wire:model="selected.{{$document->id}}" id="{{$document->id}}" name="name" value="{{$document->id}}">
                                        <label for="name">{{ str_replace($stringtoremove, '', $document->path)  }}</label><br>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $document->name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click=""
                                                class="bg-gray-400 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Edit</button>
                                        @if ($confirming[$document->id] == $document->id)
                                            <button wire:click="kill({{ $document->id }}, true)"
                                                    class="bg-red-800 text-white w-15 px-4 py-1 hover:bg-blue-200 rounded border">Yes</button>
                                            <button wire:click="kill({{ $document->id }}, false)"
                                                    class="bg-green-800 text-white w-15 px-4 py-1 hover:bg-blue-200 rounded border">No</button>
                                        @else
                                            <button wire:click="confirmDelete({{ $document->id }})"
                                                    class="bg-gray-400 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Delete</button>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            {{ $documents->links() }}
        </div>

        <div x-data="{view_open: @entangle('isLoadVisible'), filename: 'no file selected yet'}" class="block mt-5 center">
            <button wire:click="" class="bg-blue-400 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Copy</button>
            <button @click="view_open = true" class="bg-blue-400 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Open</button>
            <label>
                <span class="bg-blue-400 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Save</span>
                <input type='file' wire:model="filesave" multiple class="hidden" />
            </label>
            <button wire:click="$emit('closeModal')" class="bg-blue-600 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Close</button>
            {{-- Open files form, not visible until activated--}}
            <fieldset x-show="view_open" class="bg-gray-200 mt-5 rounded px-2 py-2">
                <div class="text-gray-500 mt-1"><i>Upload document to user space</i></div>
                <form wire:submit.prevent="upload">
                    <div class="mt-4">
                        <label>
                            <span class="bg-blue-400 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Select file...</span>
                            <input type='file' wire:model="fileload" class="hidden" />
                        </label>
                        <span class="text-blue-600">{{$filename}}</span>
                        @error('fileload') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="mt-4">
                        <input type="text" name="description" id="description" wire:model="description"
                               class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="document description ...">
                        @error('description') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-400 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Upload</button>
                        <button @click="view_open = false" class="bg-blue-600 text-white w-20 px-4 py-1 hover:bg-blue-200 rounded border">Close</button>
                    </div>
                </form>
            </fieldset>
        </div>

    </div>
