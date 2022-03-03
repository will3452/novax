<x-layout>
    <div class="flex justify-center my-8 items-center">
        <img src="/main.png" alt="" class="mx-4 w-4/12">
        <div class="w-4/12">
            <div class="btn-group my-2">
                <a class="btn" href="/">Register</a>
                <a class="btn bg-black text-white">Login</a>
            </div>
            <form action="{{route('nova.login')}}" method="POST"  class="overflow-y-auto card flex-shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
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
                    <input type="submit" value="Login" class="btn text-white bg-black">
                </div>
                </div>
            </form>
        </div>

    </div>
</x-layout>
