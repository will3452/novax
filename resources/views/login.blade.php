<x-layout>
    <form action="/login" method="post" class="mt-2 p-2">
        @csrf
        <h1 class="text-2xl font-bold mb-2">CLIENT LOGIN</h1>
        @if (session()->has('error'))
        <div class="text-right text-red-500 font-bold uppercase">
            Account Not Found!
        </div>
        @endif
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
        <button class="p-2 font-bold rounded-md bg-blue-500 text-white">
            Login
        </button>
    </form>
</x-layout>
