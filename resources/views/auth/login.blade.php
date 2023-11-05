<x-layout>
    <div class="flex justify-center items-center h-screen w-screen bg-gray-300">
        <div class=" w-screen px-2 md:w-1/3">
            <form action="" class="bg-yellow-400 p-4 rounded-xl">
                
                <div class="flex justify-center">
                    <img src="/logo.png" alt="" class="w-20 h-20 rounded-full mb-2">
                </div>
                <div class="mb-2">
                    <x-label>
                        Email
                    </x-label>
                    <input type="text" name="email" class="p-2 w-full rounded-xl mt-2">
                </div>
                <div class="mb-2">
                    <x-label>
                        Password
                    </x-label>
                    <input type="password" name="password" class="p-2 w-full rounded-xl mt-2">
                </div>
                <button type="submit" class="p-2 w-full bg-teal-400 rounded-xl font-bold">
                    Login
                </button>
                <div class="text-center my-2">OR</div>
                <div class="text-center"><a href="/register" class="underline">Register</a></div>
            </form>
        </div>
    </div>
</x-layout>