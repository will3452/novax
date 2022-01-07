<x-layout>

<div class="hero min-h-screen bg-base-200">
    <form action="register" method="POST" class="card flex-shrink-0 w-full md:w-1/2 mx-auto shadow-2xl bg-base-100">
        @csrf
        <div class="card-body">
        @if (session('success'))
            <x-alert-success>
                Registered Succesfully!
            </x-alert-success>
        @endif
        <h1 class="uppercase text-center font-bold text-gray-700 text-2xl">OJT Seeker Register</h1>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Your Name</span>
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
            <span class="label-text">School Name</span>
            </label>
            <input type="text" value="{{old('school')}}" name="school" required placeholder="School Name" class="input input-bordered">
            @error('school')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Your Address</span>
            </label>
            <input type="text" value="{{old('address')}}" name="address" required placeholder="Your Address" class="input input-bordered">
            @error('address')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Mobile No.</span>
            </label>
            <input type="number" value="{{old('mobile_number')}}" name="mobile_number" required placeholder="+63-" class="input input-bordered">
            @error('mobile_number')
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
        <div class="form-control mt-6">
            <input type="submit" value="Register" class="btn btn-primary">
            <a class="block text-center text-xs mt-4 underline" href="/login">Already have an account?</a>
        </div>
        </div>
    </form>
</div>
</x-layout>
