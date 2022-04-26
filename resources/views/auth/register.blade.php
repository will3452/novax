<x-layout>

<div class="hero min-h-screen bg-base-200">
    <form action="register" method="POST" class="card flex-shrink-0 w-full shadow-2xl bg-base-100" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

        @if (session('success'))
            <x-alert-success>
                Registered Succesfully!
            </x-alert-success>
        @endif
        <h1 class="uppercase text-center font-bold text-gray-700 text-2xl">Register</h1>
        <div class="flex justify-between">
            <div class="form-control w-full md:w-2/6">
                <label class="label">
                    <span class="label-text">First Name</span>
                </label>
                <input type="text" value="{{old('first_name')}}" name="first_name" required placeholder="First Name" class="input input-bordered">
                @error('first_name')
                <x-form-error>
                    {{$message}}
                </x-form-error>
                @enderror
            </div>
            <div class="form-control w-full md:w-2/6">
                <label class="label">
                    <span class="label-text">Middle Name</span>
                </label>
                <input type="text" value="{{old('middle_name')}}" name="middle_name" required placeholder="Middle Name" class="input input-bordered">
                @error('middle_name')
                <x-form-error>
                    {{$message}}
                </x-form-error>
                @enderror
            </div>
            <div class="form-control w-full md:w-2/6">
                <label class="label">
                    <span class="label-text">Last Name</span>
                </label>
                <input type="text" value="{{old('last_name')}}" name="last_name" required placeholder="Last Name" class="input input-bordered">
                @error('last_name')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                @enderror
            </div>
        </div>
        <div class="flex justify-between ">
            <div class="form-control md:w-1/2 w-full">
                <label for="" class="label">
                    Birthdate
                </label>
                <input type="date" name="birthdate" class="input input-bordered" required>
                @error('birthdate')
                    <x-form-error>
                        {{$message}}
                    </x-form-error>
                @enderror
            </div>
            <div class="form-control md:w-1/2 w-full pl-4">
                <label class="label">
                    <span class="label-text">Gender</span>
                </label>
                <div class="flex">
                    <div class="mr-4">
                        Male
                        <input type="radio" name="gender" value="male">
                    </div>
                    <div class="mr-4">
                        Female
                        <input type="radio" name="gender" value="female">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between">
            <div class="form-control w-full md:w-1/2">
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
            <div class="form-control w-full md:w-1/2 pl-4">
                <label class="label">
                    <span class="label-text">Valid ID</span>
                </label>
                <input type="file" name="valid_id" required placeholder="Valid ID" >
                @error('email')
                <x-form-error>
                    {{$message}}
                </x-form-error>
                @enderror
                </div>
        </div>
        <div class="flex justify-between">
            <div class="form-control w-1/2">
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
            <div class="form-control w-1/2">
                <label class="label">
                    <span class="label-text">Confirm Password</span>
                </label>
                <input type="password" placeholder="password" required name="password_confirmation" class="input input-bordered">
            </div>
        </div>
        <div class="form-control mt-6">
            <input type="submit" value="Register" class="btn btn-primary">
            <a class="block text-center text-xs mt-4 underline" href="/admin/login">Already have an account?</a>
            <a class="btn btn-sm mt-4" href="/">back to homepage</a>
        </div>
        </div>
    </form>
</div>
</x-layout>
