<x-layout>
    @if (session()->has('success'))
        <div class="bg-green-300 text-green-900 p-2 mt-2 rounded font-bold uppercase">
            Booked Successfully!
        </div>
    @endif
    <div x-data="{modalIsOpen:false}">
        <div x-show.transition.500ms="modalIsOpen" class="w-screen h-screen fixed left-0 right-0 top-0 bottom-0 bg-blue-900 bg-opacity-10 flex justify-center items-center">
            <form action="/booking/{{$shop->id}}" method="post" class="rounded-md bg-white p-4">
                @csrf
                <div class=" font-bold text-xl">
                    <div class="uppercase">Select service</div>
                    <div class=" mt-2">
                        <div class="text-base font-normal">
                            @foreach ($shop->services()->whereStatus(\App\Models\Service::STATUS_AVAILABLE)->get() as $service)
                                <div>
                                    <input type="checkbox" name="services[]" value="{{$service->description}}"/> {{$service->description}} (<span class="text-xs">Php</span> {{$service->cost}})
                                </div>
                            @endforeach
                        </div>
                        <div class="flex mt-2">
                            <button class="w-1/2 mx-2 p-1 bg-blue-500 text-white rounded-md px-3">Proceed</button>
                            <button type="button" x-on:click="modalIsOpen = false" class="w-1/2 mx-2 p-1 bg-red-500 text-white rounded-md px-3">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="md:flex">
            <div class="md:w-4/12 mt-2 h-60 rounded-md"
            style="
                background:url('/storage/{{$shop->clean_logo}}');
                background-position:center;
                background-size:cover;
                ">
            </div>
            <div class="md:w-8/12">
                <div class="md:text-left text-center p-2">
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
                                  Php {{$service->cost}}
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
            </div>

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
        @if (!\App\Models\Booking::hasBooking(auth()->id(), $shop->id, \App\Models\Booking::STATUS_PENDING))
            <a href="#" x-on:click.prevent="modalIsOpen = true" class="p-2 font-bold bg-blue-500 text-white fixed w-8/12 right-0 bottom-0 h-10 text-center">
                Book Today
            </a>
        @else
            <a href="#" class="p-2 font-bold bg-blue-700 text-white fixed w-8/12 right-0 bottom-0 h-10 text-center">
                You have pending Book here!
            </a>
        @endif

        @endif
    </div>
</x-layout>
