<x-layout>
    <form action="/oc" method="POST" class="space-y-4 p-2 h-[90vh]">
        @csrf
        <h1 class="font-bold flex gap-2 items-center">
              New Log
        </h1>
        <div>
            <label for="">Vehicle Request Form</label>
            {{-- <input type="text" name="unit" required class="w-full border-2 rounded-md p-2"> --}}
            <select required class="w-full" name="vrf_id" id="v2">
                @foreach (\App\Models\VehicleRequestForm::whereStatus('approved')->whereDriverId(auth()->user()->driver->id)->get() as $item)
                    <option value="{{$item->id}}">
                        {{$item->date->format('m/d/Y')}} - {{$item->purpose}}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">
                Start (Km)
            </label>
            <input type="number"  class="w-full border-2 rounded-md p-2" name="start" required />
        </div>
        <div>
            <label for="">
                End (Km)
            </label>
            <input type="number"  class="w-full border-2 rounded-md p-2" name="end" required />
        </div>
        <input type="hidden" name="user_id" value="{{auth()->id()}}" />
        <button class="bg-blue-900 text-white w-full p-4 rounded-full font-bold">SUBMIT</button>
        <div class="h-[150px]"></div>
    </form>

    <script>
        $('#v2').select2()
    </script>
</x-layout>
