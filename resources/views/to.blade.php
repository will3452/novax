<x-layout>
    <form action="{{route('to.store')}}" method="POST" class="space-y-4 p-2 h-[90vh]">
        @csrf
        <h1 class="font-bold flex gap-2 items-center">
              Travel Order
        </h1>
        <div>
            <label for="">Unit *</label>
            <input type="text" name="unit" required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Destination</label>
            <input type="text" name="destination" required required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Date of Travel</label>
            <input type="date" name="date_of_travel" required required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Purpose</label>
            <input type="text" name="purpose" required required class="w-full border-2 rounded-md p-2">
        </div>

        <div>
            <label for="">Entitled options</label>
            <div>
                <input type="checkbox" value="Per Diem" name="option[]"> Per Diem
            </div>
            <div>
                <input type="checkbox" value="Actual allowable travel expenses" name="option[]">  Actual allowable travel expenses
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{auth()->id()}}" />
        <button class="bg-blue-900 text-white w-full p-4 rounded-full font-bold">SUBMIT</button>
        <div class="h-[150px]"></div>
    </form>
</x-layout>
