<x-layout>
    <x-container>
        <h1 class="text-2xl">
            Welcome {{auth()->user()->name}} !
        </h1>
        <div class="flex mt-8 flex-wrap">
            @teacher
                <x-card title="My Room" proceed-text="Visit" action="/teacher/room">
                </x-card>
            @endteacher
            @student
                <x-card title="My Room" proceed-text="Visit" action="/student/room">
                </x-card>
            @endstudent
            <x-card title="My Profile" proceed-text="Visit" action="/profile">
            </x-card>
            <x-card title="Contact Us" proceed-text="Visit" action="/contact">
            </x-card>
            <x-card title="Report Issue" proceed-text="Visit" action="/report-issue">
            </x-card>
        </div>
        @parent
            <x-students :students="auth()->user()->students"></x-students>
        @endparent
        <script>
            window.onload = function () {
                sessionStorage.clear();
            }
        </script>
    </x-container>
</x-layout>
