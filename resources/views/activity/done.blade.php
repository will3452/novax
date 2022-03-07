<x-layout>
    <x-container>
        <x-header>
            Result
        </x-header>
        <div class="text-center">
            {{$record->score}} ({{$record->rate}}%)
        </div>
        <div class="text-center">
            <a href="/subjects/{{$activity->module->subject->id}}" class="btn-xs btn btn-primary">Back to Subject.</a>
        </div>
    </x-container>
    <script>
        window.onload = function () {
            sessionStorage.clear();
        }
    </script>
</x-layout>
