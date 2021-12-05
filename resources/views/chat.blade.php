<x-layout>
    @if (auth()->user()->type == \App\Models\User::TYPE_SEEKER)
        <x-navbar></x-navbar>
    @endif
    <x-content>
        <chat-talk  user="{{auth()->user()}}" other="{{request()->other_id ? \App\models\User::find(request()->other_id) : auth()->user()}}"></chat-talk>
    </x-content>
</x-layout>
