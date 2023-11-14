<x-layout>
    <x-topbar></x-topbar>
    <div class="w-screen flex overflow-auto justify-center" style="height: 90vh; ">
        <div class="md:w-2/3 w-full h-screen overflow-y-auto">
            <h1 class="p-4 bg-red-400  font-bold text-2xl uppercase font-mono text-white text-center md:text-left flex items-center">
                <span class="material-symbols-outlined">
                    flag_circle
                    </span>
                    Send
                Report</h1>
            <form action="{{ route('reports.store') }}" method="post" class="p-2 px-5" enctype="multipart/form-data">
                @csrf
                <label for="">
                    <span class="font-bold mb-2 block">Category</span>
                    <select required name="category_id" id="" class=" w-full border-2 rounded p-2">
                        @foreach (\App\Models\ReportCategory::get() as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label for="">
                    <span class="font-bold mb-2 block">Description</span>
                    <textarea name="description" required class="w-full border-2 rounded p-2" placeholder="Aa"></textarea>
                </label>
                <div x-data="{ location: {}, }" x-init=" navigator.geolocation.getCurrentPosition((position) => {
                     location = position.coords;
                 })">
                    <div> <span class="italic text-gray-700 font-bold">Your current location: </span><span class="border-dashed border-2 border-red-500 p-1 rounded text-xs font-bold" x-text="location.latitude"></span> <span class="border-dashed border-2 border-red-500 px-2 py-1 rounded text-xs font-bold"
                            x-text="location.longitude"></span></div>
                    <input type="hidden" name="lng" :value="location.longitude">
                    <input type="hidden" name="lat" :value="location.latitude">
                </div>
                <label for="">
                    <span class="font-bold mb-2 block">Image</span>
                    <input type="file" required name="image" accept="image/*">
                </label>
                <button type="submit"
                    class="w-full border-4 border-green-400 mt-4 bg-green-700 block p-2 font-bold rounded-full text-white"> 
                    SEND REPORT
                </button>
            </form>
            <h1 class="p-4 bg-red-400  font-bold text-2xl uppercase font-mono text-white text-center md:text-left flex items-center">
                <span class="material-symbols-outlined">
                    list_alt
                    </span>
                     Report Logs
            </h1>
            <div class="p-5 mb-20">
                <table id="table">
                    <thead>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Coordinates
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (auth()->user()->reports()->latest()->get() as $item)
                            <tr>
                                <td>
                                    {{$item->created_at->format('m-d-Y')}}
                                </td>
                                <td>
                                    {{$item->status}}
                                </td>
                                <td>
                                    {{$item->description}}
                                </td>
                                <td>
                                    {{$item->lat}}, {{$item->lng}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <x-latest-news></x-latest-news> --}}
    </div>
    <x-bottombar></x-bottombar>
</x-layout>

