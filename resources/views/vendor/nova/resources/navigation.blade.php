@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
    @foreach($navigation as $group => $resources)

        <ul class="list-reset mb-8">
            @foreach($resources as $resource)
                <li class=" mb-4 text-sm">

                    <router-link :to="{
                        name: 'index',
                        params: {
                            resourceName: '{{ $resource::uriKey() }}'
                        }
                    }" class="  flex text-white no-underline dim p-0" dusk="{{ $resource::uriKey() }}-resource-link">
                        {!!$resource::icon() !!} <span class="mx-2">{{ $resource::label() }}</span>
                    </router-link>
                </li>
            @endforeach
        </ul>
    @endforeach
@endif
