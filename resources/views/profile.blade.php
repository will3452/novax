<x-layout>
    <div class="h-screen overflow-y-scroll">
        <h1 class="text-center text-2xl uppercase mb-4 mt-4">
            Profile settings
        </h1>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
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
                <h1 class="font-bold">Bio</h1>
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
                            Age
                        </div>
                    </div>
                    <input type="number" value="{{auth()->user()->age}}" name="age" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Address
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->address}}" name="address" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Birthday
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->birthday}}" name="birthday" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Mobile No.
                        </div>
                    </div>
                    <input type="number" value="{{auth()->user()->phone}}" name="phone" class="input w-full input-bordered">
                </div>
                <h1 class="font-bold">Favorites</h1>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Food
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->food}}" name="food" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Color
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->color}}" name="color" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Movie
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->movie}}" name="movie" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Music
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->music}}" name="music" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Hobby
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->hobby}}" name="hobby" class="input w-full input-bordered">
                </div>
                <h1 class="font-bold">Educational Attainment </h1>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Elemantary
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->elementary}}" name="elementary" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Highschool
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->highschool}}" name="highschool" class="input w-full input-bordered">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            College
                        </div>
                    </div>
                    <input type="text" value="{{auth()->user()->college}}" name="college" class="input w-full input-bordered">
                </div>
                <button class="btn btn-primary mt-4">
                    Update now
                </button>
            </form>

        </div>
    </div>
</x-layout>
