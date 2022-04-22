<x-new-layout>
    <h4>Edit exam ({{$exam->name}})</h4>
    <form action="/exams/{{$exam->id}}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        <div class="my-2">
            <div class="label">
                <div class="label-text">Checking mode</div>
            </div>
            <select name="is_manual_checking" id="" class="form-control border p-2">
                <option value="0" {{$exam->is_manual_checking == 0 ? 'selected':''}}>Auto Check</option>
                <option value="1" {{$exam->is_manual_checking == 1 ? 'selected':''}}>Manual Check</option>
            </select>
        </div>
        <x-input name="name" label="Title" type="text" value="{{$exam->name}}"/>
        <x-input name="description" label="Description" value="{{$exam->description}}"/>
        <x-date name="opened_at" label="Date to open" type="date" value="{{$exam->opened_at->format('Y-m-d')}}"/>
        <x-input name="time_limit" label="Time constraint (in minutes)" type="number" value="{{$exam->time_limit}}"/>
        <x-select name="strand" label="Choose Strand">
            @foreach (\App\Models\User::STRAND as $s)
                <option value="{{$s}}" {{$exam->strand == $s ? 'selected':''}}>{{$s}}</option>
            @endforeach
        </x-select>
        <x-select name="level" label="Choose Leven">
            @foreach (\App\Models\User::LEVEL as $s)
                    <option value="{{$s}}" {{$exam->strand == $s ? 'selected':''}}>{{$s}}</option>
                @endforeach
        </x-select>
        <div>
            <label for="">Code</label>
            <div>
                <input type="text" name="code" value="{{$exam->code}}">
            </div>
        </div>
        <button class="btn btn-primary mt-2">
            Save Changes
        </button>
    </form>
</x-new-layout>
