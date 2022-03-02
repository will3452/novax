<x-layout>
    <div class="hero min-h-screen bg-base-200">
        <div class="flex-col hero-content lg:flex-row">
          <x-illustration></x-illustration>
          <div>
            <h1 class="text-5xl font-bold">Memory Virtual and Health Related Application</h1>
            <p class="py-6">{{nova_get_setting('landing_message', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eum, corrupti deleniti corporis quidem laborum alias in. Quidem nobis at nulla.')}}</p>
            <a href="/register" class="btn btn-primary">Register now</a>
          </div>
        </div>
      </div>
</x-layout>
