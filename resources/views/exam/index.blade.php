<x-layout>
    <x-page-title>
        Exams
    </x-page-title>
    <div class="flex justify-center my-5">
        @teacher
        <x-modal button="Create new Exam">
            <form action="/exams" method="POST">
                @csrf
                <div class="form-conrol">
                    <div class="label">
                        <div class="label-text">Auto Check / Manual Check</div>
                    </div>
                    <select name="is_manual_checking" id="" class="select w-full select-bordered">
                        <option value="0">Auto Check</option>
                        <option value="1">Manual Check</option>
                    </select>
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Title</div>
                    </div>
                    <input type="text" name="name" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Description</div>
                    </div>
                    <input type="text" name="description" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Date to open</div>
                    </div>
                    <input type="date" name="opened_at" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Time constraint (in minutes)</div>
                    </div>
                    <input type="number" name="time_limit" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Strand</div>
                    </div>
                    <select name="strand" class="select select-bordered w-full" required>
                        @foreach (\App\Models\User::STRAND as $s)
                            <option value="{{$s}}">{{$s}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Year Level</div>
                    </div>
                    <select name="level" class="select select-bordered w-full" required>
                        @foreach (\App\Models\User::LEVEL as $s)
                            <option value="{{$s}}">{{$s}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-control my-2" x-data="{
                    hasCode:false,
                    toggle() {
                        this.hasCode = !this.hasCode;
                    },
                }">
                    <div class="flex">
                        <div>
                            <input type="checkbox" x-on:click="toggle" class="block checkbox checkbox-md">
                        </div>
                        <div class="ml-4">
                            Check if you want to secured with code.
                        </div>
                    </div>
                    <template x-if="hasCode">
                        <div class="form-control">
                            <div class="label">
                                <div class="label-text">Code</div>
                            </div>
                            <input type="text" name="code" class="input input-bordered w-full" required>
                        </div>
                    </template>
                </div>
                <button class="btn btn-primary mt-2">
                    Create Now
                </button>
            </form>
        </x-modal>
        @endteacher
    </div>
    <div class="mt-4">
        @empty($exams->toArray())
            <div class="alert alert-warning">
                No Examinations found!.
            </div>
        @else
        <x-table>
            <thead>
                <tr>
                    <th>
                        Date Created
                    </th>
                    <th>
                        Auto
                    </th>
                    <th>
                        Description
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
                            {{$e->is_manual_checking ? 'Manual' : 'Auto'}}
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
                                <x-modal button="edit" extra="btn-sm">
                                    <form action="/exams/{{$e->id}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-control">
                                            <div class="label">
                                                <div class="label-text">Title</div>
                                            </div>
                                            <input type="text" name="name" value="{{$e->name}}" class="input input-bordered w-full" required>
                                        </div>
                                        <div class="form-control">
                                            <div class="label">
                                                <div class="label-text">Description</div>
                                            </div>
                                            <input type="text" name="description" value="{{$e->description}}" class="input input-bordered w-full" required>
                                        </div>
                                        <div class="form-control">
                                            <div class="label">
                                                <div class="label-text">Date to open</div>
                                            </div>
                                            <input type="text" name="opened_at" value="{{$e->opened_at->format('m/d/Y')}}" class="input input-bordered w-full" required>
                                        </div>
                                        <div class="form-control">
                                            <div class="label">
                                                <div class="label-text">Time constraint (in minutes)</div>
                                            </div>
                                            <input type="number" name="time_limit" value="{{$e->time_limit}}" class="input input-bordered w-full" required>
                                        </div>
                                        <div class="form-control">
                                            <div class="label">
                                                <div class="label-text">Strand</div>
                                            </div>
                                            <select name="strand" class="select select-bordered w-full" required>
                                                @foreach (\App\Models\User::STRAND as $s)
                                                    <option value="{{$s}}" {{$s === $e->strand ? 'selected':''}}>{{$s}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-control">
                                            <div class="label">
                                                <div class="label-text">Year Level</div>
                                            </div>
                                            <select name="level" class="select select-bordered w-full" required>
                                                @foreach (\App\Models\User::LEVEL as $s)
                                                    <option value="{{$s}}" {{$s === $e->level ? 'selected':''}}>{{$s}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-control">
                                            <div class="label">
                                                <div class="label-text">Code</div>
                                            </div>
                                            <input type="text" name="code" value="{{$e->code}}" class="input input-bordered w-full">
                                        </div>
                                        <button class="btn btn-primary mt-2">
                                            Update Now
                                        </button>
                                    </form>
                                </x-modal>
                                <x-modal button="delete" extra="btn-warning btn-sm">
                                    <h1>
                                        Please type <span class="kbd">{{$e->name}}</span> to run this action.
                                    </h1>
                                    <form method="POST" class="mt-2 w-full" action="/exams/{{$e->id}}">
                                        @method('delete')
                                        @csrf
                                        <input type="text" requried name="key" class="block w-full input input-bordered" placeholder="Aa">
                                        <button class="btn btn-primary mt-2 ">
                                            Ok, Proceed.
                                        </button>
                                    </form>
                                </x-modal>
                            @else
                                @if (! $e->hasRecordOf(auth()->id()))
                                    @if ($e->canTakeNow())
                                    <x-modal button="Take now" extra="btn-sm">
                                        <form action="/take-now/{{$e->id}}" method="POST">
                                            @csrf
                                            <h1>Do you want to take <span class="font-bold">{{$e->name}}</span> now?</h1>
                                            @if ($e->code)
                                                <div class="my-2">
                                                    <div class="label">
                                                        <div class="label-text">Please enter the code</div>
                                                    </div>
                                                    <input type="text" class="input input-bordered w-full" name="code">
                                                    <div class="label">
                                                        <div class="label-text text-xs">You can get the code to the assigned teacher.</div>
                                                    </div>
                                                </div>
                                            @endif
                                            <button class="btn btn-primary">Take Now</button>
                                        </form>
                                    </x-modal>
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
        </x-table>
        @endempty

    </div>
</x-layout>
