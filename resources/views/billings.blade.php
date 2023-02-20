<x-layout>
    <x-header></x-header>
    <div class="container">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Payee
                    </th>
                    <th>
                        Month
                    </th>
                    <th>
                        Year
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($billings as $item)
                <tr>
                    <td>
                        {{ $item->created_at->format('m-d-y')}}
                    </td>
                    <td>
                        PHP {{number_format($item->amount, 2)}}
                    </td>
                    <td>
                        {{$item->payee->name}}
                    </td>
                    <td>
                        {{$item->month}}
                    </td>
                    <td>
                        {{$item->year}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</x-layout>
