<x-layout>
    <x-topbar></x-topbar>
    <div class="w-screen flex overflow-auto" style="height: 90vh; ">
        <div class="md:w-2/3 w-full">
            <h1 class="p-4 bg-red-400  font-bold text-2xl uppercase font-mono text-white text-center md:text-left">Send Report</h1>
            <form action="" class="p-2 px-5">
                <label for="">
                    <span class="font-bold mb-2 block">Category</span>
                    <select name="" id="" class=" w-full border-2 rounded p-2">
                        @foreach (\App\Models\ReportCategory::get() as $item)
                            <option value="{{$item->id}}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label for="">
                    <span class="font-bold mb-2 block">Description</span>
                    <textarea name=""  class="w-full border-2 rounded p-2" placeholder="Aa"></textarea>
                </label>
                <label for="">
                    <span class="font-bold mb-2 block">Image</span>
                    <input type="file" name="image" accept="image/*">
                </label>
                <button type="submit" class="w-full border-4 border-green-400 mt-4 bg-green-700 block p-2 font-bold rounded-full text-white">SEND REPORT</button>
            </form>
        </div>
        <div class="md:w-1/3 hidden md:block bg-gray-200 ">
            <h1 class="p-4 bg-red-500  font-bold text-2xl uppercase font-mono text-white">
                Latest News
            </h1>
            <div class="px-4 overflow-y-scroll h-full">
                @foreach (\App\Models\News::latest()->take(6)->get() as $item)
                    <div class="border-2 border-red-500 my-2 mb-4 ">
                        <div class="bg-red-500 p-4 font-bold text-white">
                            {{$item->title}}
                        </div>
                        <div class="bg-red-200 p-4">
                            {{ \Str::limit($item->body, 100) }} <a href="#" class="text-sm text-red-500 font-bold underline block">Read more</a>
                        </div>
                    </div>
                    @if ($loop->last)
                        <div class="my-20">

                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <x-bottombar></x-bottombar>
</x-layout>
