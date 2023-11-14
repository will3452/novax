<x-layout>
    <div class="flex justify-center items-center h-screen w-screen">
        <form action="/verify-code" method="POST">
            @csrf 
            <input type="hidden" name="user_id" value="{{request()->user_id}}">
            <input type="text" name="code" class="border-2 rounded p-2" placeholder="Enter Code"/> <button type="submit" class="p-2 rounded bg-red-500 text-white">VERIFY</button>
        </form>
    </div>
</x-layout>