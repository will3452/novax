<x-layout>
    <div class=" w-screen max-w-[900px] mx-auto p-4">
        <x-error />
        <form action="{{route('register.post')}}" method="POST">
            @csrf 
            <div class="text-2xl ">Register as: <label for="p"><input type="radio" value="Passenger" name="type" id="p"/>Passenger</label> <label for="d"><input type="radio" id="d"  name="type" value="Driver"/>Driver</label> </div>
            <input class="p-4 w-full mt-4 border-2" type="text" name="name" placeholder="Enter your Full Name" autofocus>
            <input class="p-4 w-full mt-4 border-2" type="email" name="email" placeholder="Enter your Email" autofocus>
            <input class="p-4 w-full mt-4 border-2" type="password" name="password" placeholder="Enter your Password" autofocus>
            <button class="mt- 4 font-bold p-2 text-lg border-2  border-gray-300 mt-2 text-gray-800">SUBMIT</button>
        </form>
    </div>
</x-layout>