<x-layout>
    <x-navbar></x-navbar>
    <x-content>
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
                        <apply-button job_offer_id='{{$offer->id}}' is_applied="{{$offer->isApplicantApplied(auth()->id())}}"></apply-button>
                        <label class="btn btn-ghost" for="my-modal-{{$offer->id}}">More info</label>
                    </div>
                    </div>
                </div>
                <input type="checkbox" id="my-modal-{{$offer->id}}" class="modal-toggle">
                <div class="modal">
                <div class="modal-box">
                    <div>
                        <h1 class="text-2xl font-bold my-2">
                            {{$offer->position}}
                        </h1>
                        <div class="text-xs font-bold">
                        &lt; Employer: {{$offer->employer->email}} &gt;
                        </div>
                        @if ($offer->urgent)
                            <div class="badge py-2 ">
                                URGENT
                            </div>
                        @endif
                        <div class="text-sm py-2  font-bold">
                            Salary/Mo : {{$offer->salary}}
                        </div>
                        <div class="text-sm  py-2 font-bold">
                            Vacant Slot : {{$offer->available_number_of_slots}}
                        </div>
                        <div class="p-2 mt-2 text-sm rounded border-dashed border-2">
                            {{$offer->description}}
                        </div>

                    </div>
                    <div class="modal-action">
                    <apply-button job_offer_id='{{$offer->id}}' is_applied="{{$offer->isApplicantApplied(auth()->id())}}"></apply-button>
                    <label for="my-modal-{{$offer->id}}" class="btn">Close</label>
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
    </x-content>
</x-layout>
