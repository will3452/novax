<x-layout>
    <div class="w-11/12 mx-auto my-4">
        <h1 class="text-center text-2xl uppercase mb-4">
            Upload New Image
        </h1>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        <div class="flex flex-wrap justify-center h-screen overflow-y-auto">
            <form action="{{route('gallery')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="album_id" value="{{request()->album}}">
                <div class="mb-4">
                    <input type="text" required placeholder="Title" class="input input-bordered w-full" name="title" required>
                </div>
                <div class="mb-4">
                    <textarea class=" w-full textarea textarea-bordered" placeholder="Caption" name="caption" required></textarea>
                </div>
                <div class="mb-4">
                    <input type="file" name="file" required>
                </div>
                <div>
                    <button class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
