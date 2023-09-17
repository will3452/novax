<?php

namespace App\Http\Middleware;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'user' => fn() => $request->user(),
            'drivers' => fn() => User::whereType(User::TYPE_DRIVER)->latest()->get(),
            'fd' => fn() => nova_get_setting('FD', 12),
            'af' => fn() => nova_get_setting('AF', 5),
            'bookings' => fn() => Booking::with(['server'])->whereClientId(auth()->id())->latest()->get(),
            'requests' => fn() => Booking::with(['client'])->whereServerId(auth()->id())->latest()->get(),
        ]);
    }
}