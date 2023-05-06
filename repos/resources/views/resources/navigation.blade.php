@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))

    @foreach($navigation as $group => $resources)
        @if (count($groups) > 1)
            <h4 class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide">{{ $group }}</h4>
        @endif

        <ul class="list-reset mb-8">
            @foreach($resources as $resource)
            <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
                {!!$resource::icon()!!}

                <span class="sidebar-label">
                    <router-link :to="{
                    name: 'index',
                    params: {
                        resourceName: '{{ $resource::uriKey() }}'
                    }
                }" class="text-white text-justify no-underline dim" dusk="{{ $resource::uriKey() }}-resource-link">
                    {{ $resource::label() }}
                </router-link>
            </span>
            </h3>
            @endforeach
        </ul>
    @endforeach
@endif
