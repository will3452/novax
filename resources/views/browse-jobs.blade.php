<x-layout>
    <x-navbar></x-navbar>
    <x-content>
        <div>
            @foreach ($offers as $offer)
            <div class="card lg:card-side bordered my-2">
                <div class="card-body">
                <h2 class="card-title">{{$offer->position}}
                    <a class="text-xs badge">URGENT</a> <a class="text-xs badge-warning badge">VACANT SLOT <span class="font-bold"> ( {{$offer->slot}} )</span></a></h2>
                <p>{{$offer->description}}</p>
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
                        Vacant Slot : {{$offer->slot}}
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

            @endforeach


        </div>
    </x-content>
</x-layout>
