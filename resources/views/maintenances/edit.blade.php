<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit maintenance
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
    <form action="{{ route('maintenances.update', $maintenance->id) }}" method="post">
        @csrf
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-row sm:justify-between items-center mb-8">
                <a href="{{ route('maintenances.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
                <input type="hidden" name="_method" value="PUT">
                <button onclick="return confirm('Are you sure ?');" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Confirm</button>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="flex flex-row w-full sm:justify-center pt-3">
                                <p class="ml-2">
                                    Concerned equipment : <span class="pl-3 text-blue-500"> {{ $equipment->model }} </span>
                                    <input hidden type="text" name="equipment_id" value="{{ $equipment->id }}">
                                </p>
                            </div>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-around">
                                <legend class="bg-white rounded-lg px-1">Information</legend>
                                <div class="flex flex-row rounded-lg items-center pr-4">
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-5">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Date
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40 pt-0" type="date" name="date" value="{{ old('date', date_format(new DateTime($maintenance->date), 'Y-m-d')) }}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="divide-gray-200 flex flex-row rounded-lg pl-5">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Gravity
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select class="h-6 text-sm rounded-lg pt-0 w-44" name="gravity" id="">
                                                    <option @if(old('gravity', $maintenance->gravity) == 1) selected @endif value="1">standard</option>
                                                    <option @if(old('gravity', $maintenance->gravity) == 2) selected @endif value="2">intermediate</option>
                                                    <option @if(old('gravity', $maintenance->gravity) == 3) selected @endif value="3">heavy</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                <legend class="bg-white rounded-lg px-1">Description</legend>
                                <textarea class="text-sm bg-white rounded-lg h-20 p-3 mr-1 w-full" name="description" id="" cols="30" rows="10"> {{ old('description', $maintenance->description) }}</textarea>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>
