<x-layout>
    <x-container>
        <x-header>
            {{$activity->name}}
        </x-header>
        <x-project-details :activity="$activity"></x-project-details>
        @if ($canSubmit)
            <form method="post" action="/submit-project/{{$activity->id}}" enctype="multipart/form-data" class="border border-dashed mt-4 p-4">
                @csrf
                <div>
                    Upload Project
                </div>
                <input type="file" name="file">
                <button class="btn btn-sm">Submit</button>
                <div class="text-xs">
                    Maximum of 2mb. Uploading of file is only once.
                </div>
            </form>
        @else
            <p class="p-4 rounded-sm bg-gray-300">
                Submission is not allowed!
            </p>
        @endif
    </x-container>
</x-layout>
