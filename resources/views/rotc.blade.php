<x-layout>
    <form action="{{route('rot.store')}}" method="POST" class="space-y-4 p-2 h-[90vh]">
        @csrf
        <h1 class="font-bold flex gap-2 items-center">
              New Request of Travel
        </h1>
        <div>
            <label for="">Administrator *</label>
            <select class="w-full" name="admin_id" id="a_id" required id="">
                @foreach (\App\Models\User::where('type', '=', 'admin')->get() as $item)
                <option value="{{$item->id}}">
                    {{$item->name}}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Vehicle *</label>
            <select class="w-full" name="vehicle_id" id="v_id" required id="">
                @php
                   $exclude =  \App\Models\VehicleRequestForm::whereStatus('approved')->get()->pluck('id')->toArray();
                @endphp
                @foreach (\App\Models\Vehicle::where('is_available', '=', true)->whereNotIn('id', $exclude)->get() as $item)
                <option value="{{$item->id}}">
                    {{$item->model}}
                </option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="user_id" value="{{auth()->id()}}">
        <div>
            <label for="">Destination</label>
            <input type="text" name="destination" required required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Date of Travel</label>
            <input type="date" name="date" required required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Purpose</label>
            <input type="text" name="purpose" required required class="w-full border-2 rounded-md p-2">
        </div>

        <div>
            <label for="">Passengers</label>
            <div>
                <input type="text" class="w-full border-2 rounded-md p-2"  name="passengers" />
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{auth()->id()}}" />
        <button class="bg-blue-900 text-white w-full p-4 rounded-full font-bold">SUBMIT</button>
        <div class="h-[150px]"></div>
    </form>

    <script>
        $(document).ready(() => {
            $('#v_id').select2();
            $('#a_id').select2();
        })
    </script>
</x-layout>
