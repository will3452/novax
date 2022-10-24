<x-layout>
    <div class="hero min-h-screen"style="background:url('/storage/{{nova_get_setting('landing_background')}}'); background-size:cover; background-position:center;" >
        <div class="flex-col hero-content lg:flex-row backdrop-blur-sm">
          <x-illustration></x-illustration>
          {{nova_get_setting('landing_image')}}
          <div>
            <h1 class="text-5xl font-bold">Memory Virtual and Health Related Application</h1>
            <p class="py-6">{{nova_get_setting('landing_message', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eum, corrupti deleniti corporis quidem laborum alias in. Quidem nobis at nulla.')}}</p>
            <a href="/login" class="btn bg-gray-500 border-0 text-white">LOGIN</a>
            <div>
                If you don't have account click <a href="/register" class="text-blue-600 underline">here</a>
            </div>
          </div>
        </div>
      </div>
</x-layout>
