<x-layout>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <form class="card-body" action="/login" method="POST">
                @csrf
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Email</span>
                </label>
                <input type="text" placeholder="email" requried name="email" class="input input-bordered">
              </div>
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Password</span>
                </label>
                <input type="password" placeholder="password" required name="password" class="input input-bordered">
                <label class="label">
                  <a href="/forgot-password" class="label-text-alt link link-hover">Forgot password?</a>
                </label>
              </div>
              <div class="form-control mt-6">
                <button class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
          <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold">{{ config('app.name') }}</h1>
            <p class="py-6">{{ nova_get_setting('introduction', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium quis provident amet possimus rem, alias architecto distinctio, iure magni enim eius recusandae, quisquam reiciendis obcaecati eligendi dolorem ab deleniti labore?') }}</p>
          </div>

        </div>
      </div>
</x-layout>
