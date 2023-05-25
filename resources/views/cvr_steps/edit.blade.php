<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Cvr step
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
    </div>

    <form action="{{ route('cvr_steps.update', $cvrStep->id) }}" method="post">
        @csrf
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-row sm:justify-between items-center mb-8">
                <a href="{{ route('cvr_steps.show', $cvrStep->id) }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back</a>
                <input type="hidden" name="_method" value="PUT">
                <button onclick="return confirm('Are you sure ?');" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Confirm</button>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row w-full sm:justify-center pt-3">
                                <p class="ml-2">
                                    Recipe name : <input class="h-8 w-80 rounded-lg" type="text" name="recipe_name" value="{{ old('recipe_name', $cvr->recipe_name) }}">
                                </p>
                            </div>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-around">
                                <legend class="bg-white rounded-lg px-1">Cvr information</legend>
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
                                                <input class="h-6 rounded-lg w-40" type="text" name="position" value="{{ old('position', $cvr->position) }}">
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
                                                <select class="h-6 text-sm rounded-lg w-full pt-0" name="equipment_id" id="">
                                                    <option hidden selected value="">--Choose equipment--</option>
                                                    @foreach($equipments as $equipment)
                                                        <option @if($equipment->id == old('equipment_id', $cvr->equipment_id)) selected @endif value="{{ $equipment->id }}">{{ $equipment->model }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Cvr comment</legend>
                                <p class="text-sm bg-white rounded-lg h-20 mr-1 p-0">
                                    <textarea class="h-full w-full rounded-lg text-sm" name="comment">{{ old('comment', $cvr->comment) }}</textarea>
                                </p>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Cvr motivation</legend>
                                <p class="text-sm bg-white rounded-lg h-20 mr-1 p-0">
                                    <textarea class="h-full w-full rounded-lg text-sm" name="motivation">{{ old('motivation', $cvr->motivation) }}</textarea>
                                </p>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex justify-center">
                                <legend class="bg-white rounded-lg px-1">Cvr process</legend>
                                <table class="divide-gray-200 flex flex-row rounded-lg pr-5">
                                    <thead>
                                    <tr>
                                        <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                            Process type
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                    <tr>
                                        <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                            <select class="h-6 pt-0 rounded-lg" name="process_type" id="">
                                                <option hidden value="">--Choose a process type--</option>
                                                @foreach($tagsCvr as $tagCvr)
                                                    <option @if($tagCvr->id == old('process_type', $relatedTagCvr->id)) selected @endif value="{{ $tagCvr->id }}">{{ $tagCvr->keyword }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </fieldset>
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
                                                <input name="pressure" class="h-6 rounded-lg w-40" type="text" value="{{ old('pressure', $cvrStep->pressure) }}">
                                            </td>
                                            <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input name="duration" class="h-6 rounded-lg w-40 pt-0" type="time" step="1" value="{{ old('duration', $cvrStep->duration) }}">
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
                                                <input class="h-6 rounded-lg w-40" type="text" name="temperature_initial" value="{{ old('temperature_initial', $cvrStep->temperature_initial) }}">
                                            </td>
                                            <td class="text-center px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40 pt-0" type="text" name="temperature_final" value="{{ old('temperature_final', $cvrStep->temperature_final) }}">
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
                                            <select class="h-6 pt-0 rounded-lg" name="material" id="">
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
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>
