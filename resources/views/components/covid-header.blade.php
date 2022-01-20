<a href="/covid" class=" block flex justify-center bg-white">
    <img class="w-20" src="{{nova_get_setting('logo') ? '/storage/' : ''}}{{nova_get_setting('logo')}}" alt="">
</a>

@if (url()->current() !== route('covid.index'))
    <a href="/covid" class="inline-block p-2 m-2 rounded shadow bg-red-700 text-white">BACK</a>
@endif
