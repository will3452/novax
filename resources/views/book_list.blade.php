<x-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <h1 class="text-center text-2xl uppercase font-bold mt-4">
        Booking list
    </h1>


    <div class="w-full p-4 rounded bg-white mt-2 overflow-x-auto mx-auto ">
        <table id="example">
            <thead>
                <tr>
                    <th class="border">
                        Booked At
                    </th>
                    <th class="border">
                        Shop
                    </th>
                    <th class="border">
                        Services
                    </th>
                    <th class="border">
                        Status
                    </th>
                    <th class="border">
                        Book Date/Time
                    </th>
                    <th class="border">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $book)
                    <tr>
                        <td class="border">
                            {{$book->created_at->format('m/d/Y')}}
                        </td>
                        <td class="border">
                            <a href="/shops/{{$book->shop_id}}">{{$book->shop->description}}</a>
                        </td>
                        <td class="border">
                            {{$book->services ?? 'N/a'}}
                        </td>
                        <td class="border">
                            {{$book->status}}
                        </td>
                        <td class="border">
                            {{$book->date ? $book->date->format('m/d/Y h:i a') : '---'}}
                        </td>
                        <td class="border text-center">
                            <a href="tel:{{$book->shop->contact_number}}" class="p-1 rounded text-xs bg-green-400 text-white px-4">call</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let table = new DataTable('#example');
        });
    </script>

</x-layout>
