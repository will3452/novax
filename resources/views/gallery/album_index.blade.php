<x-layout>
    <div class="w-11/12 mx-auto my-4">
        <h1 class="text-center text-2xl uppercase mb-4">
            Gallery
        </h1>
        <div class="my-4 text-center">
           <!-- The button to open modal -->
            <label for="my-modal" class="btn modal-button">Create new Album</label>
            <input type="checkbox" id="my-modal" class="modal-toggle">
            <div class="modal">
            <div class="modal-box">
                <form action="/create-album" method="POST">
                    @csrf
                    <div>
                        <div class="label">
                            <div class="label-text">
                                Album Name
                            </div>
                        </div>
                        <input type="text" class="input input-bordered w-full" name="name" required>
                    </div>
                    <div>
                        <div class="label">
                            <div class="label-text">
                                Description
                            </div>
                        </div>
                        <textarea class="textarea textarea-bordered w-full" name="description" required></textarea>
                    </div>
                    <div class="my-4">
                        <button class="btn btn-primary" type="submit">
                            Create
                        </button>
                    </div>
                </form>
                <div class="modal-action">
                <label for="my-modal" class="btn">Cancel</label>
                </div>
        </div>
        </div>
        </div>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        <div class="flex flex-wrap justify-center">
            @foreach ($albums as $album)
                <x-card proceed-text="View" :title="$album->name" href="/images?album={{$album->id}}">
                    {{$album->description}}
                </x-card>
            @endforeach
        </div>
        {{$albums}}
        @if (count($albums) === 0)
            <x-alert-info>No Albums created!</x-alert-info>
        @endif
    </div>
</x-layout>
