<div>
    <div>
        <button class="bg-green-300 text-white w-20 px-4 py-1 hover:bg-green-200 rounded border" wire:click="$emit('closeModal')">Close</button>
    </div>
    @if (($file_ext == 'jpg') or ($file_ext == 'png') or ($file_ext == 'pbm'))
        <img width="400" src="{{ route('getsafefile',['pathname'=>'userdocs','filename'=>$path_image]) }}">
    @elseif(($file_ext == 'txt') or ($file_ext == 'csv'))
        <textarea class="max-w">{{ route('getsafefile',['pathname'=>'userdocs','filename'=>$path_image]) }}</textarea>
    @endif
</div>
