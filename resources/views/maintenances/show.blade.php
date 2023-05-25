<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View maintenance
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="block mb-8">
                <a href="{{ route('maintenances.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
            </div>
            <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                        <div class="flex flex-col items-center w-full sm:justify-between pt-3">
                            <div class="mx-2 flex flex-row sm:justify-between">
                                <p class="font-bold">
                                    Equipment : <span class="text-blue-400 pl-2 pr-20"> {{ $equipment->model }} </span>
                                </p>
                                <p>
                                    Date : <span class="pr-20"> {{ date_format(new DateTime($maintenance->date), 'Y-m-d') }} </span>
                                </p>
                                <p>
                                    Gravity :
                                    <span
                                        @switch($maintenance->gravity)
                                        @case(1)
                                        class="bg-green-200 px-3 py-1 rounded-lg"
                                        @break
                                        @case(2)
                                        class="bg-yellow-200 px-3 py-1 rounded-lg"
                                        @break
                                        @case(3)
                                        class="bg-red-200 px-3 py-1 rounded-lg"
                                            @break
                                        @endswitch
                                    >
                                        @switch($maintenance->gravity)
                                            @case(1)
                                            standard
                                            @break
                                            @case(2)
                                            intermediate
                                            @break
                                            @case(3)
                                            heavy
                                            @break
                                        @endswitch
                                    </span>
                                </p>
                            </div>
                        </div>
                        <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                            <legend class="bg-white rounded-lg px-1">Description</legend>
                            <p class="text-sm bg-white rounded-lg h-20 p-3 mr-1 w-full">
                                {{ $maintenance->description }}
                            </p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

</x-app-layout>
