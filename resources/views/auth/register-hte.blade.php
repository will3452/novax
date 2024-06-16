<x-layout>
    <div class="max-w-[500px] w-full mx-auto  mt-4 shadow-md p-4 border rounded-md">
        @foreach ($errors->all() as $error)
            <div class="text-red-500">
                {{$error}}
            </div>
        @endforeach
        <h1 class="font-bold p-2">Register as HTE</h1>
        <form action="/register-hte" method="POST" class="p-2 ">
            @csrf
            
            <label for="" class="text-base block mt-2">
                Name <span class="text-red-700">*</span>
            </label>
            <input name="name" required class="block border rounded-md w-full p-2" type="text">
            <div>
                <label for="" class="text-base block mt-2">
                    Address  <span class="text-red-700">*</span>
                </label>
                <input type="text" name="address" required class="block border rounded-md w-full p-2">
            </div>
            <div x-data="{lat:null, lng: null}" x-init="
            navigator.geolocation.getCurrentPosition((pos)=>{
                let { latitude, longitude} = pos.coords; 
                lat = latitude; 
                lng = longitude; 
            })
        " class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div >
                    <label for="" class="text-base block mt-2">
                        Latitude <span class="text-red-700">*</span>
                    </label>
                    <input :value="lat"  name="lat" required class="block border rounded-md w-full p-2" type="text">
                </div>
                <div>
                    <label for="" class="text-base block mt-2">
                        Longitude <span class="text-red-700">*</span>
                    </label>
                    <input :value="lng"  name="lng" required class="block border rounded-md w-full p-2" type="text">
                </div>
            </div>
            <label for="" class="text-base block mt-2">
                Email <span class="text-red-700">*</span>
            </label>
            <input name="email" required class="block border rounded-md w-full p-2" type="email">
            <div x-data="{showPassword:false}">
                
            <label for="" class="text-base block mt-2">
                Password <span class="text-red-700">*</span>
            </label>
            <input name="password" required class="block border rounded-md w-full p-2" :type="showPassword ? 'text' : 'password'">
            <label for="" class="text-base block mt-2">
                Confirm Password <span class="text-red-700">*</span>
            </label>
            <input name="password_confirmation" required class="block border rounded-md w-full p-2" :type="showPassword ? 'text' : 'password'">
            <a class="underline text-sm" x-on:click="showPassword = !showPassword">show password</a>
            </div>
            <button class="mt-2 p-2 bg-blue-400 font-bold text-white w-full rounded-md" type="submit">SUBMIT</button>
        </form>
    </div>
</x-layout>