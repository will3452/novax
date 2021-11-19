<x-layout>
    <div class="h-screen w-screen flex justify-center items-center bg-gray-100" >
        <div class="w-full md:w-1/3 shadow p-7 mx-auto rounded bg-white">
            <h1 class="font-bold text-xl uppercase">
                Please Enter Your Email
            </h1>
            <form action="/register-email" method="POST">
                @csrf
                <div class="my-2">
                    <label for="" class="mb-2 block text-xs font-bold">Email</label>
                    <input type="email" name="email" required class="p-2 border-2  w-full rounded">
                    @error('email')
                    <div class="text-xs font-bold uppercase text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <input class="p-2 bg-green-500 font-bold rounded uppercase text-white w-full" type="submit" value="Send OTP"/>

                <div class="text-center my-2">
                    Alreay have an account? <a href="/nova/login" class="text-green-400">click here to login</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
