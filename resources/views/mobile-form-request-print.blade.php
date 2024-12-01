<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title><meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="p-4 py-2 space-y-2 v-[90vh] mb-[10vh]">
        <div class="flex justify-between mb-8">
            <h1 class="font-bold text-xl">Trip Ticket</h1>
            <div  class="font-bold text-xl">
                Trip No: {{\Str::padLeft($fr->id, 8, 0)}}
            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">
                Name of Driver:
            </div>
            <div>
                {{$fr->driver ? $fr->driver->first_name . " " . $fr->driver->last_name : '---'}}
            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">
                Vehicle:
            </div>
            <div>
                {{$fr->vehicle ? $fr->vehicle->model . " - " . $fr->vehicle->plate_number : '---'}}
            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">
                Destination:
            </div>
            <div>
                {{$fr->model}}
            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">
                Purpose:
            </div>
            <div>
                {{$fr->purpose}}
            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">
                Date:
            </div>
            <div>
                {{$fr->date->format('m/d/y')}}
            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">
                Time:
            </div>
            <div>
                {{$fr->time}}
            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">
                Authorized By:
            </div>
            <div>

            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">
                Status:
            </div>
            <div>
                {{$fr->status}}
            </div>
        </div>
        <div class="text-center ">
            <div>

            </div>
            <div class="font-bold border-b-2 border-black">
                President / Authorized Representative
            </div>
            <div class="text-sm">
                to be filled by the driver / to be checked and verified by the guard on duty
            </div>
        </div>
        <div class="text-sm">
            <div>
                1. Time of departure from University Premises:
            </div>
            <div>
                2. Time of arrival to place/s of destination:
            </div>
            <div>
                3. Time of departure from place/s destination:
            </div>
            <div>
                4. Time of arrival to the University Premises:
            </div>
            <div>
                5. Gasoline: Issued / consumed / Purchased
            </div>
            <div class="ml-4">
                a. Balance in tank before travel
            </div>
            <div class="ml-4">
                b. ADD: Purchased during travel
            </div>
            <div class="ml-4">
                c. LESS: Used during travel
            </div>
            <div class="ml-4">
                d. Balance in tank after travel
            </div>
            <div>
                6. Kilometer Reading:
            </div>
            <div class="ml-4">
                a. Before Travel
            </div>
            <div class="ml-4">
                b. After Travel
            </div>
        </div>
        <div class="text-xs">
            <span class="font-bold">Terms and conditions</span>: University drivers shall be personally liable and fully responsible for: a his act or
omissions done outside his scope of duties and responsibilities; b. Any tickets or fines issued by government
agencies or any legal action that may result in an accident involving the university vehicles for failure to observe
traffic and parking rules and regulations, laws, ordinances and safety procedures and SLSU policies for the use
thereof.
        </div>
        <div class="text-xs">
            <span class="font-bold">Certification</span>: I hereby certify the correctness of the above stated information, further, I hereby agree to the terms
and conditions imposed by SLSU. I am aware of the safety procedures and policies issued by the SLSU.
        </div>
        <div class="py-12"></div>
        <div class="grid grid-cols-2 gap-12">
            <div>
                <div>

                </div>
                <div class="border-t border-black text-center">
                    Driver
                </div>
            </div>
            <div>
                <div>

                </div>
                <div class="border-t border-black text-center">
                    Guard
                </div>
            </div>
        </div>
        <div>
            I/We certify that the University vehicle was used on official business as stated above.
        </div>
        <div class="font-bold">
            Passenger
        </div>
        <div>
            {!!$fr->remarks!!}
        </div>
    </div>
    <x-back-home></x-back-home>
</body>
</html>
