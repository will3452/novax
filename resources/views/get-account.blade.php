<x-layout>
    <div>
        <h1 class="text-center text-2xl">
            My Account
        </h1>
        <div>
            <form action="update-password" method="POST">
                @csrf
                <div class="form-control">
                    <label for="" class="label">
                        <span class="label-text">Old Password</span>
                    </label>
                    <input type="password" name="current_password" class="input input-bordered">
                </div>
                <div class="form-control">
                    <label for="" class="label">
                        <span class="label-text">New Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered">
                </div>
                <div class="form-control">
                    <label for="" class="label">
                        <span class="label-text">Re-type New Password</span>
                    </label>
                    <input type="password" name="password_confirmation" class="input input-bordered">
                </div>
                <button class="btn btn-primary mt-4">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</x-layout>
