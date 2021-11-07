<x-layout>
    <h1 class="text-center text-2xl font-bold uppercase my-2">
        T Accounts
    </h1>
    <div class="md:w-2/3 w-full mx-auto" x-data="{filterShow:false}">
        <div class="w-full shadow mt-2 p-4 rounded">
            <div class="uppercase font-bold flex items-center justify-between">
                <div>
                    Filters
                </div>
                <button class="border p-2 rounded" x-on:click="filterShow = !filterShow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                </button>
            </div>
            <template x-if="filterShow">
                <form class="flex" action="/t-accounts" method="get">
                    <div class="w-full">
                        <div class="my-2">
                            <small class="text-xs font-bold">CHOOSE ACCOUNT</small>
                            <select name="account" id="" class="w-full p-2 rounded mt-2 border">
                                @foreach (\App\Models\Account::get() as $account)
                                    <option value="{{$account->name}}">{{$account->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-2">
                            <small class="text-xs font-bold">FROM DATE</small>
                            <input type="date" name="from" required class="w-full p-2 rounded mt-2 border">
                        </div>
                        <div class="my-2">
                            <small class="text-xs font-bold">TO DATE</small>
                            <input type="date" name="to" required class="w-full p-2 rounded mt-2 border">
                        </div>
                        <div class="my-2">
                            <button class="w-full p-2 bg-green-400 rounded font-bold">
                                APPLY
                            </button>
                        </div>
                    </div>
                </form>
            </template>
        </div>
        <table class="w-full mt-2">
            <thead>
                <tr>
                    <th class="border p-1">
                        #
                    </th>
                    <th class="border p-1">
                        Date
                    </th>
                    <th class="border p-1">
                        Description
                    </th>
                    <th class="border p-1">
                        Ref #
                    </th>
                    <th class="border p-1">
                        Credits
                    </th>
                    <th class="border p-1">
                        Debits
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $line = 0;
                    $totalCreds = 0;
                    $totalDebs = 0;
                @endphp
                @foreach ($records as $item)
                <tr>
                    <td class="text-center border">
                        {{++$line}}
                    </td>
                    <td class="text-center border">
                        {{$item->created_at->format('Y-m-d')}}
                    </td>
                    <td class="text-center border">
                        {{$item->description}}
                    </td>
                    <td class="text-center border">
                        {{$item->reference_number}}
                    </td>
                    <td class="text-center border">
                        @php
                            $totalDebs += $item->debit;
                        @endphp
                        {{$item->debit}}
                    </td>
                    <td class="text-center border">
                        @php
                            $totalCreds += $item->credit;
                        @endphp
                        {{$item->credit}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td class="text-center border">
                    </td>
                    <td class="text-center border">
                    </td>
                    <td class="text-center border">
                    </td>
                    <td class="text-center border">
                        Total
                    </td>
                    <td class="text-center border">
                        {{$totalDebs}}
                    </td>
                    <td class="text-center border">
                        {{$totalCreds}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center border">
                    </td>
                    <td class="text-center border">
                    </td>
                    <td class="text-center border">
                    </td>
                    <td class="text-center border">
                        Balance
                    </td>
                    <td class="text-center border">
                        {{$totalDebs - $totalCreds}}
                    </td>
                    <td class="text-center border">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>
