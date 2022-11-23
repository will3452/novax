<x-layouts.main>
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
                <x-select :value="$user->role" name="role" label="Role" :option-value="['ADMIN', 'BASIC']" :option-label="['Administrator', 'Basic']" required="1"></x-select>
                <x-input :value="$user->email"  name="email" label="Email Address"></x-input>
                <x-input  type="password" name="password" label="Password"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
