<x-auth>
    <div class="container">
        <div class="card">
            <div class="card-header">
                User Details
            </div>
            <div class="card-body">
                <x-account :user="$user" :signature="false"></x-account>
            </div>
        </div>

    </div>
</x-auth>
