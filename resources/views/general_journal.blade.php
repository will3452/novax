<x-view-layout title="General Journal">
    <div class="">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="border">
                        Date
                    </th>
                    <th class="border">
                        Description
                    </th>
                    <th class="border">
                        PR
                    </th>
                    <th class="border">
                        Debit
                    </th>
                    <th class="border">
                        Credit
                    </th>
                </tr>
            </thead>
            <body>

                @foreach ($records as $keyRecord=>$record)
                    @php
                        $viewDate = true;
                    @endphp
                    @foreach ($record as $key=>$item)
                        <tr>
                            <td class="border text-center">
                                @if ($viewDate)
                                    {{$keyRecord}}
                                @endif
                            </td>
                            @if ($item->credit)
                            <td class="border px-5">
                                {{$item->account}}
                            </td>
                            @else
                                <td class="border px-1">
                                    {{$item->account}}
                                </td>
                            @endif
                            <td class="border px-1">
                                {{$item->reference_number}}
                            </td>
                            <td class="border px-1">
                                {{is_null($item->debit) ?'':number_format($item->debit, 0)}}
                            </td>
                            <td class="border px-1">
                                {{is_null($item->credit) ?'':number_format($item->credit, 0)}}
                            </td>
                        </tr>
                        @php
                            $viewDate =false;
                        @endphp

                    @endforeach
                    <tr class="text-white border">
                        <td colspan="100">
                            h
                        </td>
                    </tr>

                @endforeach
            </body>
        </table>
    </div>
</x-view-layout>
