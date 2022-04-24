<x-new-layout>
    <div>
        <h1 class="text-center text-2xl">
            Account Setting
        </h1>
        <div class="card-body">
            <form action="">
                <div>
                    <form action="update-picture" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="" class="form-label">Upload/Update Picture</label>
                        <x-input name="picture" required="0" type="file" />
                        <button class="btn btn-primary mt-4">
                            Submit
                       </button>
                    </form>
                </div>
            </form>
            <form action="update-password" method="POST" class="card-body">
                @csrf
                <x-input name="current_password" label="Old Password" type="password" required="0"/>
                <x-input name="password" label="New Password" type="password" required="0"/>
                <x-input name="password_confirmation" label="Password Confirmation" type="password" required="0"/>
                <button class="btn btn-primary mt-4">
                     Submit
                </button>
            </form>
        </div>
    </div>
</x-new-layout>
