<x-layout>
    <div class="text-center " x-data="{token: null, location: {},}" x-init="token = localStorage.getItem('police-emerge-token'); navigator.geolocation.getCurrentPosition((position) => {
        location = position.coords;
    })">
        <h1 class="text-center text-2xl font-bold uppercase bg-green-400 text-white p-2">Report now!</h1>
        <form action="/anonymous" method="post" class="p-2 px-5" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="token" :value="token">
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
            <div>
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
            <a href="/" class="block mt-4 underline">Back to welcome page.</a>
        </form>
    </div>
</x-layout>