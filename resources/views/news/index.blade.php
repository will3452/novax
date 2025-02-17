<x-auth>
    <div class="container">
        <h1>News and Announcements</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-body">
                    <table id="dt" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Subject</th>
                                <th>Body</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcements as $item)
                                <tr>
                                    <td>
                                        {{$item->created_at->format('m/d/Y')}}
                                    </td>
                                    <td>
                                        {{$item->subject}}
                                    </td>
                                    <td>
                                        {{$item->body}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Create Announcement/News
                    </div>
                    <div class="card-body">
                        <form class="d-flex flex-column gap-3" action="{{route('news.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Body</label>
                                <textarea name="body" id="" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth>
