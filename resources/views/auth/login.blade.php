<x-layout>
    <div class="hero min-h-screen bg-base-200">
        <div class="flex-col justify-center hero-content lg:flex-row">
          <div class="text-center lg:text-left">
                <h1 class="mb-5 text-5xl font-bold">
                    {{config('app.name')}}
                </h1>
                <p class="mb-5">
                    {{nova_get_setting('tagline') ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia amet error hic sed earum distinctio atque enim laborum corporis optio!'}}
                </p>
          </div>
          <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <form class="card-body" method="POST" action="login">
            <h2 class="font-bold text-xl my-2">
                Welcome Back!
            </h2>
            @csrf
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" placeholder="email" class="input input-bordered">
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
                <input type="password" name="password" placeholder="password" class="input input-bordered">
                @error('password')
                <x-form-error>
                    {{$message}}
                </x-form-error>
                @enderror
                {{-- <label class="label">
                  <a href="#" class="label-text-alt">Forgot password?</a>
                </label> --}}
              </div>
              <div class="form-control mt-2">
                <input type="submit" value="Login" class="btn btn-primary">
              </div>
              <div class="mt-2 text-xs text-center">
                  <a href="/register" class="underline">Register as Job Seeker</a> | <a href="/register-employer" class="underline">Register as Employer</a>
              </div>
            </form>
          </div>
        </div>
      </div>
</x-layout>
