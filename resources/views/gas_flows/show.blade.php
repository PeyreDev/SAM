<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gas Flow View
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="block mb-8">
                <a href="{{ route('cvr_steps.show', $gasFlow->cvr_step_id) }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to CVR step</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-col justify-around">
                                <legend class="bg-white rounded-lg px-1">Flows information</legend>
                                <div class="flex justify-around">
                                    <span class="bg-white px-2 py-1 rounded-lg">
                                        Inject initial value : {{ $gasFlow->inject_initial_value }}
                                    </span>
                                    @if(isset($gasFlow->special_flow_id))
                                        @if(isset($gasFlow->specialFlow->inject_final_value))
                                            <span class="bg-white px-2 py-1 rounded-lg">Inject final value : {{ $gasFlow->specialFlow->inject_final_value }}</span>
                                        @endif

                                        @if(isset($gasFlow->specialFlow->MO_pressure))
                                            <span class="bg-white px-2 py-1 rounded-lg">MO pressure : {{ $gasFlow->specialFlow->MO_pressure }}</span>
                                        @endif

                                        @if(isset($gasFlow->specialFlow->MO_temperature))
                                            <span class="bg-white px-2 py-1 rounded-lg">MO temperature : {{ $gasFlow->specialFlow->MO_temperature }}</span>
                                        @endif

                                        @if(isset($gasFlow->specialFlow->dilute_value))
                                            <span class="bg-white px-2 py-1 rounded-lg">Dilute value : {{ $gasFlow->specialFlow->dilute_value }}</span>
                                        @endif

                                        @if(isset($gasFlow->specialFlow->source_value))
                                            <span class="bg-white px-2 py-1 rounded-lg">Source value : {{ $gasFlow->specialFlow->source_value }}</span>
                                        @endif
                                    @endif
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-col justify-around">
                                <legend class="bg-white rounded-lg px-1">Source information</legend>
                                <div class="flex flex-row w-full sm:justify-between pb-5">
                                    <p class="ml-2">
                                        Source (reference) : {{ $source->reference }}
                                    </p>
                                    <p class="mr-2">
                                        @if($source->supplier != null)
                                            Supplier : {{ $source->supplier }}
                                        @else
                                            Supplier : N/A
                                        @endif
                                    </p>
                                </div>
                                <div class="flex flex-row justify-around">
                                    <div class="flex flex-row rounded-lg items-center pr-4">
                                        <table class="divide-gray-200 flex flex-row rounded-lg">
                                            <thead>
                                            <tr class="flex flex-col">
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                    Species
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Quantity
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                    Manufacturing date
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                            <tr class="flex flex-col">
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    {{ $source->precursor->species }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    {{ $source->quantity }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    {{date_format(new DateTime($source->manufacturing_date), 'Y-m-d')}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex flex-row rounded-lg items-center pl-4">
                                        <table class="divide-gray-200 flex flex-row">
                                            <thead>
                                            <tr class="flex flex-col">
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                    Purity
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Dilution
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                    Conditioning
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                            <tr class="flex flex-col">
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    {{ $source->purity }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    @if($source->dilution != null)
                                                        {{ $source->dilution }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                    @switch($source->conditionning)
                                                        @case(0)
                                                        BL
                                                        @break
                                                        @case(1)
                                                        B5
                                                        @break
                                                        @case(2)
                                                        B10
                                                        @break
                                                        @case(3)
                                                        B20
                                                        @break
                                                        @case(4)
                                                        B50
                                                        @break
                                                        @case(5)
                                                        Cadre 9
                                                        @break
                                                        @case(6)
                                                        Cadre 11
                                                        @break
                                                        @case(7)
                                                        Container Inox
                                                        @break
                                                    @endswitch
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Gas line information</legend>
                                <table class="min-w-full divide-y divide-gray-200 w-full">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center rounded-tl-lg">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                            Install date
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                            Remove date
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                            Max inject
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                            Max source
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                            Max dilute
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                            Date in
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center rounded-tr-lg">
                                            Date out
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ $gasLine->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ date_format(new DateTime($gasLine->install_date), 'Y-m-d') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @if($gasLine->remove_date != null)
                                                {{ date_format(new DateTime($gasLine->remove_date), 'Y-m-d') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ $gasLine->max_inject }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @if($gasLine->max_source != null)
                                                {{ $gasLine->max_source }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @if($gasLine->max_dilute != null)
                                                {{ $gasLine->max_dilute }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @foreach($gaslinesources as $gaslinesource)
                                                @if($gaslinesource->gas_line_id == $gasLine->id && $gaslinesource->source_id == $source->id)
                                                    {{ date_format(new DateTime($gaslinesource->date_in), 'Y-m-d') }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @foreach($gaslinesources as $gaslinesource)
                                                @if($gaslinesource->gas_line_id == $gasLine->id && $gaslinesource->source_id == $source->id)
                                                    @if($gaslinesource->date_out != null)
                                                        {{ date_format(new DateTime($gaslinesource->date_out), 'Y-m-d') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                @endif
                                            @endforeach
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
    </div>

</x-app-layout>
