<x-new-layout>
    <h4>
        Edit User
    </h4>
    <form action="{{route('admin.user.update', ['user' => $user->id])}}" method="POST" class="card-body">
        @method('PUT')
        @csrf
        <x-select name="type" label="Account Type">
            <option {{$user->type ==\App\Models\User::TYPE_STUDENT ? 'selected':'' }} value="{{\App\Models\User::TYPE_STUDENT}}">{{\App\Models\User::TYPE_STUDENT}}</option>
            <option {{$user->type ==\App\Models\User::TYPE_TEACHER ? 'selected':'' }} value="{{\App\Models\User::TYPE_TEACHER}}">{{\App\Models\User::TYPE_TEACHER}}</option>
        </x-select>
        <x-input name="name" label="Name" type="text" value="{{$user->name}}"/>
        <x-input name="email" label="Email" type="email" value="{{$user->email}}"/>
        <x-input name="password" label="New Password" type="password" required="0"/>
        <x-input name="number" label="Student # / LRN" type="text" value="{{$user->number}}"/>
        <x-select name="level" label="Level" >
            @foreach (\App\Models\User::LEVEL as $l)
                <option {{$user->level ==$l ? 'selected':'' }} value="{{$l}}">{{$l}}</option>
            @endforeach
        </x-select>
        <x-select name="strand" label="Strand">
            @foreach (\App\Models\User::STRAND as $s)
                <option {{$user->strand ==$s ? 'selected':'' }} value="{{$s}}">{{$s}}</option>
            @endforeach
        </x-select>
        <button class="btn btn-primary">Save Changes</button>
    </form>
</x-new-layout>
