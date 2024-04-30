<x-layout>
    <div class="max-w-[500px] w-full mx-auto  mt-4 shadow-md p-4 border rounded-md">
        @foreach ($errors->all() as $error)
            <div class="text-red-500">
                {{$error}}
            </div>
        @endforeach
        <h1 class="font-bold p-2">Register as Coordinator</h1>
        <form action="/register-coordinator" method="POST" class="p-2 ">
            @csrf 
           <label for="" class="text-base block mt-2">
                Name
            </label>
            <input name="name" required class="block border rounded-md w-full p-2" type="text">
            <label for="" class="text-base block mt-2">
                Email
            </label>
            <input name="email" required class="block border rounded-md w-full p-2" type="email">
            <label for="" class="text-base block mt-2">
                Password
            </label>
            <input name="password" required class="block border rounded-md w-full p-2" type="password">
            <label for="" class="text-base block mt-2">
                Confirm Password
            </label>
            <input name="password_confirmation" required class="block border rounded-md w-full p-2" type="password">
            <button class="mt-2 p-2 bg-blue-400 font-bold text-white w-full rounded-md" type="submit">SUBMIT</button>
        </form>
    </div>
</x-layout>