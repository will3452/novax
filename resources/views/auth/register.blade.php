<x-layout>

<div class="hero min-h-screen bg-base-200">
    <form action="register" method="POST" class="card flex-shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
        @csrf
        <div class="card-body">
        @if (session('success'))
            <x-alert-success>
                Registered Succesfully!
            </x-alert-success>
        @endif
        <div>
            <a href="/">Back to Home</a>
        </div>
        <h1 class="uppercase text-center font-bold text-gray-700 text-2xl">Register</h1>
        <div class="form-control">
            <label for="" class="label">
                Package
            </label>
            <select class="select select-bordered" name="package_id">
                @foreach (\App\Models\Package::get() as $item)
                    <option {{ $item->id == request()->package ? 'selected' : '' }} value="{{$item->id}}">{{ $item->name }} - PHP {{$item->price}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Firt Name</span>
            </label>
            <input type="text" value="{{old('first_name')}}" name="first_name" required placeholder="First Name" class="input input-bordered">
            @error('first_name')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Last Name</span>
            </label>
            <input type="text" value="{{old('last_name')}}" name="last_name" required placeholder="Last Name" class="input input-bordered">
            @error('last_name')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Name</span>
            </label>
            <input type="text" value="{{old('middle_name')}}" name="middle_name" placeholder="Middle Name" class="input input-bordered">
            @error('middle_name')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Address</span>
            </label>
            <input type="text" value="{{old('address')}}" name="address" required placeholder="Address" class="input input-bordered">
            @error('address')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Birthday</span>
            </label>
            <input type="date" value="{{old('birthday')}}" name="birthday" required placeholder="birthday" class="input input-bordered">
            @error('birthday')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Phone #</span>
            </label>
            <input type="text" value="{{old('phone')}}" name="phone" required placeholder="phone" class="input input-bordered">
            @error('phone')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input type="text" value="{{old('email')}}" name="email" required placeholder="email" class="input input-bordered">
            @error('email')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
            </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Password</span>
            </label>
            <input type="password" name="password" required placeholder="password" class="input input-bordered">
            @error('password')
            <x-form-error>
                {{$message}}
            </x-form-error>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Confirm Password</span>
            </label>
            <input type="password" placeholder="password" required name="password_confirmation" class="input input-bordered">
        </div>
        <div class="form-control mt-6">
            <input type="submit" value="Register" class="btn btn-primary">
            <a class="block text-center text-xs mt-4 underline" href="/admin/login">Already have an account?</a>
        </div>
        </div>
        <input type="hidden" name="created_by_user_id" value="1">
    </form>
</div>
</x-layout>
