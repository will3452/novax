<x-layout>
    <form action="/new-request" method="POST" enctype="multipart/form-data" class="space-y-4 p-2 h-[90vh]">
        @csrf
        <h1 class="font-bold flex gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
              </svg>
              New request
        </h1>
        <div>
            <label for="">Category</label>
            <select class="block w-full" name="category" id="c2" >
                <option value="Carpooling">Carpooling</option>
                <option value="Reserved">Reserved</option>
            </select>
        </div>
        <div>
            <label for="">Purpose *</label>
            <input type="text" name="purpose" required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Date *</label>
            <input type="date" name="date" min="{{now()->format('Y-m-d')}}" required class="w-full border-2 rounded-md p-2">
        </div>

        <div>
            <label for="">Time *</label>
            <input type="time" name="time" required class="w-full border-2 rounded-md p-2">
        </div>

        <div>
            <label for="">Destination *</label>
            <textarea name="destination" id="" class="w-full border-2 rounded-md p-2"></textarea>
        </div>

        <div>
            <label for="">Passengers *</label>
            <textarea name="passenger" required id="" class="w-full border-2 rounded-md p-2"></textarea>
        </div>
        <div>
            <label for="">Request of Travel</label>
            <select class="block w-full" name="request_of_travel_id" id="r2" >
                <option value="">N/a</option>
                @foreach (auth()->user()->rots()->whereStatus('APPROVED')->get() as $item)
                    <option value="{{$item->id}}">
                        {{$item->date->format('m/d/Y')}} - {{$item->purpose}}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Travel Order</label>
            <select class="block w-full" name="travel_order_id" id="s2" >
                <option value="">N/a</option>
                @foreach (auth()->user()->travelOrders()->where('approved_by_id', '!=', null)->get() as $item)
                    <option value="{{$item->id}}">
                        {{$item->date_of_travel->format('m/d/Y')}} - {{$item->purpose}}
                    </option>
                @endforeach
                <option value=""></option>
            </select>
        </div>
        <button class="bg-blue-900 text-white w-full p-4 rounded-full font-bold">SUBMIT</button>
        <div class="h-[150px]"></div>
    </form>
    <x-back-home></x-back-home>

    <script>
        $('#r2').select2()
        $('#s2').select2()
        $('#c2').select2()
    </script>
</x-layout>
