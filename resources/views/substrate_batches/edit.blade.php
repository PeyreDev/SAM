<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add a Substrate Batch
        </h2>
    </x-slot>

    <div>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="font-bold">Warning!</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('substrate_batches.update', $substrateBatch->id) }}">
            @csrf
            <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
                <div class="flex flex-row sm:justify-between items-center mb-8">
                    <a href="{{ route('substrate_batches.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Cancel and back to list</a>
                    <div>
                        Initial quantity :<input class="ml-2 h-8 w-20 rounded-md text-center" name="initial_quantity" id="initial_quantity" type="text" value="{{ old('initial_quantity', $substrateBatch->initial_quantity) }}">
                    </div>
                    <div>
                        Remaining quantity :<input class="ml-2 h-8 w-20 rounded-md text-center" name="remaining_quantity" id="remaining_quantity" type="text" value="{{ old('remaining_quantity', $substrateBatch->remaining_quantity) }}">
                    </div>
                    <input hidden type="text" name="user_id">
                    <input type="hidden" name="_method" value="PUT">
                    <button onclick="return confirm('Are you sure ?');" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Confirm</button>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                <div class="flex flex-row w-full sm:justify-between pt-3">
                                    <p class="ml-2">
                                        Substrate batch name : <input name="name" id="name" class="h-8 rounded-md" type="text" value="{{ old('name', $substrateBatch->name) }}">
                                    </p>
                                    <p class="mr-2">
                                        Provider : <input name="provider" class="h-8 rounded-md" type="text" value="{{ old('provider', $substrateBatch->provider) }}">
                                    </p>
                                </div>
                                <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                    <legend class="bg-white rounded-lg px-1">Main information</legend>
                                    <div class="flex flex-row rounded-lg items-center">
                                        <table class="divide-gray-200 flex flex-row rounded-lg">
                                            <thead>
                                            <tr class="flex flex-col">
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                    Material
                                                </th>
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Thickness
                                                </th>
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Resistivity
                                                </th>
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Orientation
                                                </th>
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Miscut
                                                </th>
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                    Element size
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                            <tr class="flex flex-col">
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <select class="h-6 text-sm rounded-md pt-0 w-full" name="material" id="material">
                                                        @foreach($materials as $material)
                                                            <option @if($substrateBatch->material == $material->id) selected="selected" @endif value="{{ $material->id }}">{{ $material->keyword }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{--<input name="material" class="h-5 text-sm rounded-md" type="text">--}}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <input name="thickness" class="h-6 text-sm rounded-md" type="text" value="{{ old('thickness', $substrateBatch->thickness) }}"> µm
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <input name="resistivity" class="h-6 text-sm rounded-md" type="text" value="{{ old('resistivity', $substrateBatch->resistivity) }}"> ohm.cm
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <select class="h-6 text-sm rounded-md pt-0 w-full" name="orientation" id="orientation">
                                                        @foreach($orientations as $orientation)
                                                            <option @if($substrateBatch->orientation == $orientation->id) selected="selected" @endif value="{{ $orientation->id }}">{{ $orientation->keyword }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <input name="miscut" class="h-6 text-sm rounded-md" type="text" value="{{ old('miscut', $substrateBatch->miscut) }}"> degrees
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <input name="element_size" class="h-6 text-sm rounded-md" type="text" value="{{ old('element_size', $substrateBatch->element_size) }}">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <fieldset class="border-2 border-gray-400 m-2 rounded-lg h-full p-2 ml-12 mr-2 px-3 pb-3">
                                            <legend class="bg-white rounded-lg px-1">Doping</legend>
                                            <table class="divide-gray-200 flex flex-row">
                                                <thead>
                                                <tr class="flex flex-col">
                                                    <th class="px-6 py-6 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                        Doping
                                                    </th>
                                                    <th class="px-6 py-6 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Doping type
                                                    </th>
                                                    <th class="px-6 py-6 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                        Doping element
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                                <tr class="flex flex-col">
                                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                                        <input name="doping" class="h-7 text-sm rounded-md" type="text" value="{{ old('doping', $substrateBatch->doping) }}"> cm-3
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                                        <select class="h-7 text-sm rounded-md pt-0.5 w-full" name="doping_type" id="doping_type">
                                                            <option hidden value="-1">--Choose type--</option>
                                                            <option @if($substrateBatch->doping_type == 0) selected="selected" @endif value="0">Undoped</option>
                                                            <option @if($substrateBatch->doping_type == 1) selected="selected" @endif value="1">Type n</option>
                                                            <option @if($substrateBatch->doping_type == 2) selected="selected" @endif value="2">Type p</option>
                                                        </select>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                                        <input name="doping_element" class="h-7 text-sm rounded-md" type="text" value="{{ old('doping_element', $substrateBatch->doping_element) }}">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </fieldset>
                                    </div>
                                </fieldset>
                                <div class="shadow overflow-hidden bg-white">
                                    <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                        <legend class="bg-white rounded-lg px-1">Comment</legend>
                                        <p class="text-sm bg-white rounded-lg h-20 mr-1">
                                            <textarea name="comment" class="h-full w-full text-sm rounded-lg" type="text"> {{ $substrateBatch->comment }} </textarea>
                                        </p>
                                    </fieldset>
                                </div>
                                <div class="shadow overflow-hidden bg-white">
                                    <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                        <legend class="bg-white rounded-lg px-1">Mapping</legend>
                                        <div class="flex justify-center items-center">
                                            <p class="pr-4">Path :</p>
                                            <input name="mapping" class="w-3/4 rounded-md h-8" type="text" value="{{ old('mapping', $substrateBatch->mapping) }}">
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
