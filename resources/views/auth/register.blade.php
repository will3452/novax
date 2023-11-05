<x-layout>
    <div class="flex justify-center items-center h-screen w-screen bg-gray-300">
        <div class=" w-screen px-2 md:w-1/3">
            <form action="{{route('register')}}" method="POST" class="bg-yellow-400 p-4 rounded-xl">
                @csrf 
                <div class="flex justify-center">
                    <img src="/logo.png" alt="" class="w-20 h-20 rounded-full mb-2">
                </div>
                <div class="mb-2">
                    <x-label>
                        Name
                    </x-label>
                    <input type="text" required name="name" class="p-2 w-full rounded-xl mt-2">
                </div>
                <div class="mb-2">
                    <x-label>
                        Mobile No.
                    </x-label>
                    <input type="number" required name="phone" class="p-2 w-full rounded-xl mt-2">
                </div>
                <div class="mb-2">
                    <x-label>
                        Email
                    </x-label>
                    <input type="email" required name="email" class="p-2 w-full rounded-xl mt-2">
                </div>
                <div class="mb-2">
                    <x-label>
                        Password
                    </x-label>
                    <input type="password" required name="password" class="p-2 w-full rounded-xl mt-2">
                </div>
                <div class="mb-2">
                    <x-label>
                        Confirm  Password
                    </x-label>
                    <input type="password" required name="password_confirmation" class="p-2 w-full rounded-xl mt-2">
                </div>
                <button type="submit" class="p-2 w-full bg-teal-400 rounded-xl font-bold">
                    Register
                </button>
                <div class="text-center my-2">OR</div>
                <div class="text-center"><a href="/login" class="underline">Login</a></div>
            </form>
        </div>
    </div>
</x-layout>