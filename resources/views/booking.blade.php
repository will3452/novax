<x-layout>
    <x-header></x-header>
    <div class="container">
       <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Booking Form
                </div>
                <div class="card-body">
                    <form action="/booking/{{$room->id}}" method="POST">
                        @csrf
                        <div class="my-2">
                            <label for="">
                                Mobile
                            </label>
                            <input type="text" placeholder="09---------" name="mobile" required>
                        </div>
                        <div class="my-2">
                            <label for="">Date</label>
                            <input type="date" name="date" required>
                        </div>
                        <button class="btn btn-primary">SUBMIT FORM</button>
                    </form>
                </div>
           </div>
        </div>
        <div class="col-md-6">
            <x-room-details :room="$room"></x-room-details>
        </div>
       </div>
    </div>
    <x-features></x-features>

</x-layout>
