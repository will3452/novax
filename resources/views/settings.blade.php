<x-auth>
    <div class="container">
        <h1>Settings</h1>
        <form action="{{route('settings')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="" class="form-label">
                    Coordinator
                </label>
                <select class="form-select" name="coordinator_id" id="s">
                    @foreach (\App\Models\User::whereType('Faculty')->get() as $item)
                        <option value="{{$item->id}}" {{nova_get_setting('coordinator_id') == $item->id ? 'selected': ''}}>
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label">
                    Program Chair
                </label>
                <select class="form-select" name="programchair_id" id="s2">
                    @foreach (\App\Models\User::whereType('Faculty')->get() as $item)
                        <option value="{{$item->id}}" {{nova_get_setting('programchair_id') == $item->id ? 'selected': ''}}>
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label" >
                    School Year
                </label>
                <select class="form-select" name="school_year" id="sy">
                    @foreach (\App\Models\SchoolYear::get() as $item)
                        <option value="{{$item->name}}" {{nova_get_setting('school_year') == $item->name ? 'selected': ''}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label" >
                    Term
                </label>
                <select class="form-select" name="term" id="t">
                    @foreach (\App\Models\Term::get() as $item)
                        <option value="{{$item->name}}" {{nova_get_setting('term') == $item->name ? 'selected': ''}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary mt-2">Save</button>
        </form>
    </div>

    <script>
        $('#s').select2()
        $('#s2').select2()
        $('#sy').select2()
        $('#t').select2()
    </script>
</x-auth>
