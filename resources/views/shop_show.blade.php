<x-layout>
    <div class="w-screen h-60"
    style="
        background:url('/storage/{{$shop->clean_logo}}');
        background-position:center;
        background-size:cover;
        ">
    </div>
    <div class="text-center p-2">
        <div class="font-bold text-xl">
            {{$shop->description}}
            <span class="text-xs">
                ({{$shop->status}})
            </span>
        </div>
        <div class="text-sm font-bold">
            {{$shop->address}}
        </div>
        <div class="text-xs">
            {{$shop->contact_person}} / {{$shop->contact_number}}
        </div>
    </div>
    <div class="m-2">
        <div class="border border-black  border-b-0 uppercase text-left bg-blue-500 text-white p-2 flex items-center justify-between">
            <div>
                Services
            </div>
            <div class="text-xs font-normal flex items-center">
                <div class="w-3 h-3 rounded-full bg-green-500 ml-1" title="available">
                </div>
                Available
            </div><div class="text-xs font-normal flex items-center">
                <div class="w-3 h-3 rounded-full bg-gray-500 ml-1" title="not available">
                </div>
                Not Available
            </div>
        </div>
        <table class="w-full">
            <tr>
                <th class="border text-left border-black">
                    Desc.
                </th>
                <th class="border text-left border-black">
                    Cost
                </th>
                <th class="border text-left border-black">
                    Stat.
                </th>
            </tr>
            @foreach ($shop->services as $service)
                <tr>
                    <td class="border border-black">
                        {{$service->description}}
                    </td>
                    <td class="border border-black">
                        {{$service->cost}}
                    </td>
                    <td class="border border-black ">
                        <div class="flex justify-center items-center">
                            @if ($service->status == \App\Models\Service::STATUS_AVAILABLE)
                                <div class="w-3 h-3 rounded-full bg-green-500" title="available">
                                </div>
                            @else
                                <div class="w-3 h-3 rounded-full bg-gray-500" title="not available">
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    <div class="py-5">

    </div>
    @if ($shop->status === \App\Models\Shop::STATUS_CLOSED)
    <a href="tel:{{$shop->contact_number}}" class="p-2 font-bold bg-green-500 text-white fixed right-0 left-0 bottom-0 h-10 text-center">
        Call
    </a>
    @else
    <a href="tel:{{$shop->contact_number}}" class="p-2 font-bold bg-green-500 text-white fixed w-4/12 left-0 bottom-0 h-10 text-center">
        Call
    </a>
    <a href="#" class="p-2 font-bold bg-blue-500 text-white fixed w-8/12 right-0 bottom-0 h-10 text-center">
        Book Today
    </a>
    @endif
</x-layout>
