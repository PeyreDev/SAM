<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex flex-row justify-between items-center mb-8">
            <p class="flex flex-row justify-start items-center w-full">
                <span>Process step :</span>
                <select wire:model="selectedProcess" class="h-8 w-60 rounded-lg pt-1 ml-5" name="process_step" id="">
                    <option selected hidden value="">--Choose Process step--</option>
                    <option value="cvr">CVR</option>
                    <option value="split">Split</option>
                    <option value="cleaning">Cleaning</option>
                </select>
                <a @if($selectedProcess == null || $selectedSamples == null) hidden @endif class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 ml-5 rounded"
                   @switch($selectedProcess)
                       @case('cvr')
                            href="{{ route('cvrs.create') }}"
                            @break
                       @case('split')
                            href="{{ route('splits.create') }}"
                            @break
                       @case('cleaning')
                            href="{{ route('cleanings.create') }}"
                            @break
                   @endswitch
                >Create</a>
            </p>
            <div class="mr-1 flex flex-col w-2/3 items-end">
                <span>Available : <input wire:model="checkAvailable" wire:click="available" type="checkbox"></span>
                <span>Scraped : <input wire:model="checkScraped" wire:click="scraped" type="checkbox"></span>
                <span class="bg-blue-200 rounded-lg py-0.5 px-1.5 mt-1">External sample</span>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">

                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Size
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    #Steps
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Creation date
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Last modification
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Available
                                </th>
                                <th scope="col" width="150" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($samples as $sample)
                                <tr
                                    @if($sample->available == 0)
                                        {{ $availableDisplay }}
                                    @elseif($sample->scraped == 1)
                                        {{ $scrapedDisplay }}
                                    @endif

                                    @if(isset($sample->oldestProcessStep->first()->related_type))
                                        @if($sample->oldestProcessStep->first()->related_type != 'App\Models\Substrate')
                                            class="bg-blue-200"
                                        @endif
                                    @endif
                                >
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <input class="rounded" type="checkbox" wire:model="selectedSamples.{{$sample->name}}" value="{{$sample->id}}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $sample->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $sample->size }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $sample->processSteps->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        @if(isset($sample->oldestProcessStep->first()->date))
                                            {{ $sample->oldestProcessStep->first()->date }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        @if(isset($sample->latestProcessStep->first()->date))
                                            {{ $sample->latestProcessStep->first()->date }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        @switch($sample->available)
                                            @case(1)
                                                Yes
                                                @break
                                            @case(0)
                                                No
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex flex-row">
                                        <a name="view" id="view" href="{{ route('samples.show', $sample->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                        <form action="", method="post" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
