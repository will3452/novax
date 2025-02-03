<x-auth>
    <div class="container-fluid">
        <h1>Calendar</h1>
        <div class="row">
            <div class="col-md-6">
                <x-calendar></x-calendar>
            </div>
            <div class="col-md-6">
                <table id="dt" class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\Event::get() as $item)
                            <td>
                                {{$item->title}}
                            </td>
                            <td>
                                {{$item->start->format('m/d/Y')}}
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-auth>
