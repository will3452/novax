<x-auth>
    <div class="container">
        <h1>My Tasks</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V3m4.25 4.75L18.4 5.6M18 12h3m-4.75 4.25l2.15 2.15M12 18v3m-4.25-4.75L5.6 18.4M6 12H3m4.75-4.25L5.6 5.6"/></svg> Pending
                </h3>
                <div style="height: 70vh; overflow-y: auto;">

                    <x-task-pending></x-task-pending>
                </div>
            </div>
            <div class="col-md-6 ">
                <h3><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19 4c.852 0 1.297.986.783 1.623l-.076.084L15.915 9.5l3.792 3.793c.603.602.22 1.614-.593 1.701L19 15H6v6a1 1 0 0 1-.883.993L5 22a1 1 0 0 1-.993-.883L4 21V5a1 1 0 0 1 .883-.993L5 4z"/></svg>Done</h3>
                <div style="height: 70vh; overflow-y: auto;">

                    <x-task-done></x-task-done>
                </div>
            </div>
        </div>
    </div>
</x-auth>
