<x-layout>
    <div class="hero min-h-screen" style="background-image: url('/pexels-liza-summer-6347900.jpg');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="text-center hero-content text-neutral-content">
          <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold">
                  {{config('app.name')}}
                </h1>
            <p class="mb-5">
                {{nova_get_setting('tagline', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo quisquam porro dicta ullam quidem tempore explicabo aut iure, dolores officiis.')}}
            </p>
            <a href="/login" class="btn btn-primary">
                <span class="material-icons">
                search
                </span>
                <span class="mx-4">
                    Find Job
                </span>
            </a>
          </div>
        </div>
      </div>
</x-layout>
