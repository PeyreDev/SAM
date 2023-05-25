<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Source
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

    <form action="{{ route('sources.store') }}" method="post">
    @csrf
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-row sm:justify-between items-center mb-8">
                <a href="{{ route('sources.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Accept</button>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row w-full sm:justify-between pt-3">
                                <p class="ml-2 mr-5">
                                    Reference : <input class="h-8 rounded-lg" type="text" name="reference" value="{{ old('reference') }}">
                                </p>
                                <p class="mr-2">
                                    Supplier : <input class="h-8 rounded-lg" type="text" name="supplier" value="{{ old('supplier') }}">
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
                                                <input class="h-6 rounded-lg" type="text" name="quantity" value="{{ old('quantity') }}">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-full text-sm pt-0" type="date" name="manufacturing_date" value="{{ old('manufacturing_date') }}">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg" type="text" name="purity" value="{{ old('purity') }}">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg" type="text" name="dilution" value="{{ old('dilution') }}">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select class="h-6 text-sm rounded-lg w-full pt-0" name="conditionning">
                                                    <option value="0">BL</option>
                                                    <option value="1">B5</option>
                                                    <option value="2">B10</option>
                                                    <option value="3">B20</option>
                                                    <option value="4">B50</option>
                                                    <option value="5">Cadre 9</option>
                                                    <option value="6">Cadre 11</option>
                                                    <option value="7">Container Inox</option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select class="h-6 text-sm rounded-lg w-full pt-0" name="precursor_properties_id" id="">
                                                    <option hidden selected value="">--Choose precursor--</option>
                                                    @foreach($precursors as $precursor)
                                                        <option value="{{ $precursor->id }}">{{ $precursor->species }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row items-center">
                                <legend class="bg-white rounded-lg px-1">Choose a gas line</legend>
                                <select class="h-8 text-sm rounded-lg w-80 pt-1" name="gas_line_id" id="">
                                    @foreach($gasLines as $gasLine)
                                        <option value="{{ $gasLine->id }}">{{ $gasLine->name }}</option>
                                    @endforeach
                                </select>
                                <table class="divide-gray-200 flex flex-row rounded-lg pl-6">
                                    <thead>
                                    <tr class="flex flex-col">
                                        <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider  rounded-l-lg">
                                            Date in
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                    <tr class="flex flex-col">
                                        <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                            <input class="h-6 rounded-lg pt-0 text-sm" name="date_in" type="date" value="{{ $dateTimeStr }}">
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
