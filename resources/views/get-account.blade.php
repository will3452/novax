<x-new-layout>
    <div>
        <h1 class="text-center text-2xl">
            Account setting
        </h1>
        <div>
            <form action="update-password" method="POST" class="card-body" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="" class="form-label">Upload/Update Picture</label>
                    <x-input name="picture" required="0" type="file" />
                </div>
                <x-input name="current_password" label="Old Password" type="password"/>
                <x-input name="password" label="New Password" type="password"/>
                <x-input name="password_confirmation" label="Password Confirmation" type="password"/>
                <button class="btn btn-primary mt-4">
                     Submit
                </button>
            </form>
        </div>
    </div>
</x-new-layout>
