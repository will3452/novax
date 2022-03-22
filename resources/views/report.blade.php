<x-layout>
    <style>
        @media print {
                #form {
                   display:none;
                }
            }

    </style>
    <h1 class="text-center font-bold uppercase text-2xl">
        REPORT
    </h1>

    <form action="/report" class="flex justify-center items-end print:hidden" id="form">
        <div class="flex items-end">
            <div class="mx-2">
                <div class="label">
                    <div class="label-text">
                        From Date
                    </div>
                </div>
                <input type="date" name="to" required class="input input-bordered">
            </div>
            <div class="mx-2">
                <div class="label">
                    <div class="label-text">
                        To Date
                    </div>
                </div>
                <input type="date" name="from" required class="input input-bordered">
            </div>
            <div class="mx-2">
                <button class="btn btn-secondary">Generate</button>
                <button type="button" onclick="window.print()" class="btn">Print</button>
            </div>
        </div>
    </form>
    <div class="text-center">
        {{request()->to}} - {{request()->from}}
    </div>
    <div class="w-32 h-16 flex justify-center items-center">
        <span>
            Total : {{$sales->sum('total_cost')}}
        </span>
    </div>
    <div class=" mt-2 mx-auto ">
        <div class="w-11/12 overflow-x-auto">
            <table class="table table-bordered w-full">
                <thead>
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            User
                        </th>
                        <th>
                            Total Cost
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $item)
                        <tr>
                            <td>
                                {{$item->created_at->format('m/d/y')}}
                            </td>
                            <td>
                                {{$item->user->name}}
                            </td>
                            <td>
                                {{$item->total_cost}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
