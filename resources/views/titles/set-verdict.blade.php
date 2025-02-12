<x-auth>
    <div class="container">
        <form action="{{route('titles.store.verdict')}}" method="POST">
            @csrf
            {{-- <x-title-group :title="$title"></x-title-group> --}}
            <div class="card">
                <div class="card-header">
                    Group Details
                </div>
                <div class="card-body">
                    <div>
                        <b>Title: </b> {{$title->title}}
                    </div>
                    <div>
                        <b>Group Code: </b> {{$title->group->code}}
                    </div>
                    <div>
                        <b>Members: </b> {{$title->line_members }}
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <label for="" class="form-label">Select verdict</label>
                <select name="verdict" id="" class="form-select">
                    @foreach (['Approved with no revisions', 'Approved with minor revisions', 'Approved with major revisions', 'Disapproved', 'For Redefense'] as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="group_id" value="{{$title->group->id}}" />
                <button class="btn btn-primary mt-2">Submit</button>
            </div>
        </form>
    </div>
</x-auth>
