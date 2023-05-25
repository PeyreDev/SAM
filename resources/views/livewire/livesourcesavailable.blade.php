<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex flex-row justify-between items-center mb-8">
            <a href="{{ route('sources.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Source</a>
            <div class="mr-1">
                Available : <input wire:model="check" wire:click="available" type="checkbox">
            </div>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Species
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Purity
                                </th>
                                <th scope="col" width="150" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gas line name
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date in
                                </th>
                                <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($sources as $source)
                                <tr @foreach($gaslinesources as $gaslinesource)
                                        {{-- Check for the changing type of $gaslinesource --}}
                                        @if(is_object($gaslinesource))
                                            @if($gaslinesource->source_id == $source->id && $gaslinesource->date_out != null)
                                                class="{{ $available }}"
                                            @endif
                                        @elseif(is_array($gaslinesource))
                                            @if($gaslinesource['source_id'] == $source->id && $gaslinesource['date_out'] != null)
                                                class="{{ $available }}"
                                            @endif
                                        @endif
                                    @endforeach>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $source->precursor->species }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $source->purity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($source->latestGasline->first() != null)
                                            {{ $source->latestGasline->first()->name}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($source->latestGasline->first() != null)
                                            @foreach($gaslinesources as $gaslinesource)
                                                {{-- Check for the changing type of $gaslinesource --}}
                                                @if(is_object($gaslinesource))
                                                    @if($gaslinesource->gas_line_id == $source->latestGasline->first()->id && $gaslinesource->source_id == $source->id)
                                                        {{ date_format(new DateTime($gaslinesource->date_in), 'Y-m-d') }}
                                                    @endif
                                                @elseif(is_array($gaslinesource))
                                                    @if($gaslinesource['gas_line_id'] == $source->latestGasline->first()->id && $gaslinesource['source_id'] == $source->id)
                                                        {{ date_format(new DateTime($gaslinesource['date_in']), 'Y-m-d') }}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex flex-row">
                                        <a name="view" id="view" href="{{ route('sources.show', $source->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                        <a href="{{ route('sources.edit', $source->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                        <form action="{{ route('sources.destroy', $source->id) }}", method="post" onsubmit="return confirm('Are you sure?');">
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
