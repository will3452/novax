<x-layout>
    <div class=" w-screen max-w-[900px] mx-auto p-4 text-center">
        <h1 class="text-2xl font-bold mb-4">Your email is not yet verified.</h1>
        <form action="{{route('email.verify')}}" method="POST">
            @csrf 
            <button class="border p-2 rounded">Send Verification Link now.</button>
        </form>
        <div>
            <div>or</div>
            <a href="/logout" class="text-red-600 font-bold">Logout</a>
        </div>
    </div>
</x-layout>