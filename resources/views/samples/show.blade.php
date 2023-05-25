<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View sample
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="block mb-8">
                <a href="{{ route('samples.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row w-full sm:justify-between items-center pt-3">
                                <p class="ml-2 flex flex-col">
                                    <span>Sample consulted : <span class="text-blue-600">{{ $sample->name }}</span></span>
                                    {{ session(['sampleId' => $sample->id]) }}
                                    <span>
                                        Sample type :
                                        @foreach($sampleTags as $key => $sampleTag)
                                            {{ $sampleTag->keyword }}
                                            @if($sampleTags->count() > 1 && $key != ($sampleTags->count())-1) {{-- index of count() begin at 1 and index of $key begin at 0 => count()-1 --}}
                                                /
                                            @endif
                                        @endforeach
                                    </span>
                                </p>
                                <p class="mr-2 flex flex-col w-80 items-end">
                                    <span>
                                        @if($sample->available == 1)
                                            Available : Yes
                                        @elseif($sample->available == 0)
                                            Available : No
                                        @endif
                                    </span>
                                    <span>
                                        @if($sample->scraped == 1)
                                            Scraped : Yes
                                        @elseif($sample->scraped == 0)
                                            Scraped : No
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-around">
                                <legend class="bg-white rounded-lg px-1">Information</legend>
                                <div class="flex flex-row rounded-lg items-center pr-4">
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-3">
                                        <thead>
                                        <tr class="flex flex-col">
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                Size
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                Localisation
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr class="flex flex-col">
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                {{ $sample->size }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <a href="" class="hover:underline text-blue-400">
                                                    @if(isset($sample->latestLocalisation->description))
                                                        {{ $sample->latestLocalisation->description }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="divide-gray-200 flex flex-row rounded-lg pl-3">
                                        <thead>
                                        <tr class="flex flex-col">
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                Parent name
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                Parent position
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr class="flex flex-col">
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                {{ $parentName }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                @if($sample->parent_position != null)
                                                    {{ $sample->parent_position }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-around">
                                <legend class="bg-white rounded-lg px-1">Comment</legend>
                                <p class="text-sm bg-white rounded-lg h-20 w-full p-3 mr-1">
                                    {{ $sample->comment }}
                                </p>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pt-2 pl-6 bg-gray-200 border-gray-400 flex flex-col justify-around">
                                <legend class="bg-white rounded-lg px-1">Process steps</legend>
                                <div class="w-full flex justify-end">
                                    <span class="bg-white border-2 border-blue-400 rounded-md py-1 px-3">Parent steps</span>
                                </div>
                                <div class="min-w-full w-full mt-4">
                                    @foreach($processSteps as $processStep)
                                        @if($processStep->related_type == 'App\Models\Cvr')
                                            @foreach($cvrsteps as $cvrstep)
                                                @if($cvrstep->cvr_id == $processStep->related_id)
                                                    <div class="w-full bg-white rounded-lg flex sm:justify-between items-center h-16 px-5 mb-2 shadow-lg">
                                                        <span class="w-36 border-r border-gray-400">
                                                            CVR (Step)
                                                        </span>
                                                        <div class="flex flex-col items-center w-80 pl-4">
                                                            <div class="flex flex-row">
                                                                @if(isset($cvrstep->tags->first()->keyword))
                                                                    <span class="w-40">
                                                                        Material : {{ $cvrstep->tags->first()->keyword}}
                                                                    </span>
                                                                @endif
                                                                <span class="w-40">
                                                                    Duration : {{ $cvrstep->duration }}
                                                                </span>
                                                            </div>
                                                            <span class="w-60 text-center">
                                                                @if($cvrstep->temperature_final == null || $cvrstep->temperature_final == $cvrstep->temperature_initial)
                                                                    Temp : {{ $cvrstep->temperature_initial }}
                                                                @elseif($cvrstep->temperature_final != null && $cvrstep->temperature_final != $cvrstep->temperature_initial)
                                                                    Temp : Ramp from {{ $cvrstep->temperature_initial }} to {{ $cvrstep->temperature_final }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <span class="border-l border-gray-400 pl-2">
                                                            Date : {{ $processStep->date }}
                                                        </span>
                                                        <a name="view" id="view" href="{{ route('cvr_steps.show', $cvrstep->id) }}" class="text-blue-600 hover:text-blue-900 ml-5">View</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="w-full bg-white rounded-lg flex sm:justify-between items-center h-8 px-5 mb-2 shadow-lg">
                                                <span class="w-36 border-r border-gray-400">
                                                    @switch($processStep->related_type)
                                                        @case('App\Models\Substrate')
                                                            Substrate
                                                            @break
                                                        @case('App\Models\Split')
                                                            Split
                                                            @break
                                                        @case('App\Models\External_sample')
                                                            External sample
                                                            @break
                                                        @case('App\Models\Cleaning')
                                                            Cleaning
                                                            @break
                                                    @endswitch
                                                </span>
                                                <div>
                                                    <span class="border-l border-gray-400 pl-2">
                                                        Date : {{ $processStep->date }}
                                                    </span>
                                                    @if($processStep->related_type == 'App\Models\Substrate')
                                                        <a name="view" id="view" href="{{ route('substrates.show', $processStep->related_id) }}" class="text-blue-600 hover:text-blue-900 ml-4">View</a>
                                                    @elseif($processStep->related_type == 'App\Models\Split')
                                                        <a name="view" id="view" href="" class="text-blue-600 hover:text-blue-900 ml-4">View</a>
                                                    @elseif($processStep->related_type == 'App\Models\Cleaning')
                                                        <a name="view" id="view" href="" class="text-blue-600 hover:text-blue-900 ml-4">View</a>
                                                    @elseif($processStep->related_type == 'App\Models\External_sample')
                                                        <a name="view" id="view" href="" class="text-blue-600 hover:text-blue-900 ml-4">View</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @foreach($parentSteps as $parentStep)
                                        @if($parentStep->related_type == 'App\Models\Cvr')
                                            @foreach($cvrsteps as $cvrstep)
                                                @if($cvrstep->cvr_id == $parentStep->related_id)
                                                    <div class="w-full rounded-lg flex sm:justify-between items-center h-16 px-5 mb-2 border-2 border-blue-400 bg-white">
                                                        <span class="w-36 border-r border-gray-400">
                                                            CVR (Step)
                                                        </span>
                                                        <div class="flex flex-col items-center w-80 pl-4">
                                                            <div class="flex flex-row">
                                                                @if(isset($cvrstep->tags->first()->keyword))
                                                                    <span class="w-40">
                                                                    Material : {{ $cvrstep->tags->first()->keyword}}
                                                                    </span>
                                                                @endif
                                                                <span class="w-40">
                                                                Duration : {{ $cvrstep->duration }}
                                                                </span>
                                                            </div>
                                                            <span class="w-60 text-center">
                                                                @if($cvrstep->temperature_final == null || $cvrstep->temperature_final == $cvrstep->temperature_initial)
                                                                    Temp : {{ $cvrstep->temperature_initial }}
                                                                @elseif($cvrstep->temperature_final != null && $cvrstep->temperature_final != $cvrstep->temperature_initial)
                                                                    Temp : Ramp from {{ $cvrstep->temperature_initial }} to {{ $cvrstep->temperature_final }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <span class="border-l border-gray-400 pl-2">
                                                            Date : {{ $parentStep->date }}
                                                        </span>
                                                        <a name="view" id="view" href="{{ route('cvr_steps.show', $cvrstep->id) }}" class="text-blue-600 hover:text-blue-900 ml-5">View</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="w-full border-2 border-blue-400 rounded-lg flex sm:justify-between items-center h-8 px-5 mb-2 bg-white">
                                                <span class="w-36 border-r border-gray-400">
                                                    @switch($parentStep->related_type)
                                                        @case('App\Models\Substrate')
                                                            Substrate
                                                            @break
                                                        @case('App\Models\Split')
                                                            Split
                                                            @break
                                                        @case('App\Models\External_sample')
                                                            External sample
                                                            @break
                                                        @case('App\Models\Cleaning')
                                                            Cleaning
                                                            @break
                                                    @endswitch
                                                </span>
                                                <div>
                                                    <span class="border-l border-gray-400 pl-2">
                                                        Date : {{ $parentStep->date }}
                                                    </span>
                                                    <a name="view" id="view" href="{{ route('cvr_steps.show', $parentStep->id) }}" class="text-blue-600 hover:text-blue-900 ml-4">View</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
