<x-layout>
    <div class="w-11/12 mx-auto my-4">
        <h1 class="text-center text-2xl uppercase mb-4">
            {{\App\Models\Album::find(request()->album)->name}}
        </h1>
        <div class="my-4 text-center">
            <a href="{{route('gallery')}}/create?album={{request()->album}}" class="btn btn-xs btn-primary">
                Upload new
            </a>
        </div>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        <div class="flex flex-wrap justify-center">
            @foreach ($images as $img)
                <x-card proceed-text="Remove" :title="$img->title" img="/storage/{{$img->path}}" href="{{route('gallery')}}/remove/{{$img->id}}">
                    {{$img->caption}} <small class="kbd">{{$img->created_at->format('m d, Y')}}</small>
                </x-card>
            @endforeach
        </div>
        {{$images}}
        @if (count($images) === 0)
            <x-alert-info>No image(s) Uploaded.</x-alert-info>
        @endif
    </div>
</x-layout>
