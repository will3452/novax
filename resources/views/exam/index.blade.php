<x-new-layout>
    <x-page-title>
        Exams
    </x-page-title>
    <div class="flex justify-center my-5">
        @teacher
            <a href="/exam/create" class="btn btn-primary">Create New Exam</a>
        @endteacher
    </div>
    <div class="mt-4" id="exams">
        @empty($exams->toArray())
            <div class="alert alert-warning">
                No Examinations found!.
            </div>
        @else
        <div class="card-body card">
            <div class="table-responsive">
                <div class="p-2">
                    <div class="input-group input-group-outline mb-3">
                        <label for="" class="form-label">Search by title or date</label>
                        <input class="search form-control"/>
                        <button class="sort btn-secondary" data-sort="title">Sort By Title</button>
                        <button class="sort  btn-info" data-sort="date">Sort By Date</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Date Created
                            </th>
                            <th class="text-center">
                                Mode
                            </th>
                            <th class="text-center">
                                Title
                            </th>
                            @teacher
                            <th class="text-center">
                                Code
                            </th>
                            @endteacher
                            <th class="text-center">
                                Date
                            </th>
                            <th class="text-center">
                                Time Limit (Minutes)
                            </th>
                            <th class="text-center">
                                Strand
                            </th>
                            <th class="text-center">
                                Level
                            </th>
                            @teacher
                            @else
                            <th class="text-center">
                                Score
                            </th>
                            @endteacher
                            <th class="text-center">

                            </th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($exams as $e)
                            <tr>
                                <td class="text-center date">
                                    {{$e->created_at->format('m/d/y')}}
                                </td>
                                <td class="text-center">
                                    {{$e->is_manual_checking ? 'Manual Checking' : 'Automatic Checking'}}
                                </td>
                                <td class="text-center title">
                                    {{$e->name}}
                                </td>
                                @teacher
                                <td class="text-center">
                                    {{$e->code ?? 'N/a'}}
                                </td>
                                @endteacher
                                <td class="text-center">
                                    {{$e->opened_at->format('m/d/y')}}
                                </td>
                                <td class="text-center">
                                    {{$e->time_limit}}
                                </td>
                                <td class="text-center">
                                    {{$e->strand}}
                                </td>
                                <td class="text-center">
                                    {{$e->level}}
                                </td>
                                @teacher
                                @else
                                    <td>
                                        @if ($e->canTakeOf(auth()->id()))
                                            ---
                                        @else
                                                <span>
                                                    {{$e->getRecordOf(auth()->id())->score}}
                                                </span>
                                        @endif
                                    </td>
                                @endteacher
                                <td class="text-center">
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
                                                        {{-- {{$e->getRecordOf(auth()->id())->score}} --}}
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
    @push('scripts')
        <script>
            var options = {
            valueNames: [ 'title', 'date' ]
            };
            var userList = new List('exams', options);
        </script>
    @endpush
</x-new-layout>
