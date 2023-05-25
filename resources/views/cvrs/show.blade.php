<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cvr View
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="block mb-8">
                <a href="{{ route('cvrs.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row items-center w-full sm:justify-between pt-3">
                                <p class="ml-2">
                                    Recipe name : <span class="text-blue-400 pl-3 pr-20"> {{ $cvr->recipe_name }} </span>
                                </p>
                                <div class="flex flex-col w-60">
                                    <p class="mr-4 mb-2 h-8 flex sm:justify-between items-center">
                                        <span class="w-28">Process type : </span>
                                        <span class="text-white bg-red-400 py-1 px-2 rounded-lg">
                                            @if(isset($tag->keyword))
                                                {{ $tag->keyword }}
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </p>
                                    <p class="mr-4 h-8 flex sm:justify-between items-center">
                                        <span class="w-28">#Cvr steps : </span>
                                        <span class="mr-5">{{ $cvr->cvrSteps->count() }}</span>
                                    </p>
                                </div>
                            </div>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-around">
                                <legend class="bg-white rounded-lg px-1">Information</legend>
                                <div class="flex flex-row rounded-lg items-center pr-4">
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-5">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Position
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                {{ $cvr->position }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="divide-gray-200 flex flex-row rounded-lg pl-5">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Equipment
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                @foreach($equipments as $equipment)
                                                    @if($equipment->id == $cvr->equipment_id)
                                                        {{ $equipment->model }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Comment</legend>
                                <p class="text-sm bg-white rounded-lg h-20 p-3 mr-1">
                                    @if($cvr->comment != null)
                                        {{ $cvr->comment }}
                                    @else
                                            N/A
                                    @endif
                                </p>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Motivation</legend>
                                <p class="text-sm bg-white rounded-lg h-20 p-3 mr-1">
                                    @if($cvr->motivation != null)
                                        {{ $cvr->motivation }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Associated cvr steps</legend>
                                <table class="divide-gray-200 rounded-lg pr-5">
                                    <thead class="flex">
                                    <tr>
                                        <th class="text-center w-32 px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                            Pressure
                                        </th>
                                        <th class="text-center w-28 px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Duration
                                        </th>
                                        <th class="text-center w-52 px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Temperature
                                        </th>
                                        <th class="text-center w-32 px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                            Material
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 rounded-b-lg flex flex-col-reverse">
                                    @foreach($cvrSteps as $cvrStep)
                                        <tr>
                                            <td class="text-center w-32 px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                {{ $cvrStep->pressure }}
                                            </td>
                                            <td class="text-center w-28 px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                {{ $cvrStep->duration }}
                                            </td>
                                            <td class="text-center w-52 px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                @if($cvrStep->temperature_final == null || $cvrStep->temperature_final == $cvrStep->temperature_initial)
                                                    {{ $cvrStep->temperature_initial }}
                                                @elseif($cvrStep->temperature_final != null && $cvrStep->temperature_final != $cvrStep->temperature_initial)
                                                    Ramp from {{ $cvrStep->temperature_initial }} to {{ $cvrStep->temperature_final }}
                                                @endif
                                            </td>
                                            <td class="text-center w-32 px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                @if(isset($cvrStep->tags->first()->keyword))
                                                    {{ $cvrStep->tags->first()->keyword }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
