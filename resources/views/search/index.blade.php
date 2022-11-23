<x-layouts.main>
    <h1 class="page-header">
        Search Results : {{request()->keyword}}
    </h1>
    <ul>
        @forelse ($profiles as $item)
            <li>
                <a href="{{route('profiles.show', ['profile' => $item->id])}}">
                    {{$item->last_name}}, {{$item->first_name}} {{$item->middle_name}}
                </a>
            </li>
        @empty
            <div class="alert alert-warning">
                No result found.
            </div>
        @endforelse
    </ul>
</x-layouts.main>
