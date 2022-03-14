<x-layout>
    <x-page-title>
        Exams
    </x-page-title>
    <div class="flex justify-center my-5">
        <x-modal button="Create new Exam">
            <form action="/exams" method="POST">
                @csrf
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Description</div>
                    </div>
                    <input type="text" name="name" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Duration</div>
                    </div>
                    <div class="flex">
                        <div class="p-1 w-1/2">
                            <div class="text-xs">
                                From
                            </div>
                            <input type="date" name="opened_at" class="input input-bordered w-full" required>
                        </div>
                        <div class="p-1 w-1/2">
                            <div class="text-xs">
                                To
                            </div>
                            <input type="date" name="closed_at" class="input input-bordered w-full" required>
                        </div>
                    </div>
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
                        Description
                    </th>
                    <th>
                        Code
                    </th>
                    <th>
                        Duration
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
                        Actions
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
                            {{$e->name}}
                        </td>
                        <td>
                            {{$e->code ?? 'N/a'}}
                        </td>
                        <td>
                            {{$e->opened_at->format('m/d/y')}} - {{$e->closed_at->format('m/d/y')}}
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
                            <a href="/exams/{{$e->id}}" class="btn btn-primary btn-sm">view</a>
                            <x-modal button="edit" extra="btn-sm">
                                EDIT
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
        @endempty

    </div>
</x-layout>
