<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Equipment creation
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
    <form action="{{ route('equipments.store') }}" method="post">
        @csrf
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-row sm:justify-between items-center mb-8">
                <a href="{{ route('equipments.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
                <button onclick="return confirm('Are you sure ?');" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Confirm</button>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row items-center w-full sm:justify-between pt-3">
                                <div class="mx-2 flex flex-row sm:justify-between">
                                    <p class="font-bold">
                                        Model :
                                        <span class="text-blue-400 pl-3 pr-20">
                                            <input class="h-8 rounded-lg" type="text" name="model" value="{{ old('model') }}">
                                        </span>
                                    </p>
                                    <p>
                                        Serial :
                                        <span>
                                            <input class="h-8 rounded-lg" type="text" name="serial" value="{{ old('serial') }}">
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-around">
                                <legend class="bg-white rounded-lg px-1">Information</legend>
                                <div class="flex flex-col items-center">
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-5">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-5 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg w-28">
                                                Supplier
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900 w-28 text-center">
                                                <input class="h-8 rounded-lg" type="text" name="supplier" value="{{ old('supplier') }}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-5 pt-3">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-5 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg w-28">
                                                Out date
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900 w-28 text-center">
                                                <input class="h-8 rounded-lg pt-0.5 w-40" type="date" name="out_date" value="{{ old('out_date') }}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-5 pt-3">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-5 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg w-28">
                                                Type
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900 w-28 text-center">
                                                <select class="h-8 rounded-lg text-sm pt-1" name="equipment_type" id="">
                                                    <option hidden value="">--Choose equipment type--</option>
                                                    @foreach($equipmentTypes as $equipmentType)
                                                        <option @if($equipmentType->id == old('equipment_type')) selected @endif value="{{ $equipmentType->id }}"> {{ $equipmentType->keyword }} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>
