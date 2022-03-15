<x-layout>
    <div class="flex justify-center items-center min-h-screen">
        <form action="/login" class="card flex-shrink-0 w-full max-w-md shadow-2xl bg-base-200" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Email</span>
                </label>
                <input type="text" placeholder="email" name="email" class="input input-bordered">
              </div>
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" placeholder="password" class="input input-bordered">
                <label class="label">
                    <a href="/forgot-password" class="label-text-alt link link-hover">Forgot password?</a>
                </label>
              </div>
              <div class="form-control mt-6">
                <button class="btn btn-primary" type="submit">Login</button>
              </div>
            </div>
        </form>
    </div>
</x-layout>
