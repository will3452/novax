<x-layout>
    <x-navbar></x-navbar>
    <x-content>
        <x-stats></x-stats>
        <resume-uploader noresume="{{auth()->user()->resume ? 'no':'true'}}" resumelink="{{auth()->user()->resume ? auth()->user()->resume->storage_path : '#'}}" @error('file') error='{{$message}}' @enderror >@csrf</resume-uploader>
    </x-content>
</x-layout>
