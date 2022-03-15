<x-layout>
    <div class="hero min-h-screen">
        <div class="hero-content text-center">
          <div class="max-w-md">
            <h1 class="text-5xl font-bold">{{nova_get_setting('app_name', config('app.name'))}}</h1>
            <p class="py-6">{{nova_get_setting('introduction', 'setup in the setting of the administrator!')}}</p>
            <a href="/login" class="btn btn-primary">Get Started</a>
          </div>
        </div>
      </div>
</x-layout>
