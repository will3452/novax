<x-layout>
    <div class="h-screen">
        <h1 class="text-center text-2xl uppercase mb-4 mt-4">
            Profile settings
        </h1>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        <div class="flex justify-center items-center">
            <form action="/profile" class="bg-white p-2 w-full md:w-1/2 rounded" method="POST">
                @csrf
                <div class="form-control">
                    Joined At : {{auth()->user()->created_at->format('M d, Y H:i A')}}
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Name
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->name}}" name="name" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Email
                        </div>
                    </div>
                    <input type="text" disabled value="{{auth()->user()->email}}" name="email" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            New Password
                        </div>
                    </div>
                    <input type="password" value="" name="password" class="input w-full input-bordered">
                </div>
                <button class="btn btn-primary mt-4">
                    Update now
                </button>
            </form>

        </div>
    </div>
</x-layout>
