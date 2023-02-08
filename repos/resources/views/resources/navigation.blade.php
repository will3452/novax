@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
    @foreach($navigation as $group => $resources)
        @foreach($resources as $resource)
        <div class="mb-8">
            <router-link :to="{
                name: 'index',
                params: {
                    resourceName: '{{ $resource::uriKey() }}'
                }
            }" class="text-white text-justify no-underline dim items-center" style="margin:0px;" dusk="{{ $resource::uriKey() }}-resource-link">
                {!!$resource::icon()!!}

                {{ $resource::label() }}
            </router-link>
        </div>
        @endforeach
    @endforeach
@endif
