<x-layouts.main>
    <h1 class="page-header">
       Announcements
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <form class="panel panel-default" action="{{route('announcements.index')}}" method="POST">
        @csrf
        <div class="panel-heading">
            Create new announcement
        </div>
        <div class="panel-body">
            <x-input type="text" label="Title/Topic" name="title" required="1"></x-input>

            <x-textarea required="1" label="Details" name="details"></x-textarea>

            <x-boolean name="with_sms" label="With SMS" required="1"></x-boolean>
            <button class="btn btn-primary">Broadcast</button>
        </div>
    </form>
    @endif
    <br/>
    <div class="table-responsive ">
        <h2>Announcements</h2>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Title / Topic
                    </th>
                    <th>
                        Details
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $item)
                <tr>
                    <td>
                        {{$item->created_at->format('m-d-y')}}
                    </td>
                    <td>
                        {{$item->title}}
                    </td>
                    <td>
                        {{$item->details}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.main>
