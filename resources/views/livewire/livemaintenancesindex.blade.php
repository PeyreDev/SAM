<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex flex-row justify-between items-center mb-8">
            <select class="rounded-lg pr-5 w-52" name="equipment" id="" wire:model="equipmentSelected">
                <option hidden value="0">--Choose equipment--</option>
                @foreach($equipments as $equipment)
                    <option value="{{ $equipment->id }}"> {{ $equipment->model }} </option>
                @endforeach
            </select>
            <a @if($equipmentSelected == null) hidden @endif href="{{ route('maintenances.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add maintenance</a>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="w-36 px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Gravity
                                </th>
                                <th scope="col" class="w-48 px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Date
                                </th>
                                <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($maintenances as $maintenance)
                                <tr
                                    @if($equipmentSelected != $maintenance->equipment_id)
                                        hidden
                                    @endif

                                    @switch($maintenance->gravity)
                                        @case(1)
                                            class="bg-green-200"
                                            @break
                                        @case(2)
                                            class="bg-yellow-200"
                                            @break
                                        @case(3)
                                            class="bg-red-200"
                                            @break
                                    @endswitch
                                >
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-bold">
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ date_format(new DateTime($maintenance->date), 'Y-m-d') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex flex-row">
                                        <a name="view" id="view" href="{{ route('maintenances.show', $maintenance->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                        <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="post" onsubmit="return confirm('Are you sure?');">
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
