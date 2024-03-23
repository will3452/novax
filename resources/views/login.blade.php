<x-layout>
    <div class=" w-screen max-w-[900px] mx-auto p-4">
        <x-error />
        <form action="{{route('nova.login')}}" method="POST">
            <h1 class="text-2xl font-bold" >LOGIN</h1>
            @csrf 
            <input class="p-4 w-full mt-4 border-2" type="email" name="email" placeholder="Enter your Email" autofocus>
            <input class="p-4 w-full mt-4 border-2" type="password" name="password" placeholder="Enter your Password" autofocus>
            <button class="mt-4 bg-blue-800 font-bold p-4 text-[14px] text-white border-r-4 border-b-4 border-gray-300">SUBMIT</button>
        </form>
    </div>
</x-layout>