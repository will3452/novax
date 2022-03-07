<x-layout>
    <x-container>
        <x-header>
            My Profile
        </x-header>
        <div class="flex justify-center mt-4">
            <form action="/profile" method="POST" class="w-full md:w-1/2">
                @csrf
                <div class="mb-4">
                    <label for="">Name</label>
                    <input type="text" class="w-full input input-bordered" disabled value="{{auth()->user()->name}}">
                </div>
                <div class="mb-4">
                    <label for="">Email</label>
                    <input type="email" class="w-full input input-bordered" disabled value="{{auth()->user()->email}}">
                </div>
                <div class="mb-4">
                    <label for="">Phone #</label>
                    <input type="number" name="phone" class="w-full input input-bordered" required value="{{auth()->user()->phone}}">
                </div>

                <div class="mb-4">
                    <label for="">Address</label>
                    <input type="text" name="address" class="w-full input input-bordered" required value="{{auth()->user()->address}}">
                </div>

                <div class="mb-4">
                    <label for="">New Password</label>
                    <input type="password" name="password" class="w-full input input-bordered" required value="">
                </div>

                <button type="submit" class="btn btn-primary">
                    Save
                </button>
                <button type="reset" class="btn btn-danger">
                    Reset
                </button>
            </form>
        </div>
    </x-container>
</x-layout>
