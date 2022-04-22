<x-new-layout>
    <x-page-title>
        Exams
    </x-page-title>
    <div class="flex justify-center my-5">
        @teacher
            <a href="/exam/create" class="btn btn-primary">Create New Exam</a>
        @endteacher
    </div>
    <div class="mt-4">
        @empty($exams->toArray())
            <div class="alert alert-warning">
                No Examinations found!.
            </div>
        @else
        <div class="card-body card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Date Created
                            </th>
                            <th>
                                Mode
                            </th>
                            <th>
                                Title
                            </th>
                            @teacher
                            <th>
                                Code
                            </th>
                            @endteacher
                            <th>
                                Date
                            </th>
                            <th>
                                Time Limit (Minutes)
                            </th>
                            <th>
                                Strand
                            </th>
                            <th>
                                Level
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $e)
                            <tr>
                                <td>
                                    {{$e->created_at->format('m/d/y')}}
                                </td>
                                <td>
                                    {{$e->is_manual_checking ? 'Manual Checking' : 'Automatic Checking'}}
                                </td>
                                <td>
                                    {{$e->name}}
                                </td>
                                @teacher
                                <td>
                                    {{$e->code ?? 'N/a'}}
                                </td>
                                @endteacher
                                <td>
                                    {{$e->opened_at->format('m/d/y')}}
                                </td>
                                <td>
                                    {{$e->time_limit}}
                                </td>
                                <td>
                                    {{$e->strand}}
                                </td>
                                <td>
                                    {{$e->level}}
                                </td>
                                <td>
                                    @teacher
                                        <a href="/exams/{{$e->id}}" class="btn btn-primary btn-sm">view</a>
                                        <a href="/exams/edit/{{$e->id}}" class="btn btn-secondary btn-sm">edit</a>
                                        <a href="/exams/delete/{{$e->id}}" class="btn btn-danger btn-sm">delete</a>
                                    @else
                                        @if (! $e->hasRecordOf(auth()->id()))
                                            @if ($e->canTakeNow())
                                                <a href="/take-confirm/{{$e->id}}" class="btn btn-primary btn-sm">Take now</a>
                                            @else
                                            <button class="btn btn-sm" disabled>Take Now</button>
                                            @endif
                                        @else
                                            @if ($e->canTakeOf(auth()->id()))
                                                    <a href="/take/{{$e->getRecordIdOf(auth()->id())}}" class="btn btn-primary btn-sm">continue</a>
                                                @else
                                                    <span>
                                                        {{$e->getRecordOf(auth()->id())->score}}
                                                    </span>
                                            @endif
                                        @endif
                                    @endteacher
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endempty
    </div>
</x-new-layout>
