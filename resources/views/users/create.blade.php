<x-layouts.main>
    <h1 class="page-header">
        Users
    </h1>
    <div>
        <form action="{{route('users.index')}}" class="panel panel-default" method="POST">
            <div class="panel-heading ">
                Users
            </div>
            @csrf
            <div class="panel-body">
                <input type="hidden" name="role" value="BASIC" />
                <x-input required="1" name="name" label="Name"></x-input>
                <x-input required="1" name="mobile" label="Cellphone #"></x-input>
                <x-input required="1" name="address" label="Address"></x-input>
                {{-- <x-select name="role" label="Role" :option-value="['ADMIN', 'BASIC']" :option-label="['Administrator', 'Basic']" required="1"></x-select> --}}
                <x-input name="email" type="email" required="1" label="Email address" help="Make sure the email is valid, for email verification."></x-input>
                <x-input name="password" type="password" required="1" label="Password"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
