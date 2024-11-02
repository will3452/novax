@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
    <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill="var(--sidebar-icon)" d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z"
            />
        </svg>
        <span class="sidebar-label">{{ __('Resources') }}</span>
    </h3>

    @foreach($navigation as $group => $resources)
        @if (count($groups) > 1)
            @php
              $newGroupName = substr($group, 1);
            @endphp
            <h4 class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide">{{ $newGroupName }}</h4>
        @endif

        <ul class="list-reset mb-8">
            @foreach($resources as $resource)
                <li class="leading-tight mb-4 ml-8 text-sm">
                    <router-link :to="{
                        name: 'index',
                        params: {
                            resourceName: '{{ $resource::uriKey() }}'
                        }
                    }" class="text-white text-justify no-underline dim" dusk="{{ $resource::uriKey() }}-resource-link">
                        {{ $resource::label() }}
                    </router-link>
                </li>
            @endforeach
        </ul>
    @endforeach

    @if (auth()->user()->type == 'Administrator')
    <a href="/admin/resources/users">

        <h3 class="cursor-pointer flex items-center font-normal dim text-white mb-6 text-base no-underline">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"  class="sidebar-icon size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
              </svg>

        Admin Accounts
    </span></h3>
    </a>
    @endif
@endif
