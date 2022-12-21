<x-layout>
    <div class=" h-screen"style="background:url('/storage/{{nova_get_setting('landing_background')}}'); background-size:cover; background-position:center;" >
        <div class="hero-container md:flex flex-col md:flex-row items-center">
          <div class="mx-auto justify-center hidden md:flex">
            <x-illustration></x-illustration>
          </div>
          {{nova_get_setting('landing_image')}}
          <div>
            <h1 class="text-2xl font-bold text-center md:text-left md:text-5xl">Memory Enhancer with Health Monitoring</h1>
            <p class="py-6 text-center md:text-left px-4">{{nova_get_setting('landing_message', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eum, corrupti deleniti corporis quidem laborum alias in. Quidem nobis at nulla.')}}</p>
            <div class="text-center md:text-left px-4">
                <a href="/login" class="btn bg-gray-500 rounded-full  w-full md:w-1/3 border-0 text-white">SIGN IN</a>
            </div>
            <div class="text-center md:text-left mt-4">
                If you don't have account click <a href="/register" class="text-blue-600 underline">here</a>
            </div>
          </div>
        </div>
      </div>
</x-layout>
