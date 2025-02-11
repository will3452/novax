<x-layout>
    <div class="p-2">
        <div class="flex justify-between">
            <h1 class="font-bold">Request of travel</h1>
            <a href="{{route('rot.create')}}" class="bg-blue-900 p-2 text-white rounded-2xl font-bold px-4">Request New</a>
        </div>
        <table id="dt">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Destination</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->rots as $item)
                    <tr>
                        <td>{{$item->created_at->format('m/d/Y')}}</td>
                        <td>{{$item->destination}}</td>
                        <td>{{$item->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        new DataTable("#dt")
    </script>
</x-layout>
