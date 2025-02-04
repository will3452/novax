<x-auth>
    <div class="container">
        <h1>Are you sure you want to reject task #{{$task->id}}? </h1>
        <div>
            <form action="{{route('tasks.reason.reject', $task)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">
                        Reason
                    </label>
                    <textarea name="reason" id="" class="form-control" placeholder="Example; Lack of requirements, Not valid and etc..,"></textarea>
                </div>
                <div class="d-flex mt-2 gap-2">
                    <a href="/tasks" class="btn">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-danger">Submit reason and continue</button>
                </div>
            </form>
        </div>
    </div>
</x-auth>
