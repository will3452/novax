<router-link exact tag="h3"
    :to="{
        name: 'dashboard.custom',
        params: {
            name: 'main'
        }
    }"
    class="cursor-pointer flex items-center font-normal dim text-white mb-8 text-base no-underline">
    <span class="text-white sidebar-label">{{ __('Dashboard') }}</span>
</router-link>
@if (\Laravel\Nova\Nova::availableDashboards(request()))
    <ul class="list-reset mb-8">
        @foreach (\Laravel\Nova\Nova::availableDashboards(request()) as $dashboard)
            <li class="leading-wide mb-4 ml-8 text-sm">
                <router-link :to='{
                    name: "dashboard.custom",
                    params: {
                        name: "{{ $dashboard::uriKey() }}",
                    },
                    query: @json($dashboard->meta()),
                }'
                exact
                class="text-white no-underline dim">
                    {{ $dashboard::label() }}
                </router-link>
            </li>
        @endforeach
    </ul>
@endif
