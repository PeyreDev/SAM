<div>
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
    </div>

    <form action="{{ route('cvrs.store') }}" method="post">
        @csrf
        <div class="max-w-6xl mx-auto py-10 pb-5 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-row sm:justify-between items-center mb-8">
                <a href="{{ route('samples.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to samples list</a>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Accept</button>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row w-full sm:justify-center pt-3">
                                <p class="ml-2">
                                    Recipe name : <input class="h-8 w-80 rounded-lg" type="text" name="recipe_name" value="{{ old('recipe_name') }}">
                                </p>
                            </div>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-around">
                                <legend class="bg-white rounded-lg px-1">Information</legend>
                                <div class="flex flex-row rounded-lg items-center pr-4">
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-5">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Position
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40" type="text" name="position" value="{{ old('position') }}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="divide-gray-200 flex flex-row rounded-lg pl-5">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Equipment
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select wire:model="equipSelectedId" wire:change="selectEquip" class="h-6 text-sm rounded-lg w-full pt-0" name="equipment_id" id="">
                                                    <option hidden selected value="">--Choose equipment--</option>
                                                    @foreach($equipments as $equipment)
                                                        <option @if($equipment->id == old('equipment_id')) selected @endif value="{{ $equipment->id }}">{{ $equipment->model }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Comment</legend>
                                <p class="text-sm bg-white rounded-lg h-20 mr-1 p-0">
                                    <textarea class="h-full w-full rounded-lg text-sm" name="comment">{{ old('comment') }}</textarea>
                                </p>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Motivation</legend>
                                <p class="text-sm bg-white rounded-lg h-20 mr-1 p-0">
                                    <textarea class="h-full w-full rounded-lg" name="motivation">{{ old('motivation') }}</textarea>
                                </p>
                            </fieldset>
                            @for($i = 1; $i <= $nbrStep; $i++) {{-- $i = 1 because add cvr included add minimum 1 cvr step --}}
                                <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-col items-center">
                                    <legend class="bg-white rounded-lg px-1">Cvr step information</legend>
                                    <div class="flex flex-row sm:justify-between pb-5">
                                        <table class="divide-gray-200 rounded-lg pr-5 flex flex-row">
                                            <thead>
                                            <tr class="flex flex-col">
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                    Pressure
                                                </th>
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                    Duration
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                            <tr class="flex flex-col">
                                                <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <input name="pressure.{{$i}}" class="h-6 rounded-lg w-40" type="text" >
                                                </td>
                                                <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <input name="duration.{{$i}}" class="h-6 rounded-lg w-40 pt-0" type="time" step="1">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="divide-gray-200 rounded-lg pr-5 flex flex-row">
                                            <thead>
                                            <tr class="flex flex-col">
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                    Temperature initial
                                                </th>
                                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                    Temperature final
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                            <tr class="flex flex-col">
                                                <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <input class="h-6 rounded-lg w-40" type="text" name="temperature_initial.{{$i}}">
                                                </td>
                                                <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    <input class="h-6 rounded-lg w-40 pt-0" type="text" name="temperature_final.{{$i}}">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-5">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Material
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select class="h-6 pt-0 rounded-lg" name="material.{{$i}}" id="">
                                                    <option hidden value="">--Choose material--</option>
                                                    @foreach($tagsMaterial as $tagMaterial)
                                                        <option
                                                            @if(isset($relatedTagMaterial->id))
                                                            @if($tagMaterial->id == old('material', $relatedTagMaterial->id))
                                                            selected
                                                            @endif
                                                            @endif
                                                            value="{{ $tagMaterial->id }}">{{ $tagMaterial->keyword }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @if(isset($flowsPerStep[$i]))
                                    @for($a = 0; $a < $flowsPerStep[$i]; $a++)
                                    {{-- we go through the loop as long as the number of flows corresponding to the step is not reached --}}
                                        <fieldset  class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex items-center w-full">
                                            <legend class="bg-white rounded-lg px-1">Flows information</legend>
                                            <div class="w-1/2 flex flex-col">
                                                <span class="flex items-center">
                                                    <span class="pr-2">Inject initial value : </span>
                                                    <input class="h-6 rounded-lg w-40 pt-0" type="text" name="inject_initial_value.{{$i}}.{{$a}}">
                                                </span>
                                                <span class="flex items-center pt-5">
                                                    <span class="pr-2">Select gas line : </span>
                                                    <select class="h-6 pt-0 rounded-lg" name="gas_line_id.{{$i}}.{{$a}}" id="">
                                                        <option selected hidden value="">--Choose species--</option>
                                                        @if($equipSelectedId != null)
                                                            @foreach($gasLines as $gasLine)
                                                                <option value="{{ $gasLine->id }}">{{ $gasLine->latestSource()->first()->precursor()->first()->species }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </span>
                                            </div>
                                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex items-center w-1/2">
                                                <legend class="bg-white rounded-lg px-1">Special flow information</legend>
                                                <table class="flex flex-row divide-gray-200 rounded-lg">
                                                    <thead>
                                                    <tr class="flex flex-col">
                                                        <th class="w-48 px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                            Inject final value
                                                        </th>
                                                        <th class="w-48 px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            MO pressure
                                                        </th>
                                                        <th class="w-48 px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            MO temp
                                                        </th>
                                                        <th class="w-48 px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Dilute value
                                                        </th>
                                                        <th class="w-48 px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                            Source value
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                                    <tr class="flex flex-col">
                                                        <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                            <input class="h-6 rounded-lg w-40" type="text" name="inject_final_value.{{$i}}.{{$a}}">
                                                        </td>
                                                        <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                            <input class="h-6 rounded-lg w-40" type="text" name="MO_pressure.{{$i}}.{{$a}}">
                                                        </td>
                                                        <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                            <input class="h-6 rounded-lg w-40" type="text" name="MO_temperature.{{$i}}.{{$a}}">
                                                        </td>
                                                        <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                            <input class="h-6 rounded-lg w-40" type="text" name="dilute_value.{{$i}}.{{$a}}">
                                                        </td>
                                                        <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                            <input class="h-6 rounded-lg w-40" type="text" name="source_value.{{$i}}.{{$a}}">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </fieldset>
                                        </fieldset>
                                    @endfor
                                    @endif
                                    <div class="flex flex-row sm:justify-end w-full">
                                        <button @if($nbrStep > $i) disabled @endif wire:click="addFlow" type="button" class="disabled:opacity-50 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add flow</button>
                                    </div>
                                </fieldset>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="flex flex-row sm:justify-end items-center mb-8 pr-8">
        <button wire:click="addStep" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add step</button>
    </div>
</div>
