<x-layout>
    <x-guest-navbar></x-guest-navbar>
    <x-carousel />
    <form action="/" class="bg-primary p-4 flex justify-center">
        <div class="w-full md:w-8/12">
            <input type="search" name="search" class="input input-lg w-full" placeholder="Search Job here.">
        </div>
    </form>
    <div class="lg:flex">
        @forelse ($offers as $offer)
            <div class="card lg:card-side bordered my-2 lg:w-1/3 mx-2 shadow">
                <div class="card-body">
                <h2 class="card-title">{{$offer->position}}
                    @if ($offer->urgent)
                    <a class="text-xs badge">URGENT</a>
                    @endif

                     <a class="text-xs badge-warning badge">VACANT SLOT <span class="font-bold"> ( {{$offer->available_number_of_slots}} )</span></a>
                    </h2>
                <p>{{$offer->description}}</p>
                <p>
                    @foreach ($offer->tags as $tag)
                    <a href="#link" class="font-bold text-xs">#{{$tag->description}}</a>
                    @if (!$loop->last)
                        /
                    @endif
                    @endforeach
                </p>
                <div class="card-actions">
                    <a class="btn btn-primary" href="/register">Register to apply</a>

                </div>
                </div>
            </div>
        @empty
        <div class="alert alert-info">
            <div class="flex-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <label>No Job found!</label>
            </div>
          </div>
        @endforelse

    </div>
</x-layout>
