<x-layout>
    <x-header></x-header>
    <div class="welcome-area pt-100 pb-95">
        <div class="container">
            <div class="welcome-content text-center">
                <h5>Who Are We</h5>
                <h1>Welcome To Dormifind</h1>
                <p>{{nova_get_setting('about', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labor et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo consequat irure')}}</p>
            </div>
        </div>
        <x-map></x-map>
    </div>
</x-layout>
