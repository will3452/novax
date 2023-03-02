<x-.main>
    <h1 class="page-header">
        Users
    </h1>
    <div>
        <form action="{{route('users.update', ['user' => $user->id])}}" class="panel panel-default" method="POST">
            @method('PUT')
            <div class="panel-heading ">
                Details Update
            </div>
            @csrf
            <div class="panel-body">
                <input type="hidden" name="role" value="BASIC" />
                <x-input :value="$user->name" required="1" name="name" label="Name"></x-input>
                <x-input :value="$user->mobile" required="1" name="mobile" label="Cellphone #"></x-input>
                <x-input :value="$user->address" required="1" name="address" label="Address"></x-input>
                <x-input :value="$user->email"  name="email" label="Email Address"></x-input>
                <x-input  type="password" name="password" label="Password"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-.main>
