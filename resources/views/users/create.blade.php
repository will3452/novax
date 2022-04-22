<x-new-layout>
    <h4>
        Create new user
    </h4>
    <form action="{{route('admin.user.store')}}" method="POST" class="card-body">
        @csrf
        <x-select name="type" label="Account Type">
            <option value="{{\App\Models\User::TYPE_STUDENT}}">{{\App\Models\User::TYPE_STUDENT}}</option>
            <option value="{{\App\Models\User::TYPE_TEACHER}}">{{\App\Models\User::TYPE_TEACHER}}</option>
        </x-select>
        <x-input name="name" label="Name" type="text"/>
        <x-input name="email" label="Email" type="email"/>
        <x-input name="number" label="Student # / LRN" type="text"/>
        <x-select name="level" label="Level">
            @foreach (\App\Models\User::LEVEL as $l)
                <option value="{{$l}}">{{$l}}</option>
            @endforeach
        </x-select>
        <x-select name="strand" label="Strand">
            @foreach (\App\Models\User::STRAND as $s)
                <option value="{{$s}}">{{$s}}</option>
            @endforeach
        </x-select>
        <button class="btn btn-primary">Save User</button>
    </form>
</x-new-layout>
