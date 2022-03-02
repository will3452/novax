<x-layout>
<div class="hero min-h-screen bg-base-200">
    <form action="{{route('login')}}" method="POST" class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
        @csrf
        <div class="card-body">
        <h1 class="uppercase text-center font-bold text-gray-700 text-2xl">Login</h1>
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
        <div class="form-control mt-6">
            <input type="submit" value="Login" class="btn btn-primary">
        </div>
        </div>
    </form>
</div>
</x-layout>
