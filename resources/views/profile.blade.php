<x-layout-no-search>
    <h1 class="text-center font-bold uppercase text-2xl mt-2">
        Profile
    </h1>
    @if (session()->has('success'))
        <div class="p-2 rounded font-bold bg-green-300 text-center">
            Profile updated successfully!
        </div>
    @endif
    <div class="flex justify-center my-2">
        <div class="w-32 h-32 bg-blue-600 rounded-full flex justify-center items-center text-white uppercase" style="font-size:90px;">
            {{auth()->user()->name[0]}}
        </div>
    </div>
    <form action="/profile" method="post" class="mt-2 p-2">
        @csrf
        <div class="mb-4">
            <label for="" class="block mb-2">Name *</label>
            <input type="" name="name" id="" class="p-2 block w-full rounded-md" value="{{auth()->user()->name}}" required>
            <div class="text-red-500 text-xs font-bold">
                @error('name')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="" class="block mb-2">Email *</label>
            <input type="email" name="email" id="" class="p-2 block w-full rounded-md" value="{{auth()->user()->email}}" readonly required>
            <div class="text-red-500 text-xs font-bold">
                @error('email')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="" class="block mb-2">Password *</label>
            <input type="password" name="password" id="" class="p-2 block w-full rounded-md">
            <div class="text-red-500 text-xs font-bold">
                @error('password')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="" class="block mb-2">Phone No. *</label>
            <input type="number" name="phone_number" id="" value="{{auth()->user()->phone_number}}" class="p-2 block w-full rounded-md" required>
            <div class="text-red-500 text-xs font-bold">
                @error('phone_number')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="" class="block mb-2">Address</label>
            <input type="text" name="address" id="" value="{{auth()->user()->address}}" class="p-2 block w-full rounded-md" required>
            <div class="text-red-500 text-xs font-bold">
                @error('address')
                {{$message}}
                @enderror
            </div>
        </div>
        <button class="p-2 font-bold rounded-md bg-blue-500 text-white">
            UPDATE PROFILE
        </button>
    </form>
</x-layout-no-search>
