<div>
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

    <form action="{{ route('samples.store') }}" method="post">
    @csrf
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-row sm:justify-end items-center mb-8">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Confirm</button>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-col justify-around">
                                <legend class="bg-white rounded-lg px-1">Sample information</legend>
                                <div class="flex flex-row">
                                    <table class="divide-gray-200 flex flex-row rounded-lg pr-5">
                                        <thead>
                                        <tr class="flex flex-col">
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                Name
                                            </th>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                Size
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr class="flex flex-col">
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40" type="text" name="name">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40" type="text" name="size">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="divide-gray-200 flex flex-row rounded-lg">
                                        <thead>
                                        <tr class="flex flex-col">
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                Parent position
                                            </th>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                Parent name
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr class="flex flex-col">
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40" type="text" name="parent_position">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40" type="text" name="parent_name">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="flex justify-center pt-5">
                                    <table class="divide-gray-200 flex flex-row rounded-lg">
                                        <thead>
                                        <tr class="flex flex-col">
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                                Available
                                            </th>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-bl-lg">
                                                Localisation
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr class="flex flex-col">
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select class="h-6 text-sm rounded-lg w-66 pt-0 text-center" name="available" id="">
                                                    <option selected value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <select class="h-6 text-sm rounded-lg w-67 pt-0" name="localisation" id="">
                                                    <option selected hidden value="">--Choose localisation--</option>
                                                    @foreach($localisations as $localisation)
                                                        <option value="{{ $localisation->id }}"> {{ $localisation->description }} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <fieldset class="border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400">
                                    <legend class="bg-white rounded-lg px-1">Comment</legend>
                                    <textarea class="text-sm bg-white rounded-lg h-20 p-3 mr-1 w-full" name="comment" id="" cols="30" rows="10"></textarea>
                                </fieldset>
                            </fieldset>
                            <div class="flex w-full justify-center pt-3">
                                <span class="pr-3">From : </span>
                                <select wire:model="sampleFrom" wire:click="fromSelection" class="h-6 text-sm rounded-lg w-40 pt-0" name="sampleFrom" id="">
                                    <option value="fromBatch">Substrate batch</option>
                                    <option value="fromExternal">External sample</option>
                                </select>
                            </div>
                            <fieldset class=" {{ $hiddenBatch }} border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-col justify-around">
                                <legend class="bg-white rounded-lg px-1">Substrate information</legend>
                                <div class="flex flex-row items-center">
                                    <span class="pr-3">Select substrate batch :</span>
                                    <select class="h-6 text-sm rounded-lg w-67 pt-0" name="substrate_batch_id">
                                        @foreach($substrateBatches as $substrateBatch)
                                            <option value="{{ $substrateBatch->id }}">
                                                {{ $substrateBatch->name }}
                                                /
                                                @foreach($tagsMaterial as $tagMaterial)
                                                    @if($substrateBatch->material == $tagMaterial->id)
                                                        {{ $tagMaterial->keyword }}
                                                    @endif
                                                @endforeach
                                                /
                                                @foreach($tagsOrientation as $tagOrientation)
                                                    @if($substrateBatch->orientation == $tagOrientation->id)
                                                        {{ $tagOrientation->keyword }}
                                                    @endif
                                                @endforeach
                                                /
                                                @switch($substrateBatch->doping_type)
                                                    @case(0)
                                                    Undoped
                                                    @break
                                                    @case(1)
                                                    Type n
                                                    @break
                                                    @case(2)
                                                    Type p
                                                    @break
                                                    @case(null)
                                                    N/A
                                                    @break
                                                    @case('')
                                                    N/A
                                                    @break
                                                @endswitch
                                                /
                                                @if($substrateBatch->resistivity != 0 && $substrateBatch->resistivity != null)
                                                    {{ $substrateBatch->resistivity }} ohm.cm
                                                @else
                                                    Resistivity : N/A
                                                @endif
                                                /
                                                @if($substrateBatch->doping != 0 && $substrateBatch->doping != null)
                                                    {{ $substrateBatch->doping }} cm-3
                                                @else
                                                    Doping : N/A
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-row sm:justify-between pt-5">
                                    <table class="divide-gray-200 flex flex-row rounded-lg">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Position
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40" type="text" name="position">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="divide-gray-200 flex flex-row rounded-lg">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                                Face
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                                <input class="h-6 rounded-lg w-40"  type="text" name="face">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset class="{{ $hiddenExternal }} border-2 m-2 rounded-lg p-4 pl-6 bg-gray-200 border-gray-400 flex flex-row justify-center">
                                <legend class="bg-white rounded-lg px-1">External sample information</legend>
                                <table class="divide-gray-200 flex flex-row rounded-lg">
                                    <thead>
                                    <tr>
                                        <th class="px-6 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                            Origin
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 rounded-r-lg">
                                    <tr>
                                        <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-900">
                                            <input class="h-6 rounded-lg w-40" type="text" name="origin">
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
</div>
