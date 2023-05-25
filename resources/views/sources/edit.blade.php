<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Source edition
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
    <form action="{{ route('sources.update', $source->id) }}" method="post">
        @csrf
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-row sm:justify-between items-center mb-8">
                <a href="{{ route('sources.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
                <input type="hidden" name="_method" value="PUT">
                <button onclick="return confirm('Are you sure ?');" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Confirm</button>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row w-full sm:justify-between pt-3">
                                <p class="ml-2 mr-5">
                                    Reference : <input class="h-8 rounded-lg" type="text" name="reference" value="{{ old('reference', $source->reference) }}">
                                </p>
                                <p class="mr-2">
                                    Supplier : <input class="h-8 rounded-lg" type="text" name="supplier" value="{{ old('supplier', $source->supplier) }}">
                                </p>
                            </div>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-around">
                                <legend class="bg-white rounded-lg px-1">Information</legend>
                                <div class="flex flex-row rounded-lg items-center">
                                    <table class="divide-gray-200 flex flex-row rounded-lg">
                                        <thead>
                                        <tr class="flex flex-col">
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                Quantity
                                            </th>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Manufacturing date
                                            </th>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Purity
                                            </th>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Dilution
                                            </th>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Conditioning
                                            </th>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                Precursor properties
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr class="flex flex-col">
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg" type="text" name="quantity" value="{{ old('quantity', $source->quantity) }}">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-full text-sm pt-0" type="date" name="manufacturing_date" value="{{ old('manufacturing_date', date_format(new DateTime($source->manufacturing_date), 'Y-m-d')) }}">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg" type="text" name="purity" value="{{ old('purity', $source->purity) }}">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg" type="text" name="dilution" value="{{ old('dilution', $source->dilution) }}">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select class="h-6 text-sm rounded-lg w-full pt-0" name="conditionning" id="">
                                                    <option @if($source->conditionning == 0) selected @endif value="0">BL</option>
                                                    <option @if($source->conditionning == 1) selected @endif value="1">B5</option>
                                                    <option @if($source->conditionning == 2) selected @endif value="2">B10</option>
                                                    <option @if($source->conditionning == 3) selected @endif value="3">B20</option>
                                                    <option @if($source->conditionning == 4) selected @endif value="4">B50</option>
                                                    <option @if($source->conditionning == 5) selected @endif value="5">Cadre 9</option>
                                                    <option @if($source->conditionning == 6) selected @endif value="6">Cadre 11</option>
                                                    <option @if($source->conditionning == 7) selected @endif value="7">Container Inox</option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select class="h-6 text-sm rounded-lg w-full pt-0" name="precursor_properties_id" id="">
                                                    @foreach($precursors as $precursor)
                                                        <option @if($source->precursor_properties_id == $precursor->id) selected @endif value="{{ $precursor->id }}">{{ $precursor->species }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row items-center justify-around">
                                <legend class="bg-white rounded-lg px-1">Gas line</legend>
                                <div class="bg-white w-40 rounded-lg text-center">
                                    {{ $source->latestGasLine->first()->name }}
                                </div>
                                <table class="divide-gray-200 flex flex-row rounded-lg pl-6">
                                    <thead>
                                    <tr class="flex flex-col">
                                        <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                            Date in
                                        </th>
                                        <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                            Date out
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                    <tr class="flex flex-col">
                                        <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                            <input class="h-6 rounded-lg pt-0 text-sm" name="date_in" type="date" value="{{ $newDateIn }}">
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                            @if($newDateOut != '1970-01-01')
                                                <input class="h-6 rounded-lg pt-0 text-sm" name="date_out" type="date" value="{{ $newDateOut }}">
                                            @else
                                                <input class="h-6 rounded-lg pt-0 text-sm" name="date_out" type="date">
                                            @endif
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
