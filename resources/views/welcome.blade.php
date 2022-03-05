<x-layout>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
          <div class="max-w-md">
            <h1 class="text-5xl font-bold">{{config('app.name')}}</h1>
            <p class="py-6">{{ nova_get_setting('introduction', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium quis provident amet possimus rem, alias architecto distinctio, iure magni enim eius recusandae, quisquam reiciendis obcaecati eligendi dolorem ab deleniti labore?') }}</p>
            <a class="btn btn-primary" href="/about">Read More</a>
          </div>
        </div>
      </div>
</x-layout>
