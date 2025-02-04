<x-auth>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Calendar
                    </div>
                    <div class="card-body">
                        <x-calendar></x-calendar>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Events
                    </div>
                    <div class="card-body">
                        <table id="dt" class="table table-bordered table-striped mt-4">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\Event::get() as $item)
                                    <tr>
                                        <td>
                                            {{$item->title}}
                                        </td>
                                        <td>
                                            {{$item->start->format('m/d/Y')}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth>
