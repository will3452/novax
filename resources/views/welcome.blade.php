<x-layout>
    <div class="flex justify-center my-8 items-center">
        <img src="/main.png" alt="" class="mx-4 w-4/12">
        <div class="w-4/12">
            <div class="btn-group my-2">
                <a class="btn bg-black text-white">Register</a>
                <a class="btn" href="{{route('nova.login')}}">Login</a>
            </div>
            <form action="register" method="POST" style="height:70vh;" class="overflow-y-auto card flex-shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
                @csrf
                <div class="card-body">
                @if (session('success'))
                    <x-alert-success>
                        Registered Succesfully!
                    </x-alert-success>
                @endif
                <h1 class="uppercase text-center font-bold text-gray-700 text-2xl">Patient Registration</h1>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Name</span>
                    </label>
                    <input type="text" value="{{old('name')}}" name="name" required placeholder="name" class="input input-bordered">
                    @error('name')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Address</span>
                    </label>
                    <input type="text" value="{{old('address')}}" name="address" required placeholder="address" class="input input-bordered">
                    @error('address')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Mobile #</span>
                    </label>
                    <input type="text" value="{{old('phone')}}" name="phone" required placeholder="phone" class="input input-bordered">
                    @error('phone')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Date of Birth</span>
                    </label>
                    <input type="date" value="{{old('date_of_birth')}}" name="date_of_birth" required class="input input-bordered">
                    @error('date_of_birth')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="text" value="{{old('email')}}" name="email" required placeholder="email" class="input input-bordered">
                    @error('email')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                    </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" required placeholder="password" class="input input-bordered">
                    @error('password')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input type="password" placeholder="password" required name="password_confirmation" class="input input-bordered">
                </div>

                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Gender</span>
                    </label>
                    <div class="flex">
                        <label for="" class="mr-2">
                            Male
                            <input type="radio" name="gender" value="Male">
                        </label>
                        <label for="" class="mr-2">
                            Female
                            <input type="radio" name="gender" value="Female">
                        </label>
                    </div>
                    @error('gender')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                    @enderror
                </div>
                <div class="form-control mt-6">
                    <input type="submit" value="Register" class="btn text-white bg-black">
                    <a class="btn btn-link" href="{{route('nova.login')}}">
                        Already have an account?
                    </a>
                </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
