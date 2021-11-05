<x-layout>
    <form action="/register" method="post" class="mt-2 p-2">
        @csrf
        <h1 class="text-2xl font-bold mb-2">CLIENT REGISTRATION</h1>
        <div class="mb-4">
            <label for="" class="block mb-2">Name *</label>
            <input type="" name="name" id="" class="p-2 block w-full rounded-md" required>
            <div class="text-red-500 text-xs font-bold">
                @error('name')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="" class="block mb-2">Email *</label>
            <input type="email" name="email" id="" class="p-2 block w-full rounded-md" required>
            <div class="text-red-500 text-xs font-bold">
                @error('email')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="" class="block mb-2">Password *</label>
            <input type="password" name="password" id="" class="p-2 block w-full rounded-md" required>
            <div class="text-red-500 text-xs font-bold">
                @error('password')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="" class="block mb-2">Phone No. *</label>
            <input type="number" name="phone_number" id="" class="p-2 block w-full rounded-md" required>
            <div class="text-red-500 text-xs font-bold">
                @error('phone_number')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="" class="block mb-2">Address</label>
            <input type="text" name="address" id="" class="p-2 block w-full rounded-md" required>
            <div class="text-red-500 text-xs font-bold">
                @error('address')
                {{$message}}
                @enderror
            </div>
        </div>
        <button class="p-2 font-bold rounded-md bg-blue-500 text-white">
            REGISTER
        </button>
    </form>
</x-layout>
