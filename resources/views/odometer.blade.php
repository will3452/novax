<x-layout>
    <div class="p-2">
        <div class="flex justify-between">
            <h1 class="font-bold">Odometer Logs</h1>
            <a href="{{route('o.c')}}" class="bg-blue-900 p-2 text-white rounded-2xl font-bold px-4">New Log</a>
        </div>
        <table id="dt">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Vehicle</th>
                    <th>Start - End </th>
                </tr>
            </thead>
            <tbody>
                @foreach (\App\Models\Odometer::whereDriverId(auth()->user()->driver->id)->get() as $item)
                    <tr>
                        <td>{{$item->created_at->format('m/d/Y')}}</td>
                        <td>{{$item->vehicle->plate_number}}</td>
                        <td>{{$item->start}} - {{$item->end}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        new DataTable("#dt")
    </script>
</x-layout>
