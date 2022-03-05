<x-layout>
    <x-container>
        <h1 class="text-2xl">
            Welcome {{auth()->user()->name}} !
        </h1>
        <div class="flex mt-8">
            @teacher
                <x-card title="My Room" proceed-text="Goto My Room" action="/teacher/room">
                </x-card>
            @endteacher
        </div>
        @parent
            <x-students :students="auth()->user()->students"></x-students>
        @endparent
    </x-container>
</x-layout>
