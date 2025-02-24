@props(['title'])
<div class="card mt-2">
    <div class="card-header">Bulletin Board</div>
    <div class="card-body">
        <form action="/comment" method="POST">
            @csrf
            <input type="hidden" name="group_id" value="{{$title->group->id}}">
            <div class="row">
                <div class="col-md-11">
                    <textarea name="value" class="form-control" rows="2" placeholder="Enter Message here."></textarea>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary">Send</button>
                </div>
            </div>
            @forelse ($title->group->comments()->latest()->get() as $item)
                <div class="card mt-2">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{$item->user->name}}" alt="" style="width: 35px;border-radius:50%;">
                            <div>
                                <div>
                                    {{$item->user->name}}
                                </div>
                                <div style="font-size: 12px;">
                                    {{$item->user->type}}
                                </div>
                            </div>
                        </div>
                        <div>
                            {{$item->created_at->diffForHumans()}}
                        </div>
                    </div>
                    <div class="card-body">
                        {{$item->value}}
                    </div>
                </div>
            @empty
                <div class="text-center">
                    No Record.
                </div>
            @endforelse
        </form>
    </div>
</div>
