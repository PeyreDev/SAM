<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Substrate Batch View
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="block mb-8">
                <a href="{{ route('substrate_batches.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row w-full sm:justify-between pt-3">
                                <p class="ml-2 font-bold">
                                    Substrate batch consulted : <span class="font-medium text-blue-500">{{ $substrateBatch->name }}</span>
                                </p>
                                <p class="mr-2">
                                    @if($substrateBatch->provider != null)
                                        Provider : {{ $substrateBatch->provider }}
                                    @else
                                        Provider : N/A
                                    @endif
                                </p>
                            </div>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Main information</legend>
                                <div class="flex flex-row rounded-lg items-center">
                                    <table class="divide-gray-200 flex flex-row rounded-lg">
                                        <thead>
                                        <tr class="flex flex-col">
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                Material
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Thickness
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Resistivity
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Orientation
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Miscut
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                Element size
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr class="flex flex-col">
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                {{ $substrateBatch->tagMaterial->keyword }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                @if($substrateBatch->thickness != 0 && $substrateBatch->thickness != null)
                                                    {{ $substrateBatch->thickness }} µm
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                @if($substrateBatch->resistivity != 0 && $substrateBatch->resistivity != null)
                                                    {{ $substrateBatch->resistivity }} ohm.cm
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                {{ $substrateBatch->tagOrientation->keyword }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                @if($substrateBatch->miscut != 0 && $substrateBatch->miscut != null)
                                                    {{ $substrateBatch->miscut }} degrees
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                @if($substrateBatch->element_size != null)
                                                    {{ $substrateBatch->element_size }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex flex-col items-center">
                                        <div class="h-10">
                                            Remaining quantity : {{ $substrateBatch->remaining_quantity }} / {{ $substrateBatch->initial_quantity }}
                                        </div>
                                        <fieldset class="border-2 border-gray-400 m-2 rounded-lg h-full p-2 ml-12 mr-2 px-3 pb-3">
                                            <legend class="bg-white rounded-lg px-1">Doping</legend>
                                            <table class="divide-gray-200 flex flex-row">
                                                <thead>
                                                <tr class="flex flex-col">
                                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                        Doping
                                                    </th>
                                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Doping type
                                                    </th>
                                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                        Doping element
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                                <tr class="flex flex-col">
                                                    <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                        @if($substrateBatch->doping != 0 && $substrateBatch->doping != null)
                                                            {{ $substrateBatch->doping }} cm-3
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                        @switch($substrateBatch->doping_type)
                                                            @case(0)
                                                            Undoped
                                                            @break
                                                            @case(1)
                                                            Type n
                                                            @break
                                                            @case(2)
                                                            Type p
                                                            @break
                                                            @case(null)
                                                            N/A
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                        @if($substrateBatch->doping_element != null && $substrateBatch->doping_element != 0)
                                                            {{ $substrateBatch->doping_element }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </fieldset>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="shadow overflow-hidden bg-white">
                                <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                    <legend class="bg-white rounded-lg px-1">Comment</legend>
                                    <p class="text-sm bg-white rounded-lg h-20 p-3 mr-1">
                                        @if($substrateBatch->comment != null)
                                            {{ $substrateBatch->comment }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </fieldset>
                            </div>
                            <div class="shadow overflow-hidden bg-white">
                                <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                    <legend class="bg-white rounded-lg px-1">Mapping</legend>
                                    <div class="flex justify-center">
                                        <img class="max-w-lg" src="{{ asset($substrateBatch->mapping) }}" alt="Mapping">
                                    </div>
                                </fieldset>
                                <p class="ml-2 pb-3 flex sm:justify-center">
                                    <span>Created by : {{ $user->name }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
