@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
    @foreach($navigation as $group => $resources)
        @if (count($groups) > 1)
            <h4 class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide">{{ $group }}</h4>
        @endif

        <ul class="list-reset mb-8">
            @foreach($resources as $resource)
                <router-link exact tag="h3"
                    :to="{
                        name: 'index',
                        params: {
                            resourceName: '{{ $resource::uriKey() }}'
                        }
                    }"
                    class="cursor-pointer flex items-center font-normal dim text-white mb-8 text-base no-underline">
                    <span class="text-white sidebar-label"> {{ $resource::label() }}</span>
                </router-link>
            @endforeach
        </ul>
    @endforeach
@endif
