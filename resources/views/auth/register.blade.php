<x-layout>

<div class="hero min-h-screen ">
    <form action="register" method="POST" class="card flex-shrink-0 w-full max-w-md  ">
        @csrf
        <div class="card-body">
        @if (session('success'))
            <x-alert-success>
                Registered Succesfully!
            </x-alert-success>
        @endif
        <h1 class="uppercase text-center font-bold text-gray-700 text-2xl">Register</h1>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Name</span>
            </label>
            <input type="text" value="{{old('name')}}" name="name" required placeholder="name" class="input input-bordered rounded-xl">
            @error('name')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Phone</span>
            </label>
            <input type="text" value="{{old('phone')}}" name="phone" required placeholder="phone" class="input input-bordered rounded-xl">
            @error('phone')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input type="text" value="{{old('email')}}" name="email" required placeholder="email" class="input input-bordered rounded-xl">
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
            <input type="password" name="password" required placeholder="password" class="input input-bordered rounded-xl">
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
            <input type="password" placeholder="password" required name="password_confirmation" class="input input-bordered rounded-xl">
        </div>

        <div class="form-control mt-6">
            <input type="submit" value="Register" class="btn btn-primary rounded-xl">
            <a class="block text-center text-xs mt-4 underline" href="/">Already have an account?</a>
        </div>
        </div>
    </form>
</div>
</x-layout>
