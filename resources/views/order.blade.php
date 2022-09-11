<x-layout>
    <x-navbar></x-navbar>
    <h1 class="font-serif text-4xl mx-4 my-4 underline underline-offset-4 text-secondary">My Orders</h1>
    <div class="mx-4" x-data="{status: 'all'}">
        <select name="" id="" x-model="status" class="select select-bordered">
            <option value="all">All</option>
            <option value="Pending">Pending</option>
            <option value="To Deliver">To Deliver</option>
            <option value="To Received">To Received</option>
            <option value="Received">Received</option>
        </select>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>
                        Order No.
                    </th>
                    <th>
                        Paid Date
                    </th>
                    <th>
                        Total Cost
                    </th>
                    <th>
                        Items
                    </th>
                    <th>
                        Remarks
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <tr x-show="'{{$item->status}}' == status || status == 'all'">
                        <td>
                            {{\Str::padLeft($item->id, 8, 0)}}
                        </td>
                        <td>
                            {{$item->paid_at->format('m/d/y h:i A')}}
                        </td>
                        <td>
                            {{number_format($item->amount_payable, 2)}}
                        </td>
                        <td>
                            <ul>
                                @foreach (json_decode($item->products) as $i)
                                    <li>
                                        {{$i->quantity}}x {{$i->product_name}}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
