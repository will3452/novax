@props(['title'])
<div class="my-4"></div>
<div class="row">
    <div class="col-md-8">
        <table id="dt" class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Week</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($title->group->progresses()->latest()->get() as $item)
                    <tr>
                        <td>
                            {{$item->status}}
                        </td>
                        <td>
                            {{$item->week}}
                        </td>
                        <td>
                            {{$item->from_date->format('m/d/Y')}}
                        </td>
                        <td>
                            {{$item->to_date->format('m/d/Y')}}
                        </td>
                        <td>
                            {{$item->description}}
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm align-items-center gap-2" href="{{route('form', ['form' => 'progress', 'model' => $item])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2m-8-4h6m-6-4h6"/></g></svg>
                                Show Form
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Submit Progress Report
            </div>
            <div class="card-body">
                <form action="{{route('progress.store')}}" method="POST" class="d-flex flex-column gap-3">
                    @csrf
                    <input type="hidden" name="section_id" value="{{$title->section_id}}" />
                    <input type="hidden" name="group_id" value="{{$title->group->id}}" />
                    <div class="form-group">
                        <label for="" class="form-label">Week </label>
                        <select name="week" id="" class="form-select"text>
                            @for ($i = 1; $i < 15; $i++)
                                <option value="{{$i}}">
                                    Week {{$i}}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">From Date</label>
                        <input type="date" class="form-control" name="from_date">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">To Date</label>
                        <input type="date" class="form-control" name="to_date">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
