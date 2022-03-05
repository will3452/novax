<x-layout>
    <x-container>
        <x-header>
            {{$model->name}} (Record/s)
        </x-header>
        @project($model)
            <x-project-details :activity="$model"></x-project-details>
        @endproject
        <x-table-container>
            <x-table>
                <thead>
                    <tr>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Student
                        </th>
                        @project($model)
                            <th>
                                File
                            </th>
                        @endproject
                        @activity($model)
                            <th>
                                Score
                            </th>
                        @endactivity
                        @project($model)
                            <th>

                            </th>
                        @endproject
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>
                                {{$record->created_at->format('M d, Y h:i A')}}
                            </td>
                            <td>
                                {{$record->user->name}} ({{$record->user->student_number}})
                            </td>
                            @project($model)
                                <td>
                                    @if (is_null($record->file))
                                        N/a
                                    @else
                                    <a class="underline" target="_blank" href="/storage/{{$record->file}}">
                                        View Submission.
                                    </a>
                                    @endif
                                </td>
                            @endproject
                            @activity($model)
                                <td>
                                    {{$record->score ?? 'N/a'}}
                                </td>
                            @endactivity
                            @project($model)
                                @teacher
                                <td>
                                    <label for="{{$record->id}}" class="btn modal-button">
                                        Update Score
                                    </label>
                                    <input type="checkbox" id="{{$record->id}}" class="modal-toggle">
                                    <div class="modal">
                                        <div class="modal-box">
                                            <form action="/update-score/{{$record->id}}" method="POST">
                                                @csrf
                                                <div>
                                                    <label for="" class="block">Score: </label>
                                                    <input name="score" type="text" required value="{{$record->score}}" placeholder="eg. 4/5" class="border p-2">
                                                    <button type="submit" class="btn btn-sm">Save</button>
                                                    <label for="{{$record->id}}" class="btn btn-sm">Cancel</label>
                                                </div>
                                                <div class="text-xs">
                                                    eg. 9/10 or 15/15.
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                @endteacher
                            @endproject
                        </tr>
                    @endforeach
                </tbody>
            </x-table>
        </x-table-container>
    </x-container>
</x-layout>
