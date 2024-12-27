@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row g-3">

            <div class="col-12 col-md-4">
                <div class="card mb-3">
                    <div class="card-header d-flex gap-2 align-items-center">
                        <svg style="width:25px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Time In/Out
                    </div>
                    <div class="card-body">
                        <Attendance user-id="{{ auth()->id() }}" />
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header gap-2 d-flex align-items-center">
                        <svg style="width:25px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        Attendance Logs
                    </div>
                    <div class="card-body">
                        <div>
                            <table style="width:100%;" id="attendance">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>In</th>
                                        <th>Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->attendances()->latest()->take(5)->get() as $item)
                                        <tr>
                                            <td>
                                                {{$item->created_at->format('m/d/Y')}}
                                            </td>
                                            <td>
                                                {{$item->in->format('h:i A')}}
                                            </td><td>
                                                {{$item->out ? $item->out->format('h:i A'): '-'}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-8">

                <div class="card mb-3">
                    <div class="card-header d-flex gap-2 align-items-center">
                        <svg style="width:25px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                        Ongoing Task
                    </div>
                    <div class="card-body">
                        @if (! count(auth()->user()->tasks()->where('assignments.status', 'ON-GOING')->latest()->get()))
                            <div class="text-center">
                                No assigned task.
                            </div>
                        @else
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    {{auth()->user()->ongoingAssignment->title}}
                                    <div>
                                        <span class="bg-warning text-white px-2 rounded">{{auth()->user()->ongoingAssignment->priority_level}}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Description</th>
                                            <td style="font-size: 14px;">
                                                {{auth()->user()->ongoingAssignment->description}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Period
                                            </th>
                                            <td>
                                                {{auth()->user()->ongoingAssignment->from->format('m/d/Y')}} - {{auth()->user()->ongoingAssignment->to->format('m/d/Y')}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Duration
                                            </th>
                                            <td>
                                                {{auth()->user()->ongoingAssignment->to->diff(auth()->user()->ongoingAssignment->from)->format('%d day(s)')}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex">
                                        @php
                                            $assignment = auth()->user()->assignments()->whereTaskId(auth()->user()->ongoingAssignment->id)->first();
                                        @endphp
                                        <task-completion-uploader action="{{$assignment->proof_of_initiation == null ? 'Capture proof of Initiation' : 'Capture proof of Done'}}" user-id="{{auth()->id()}}" task="{{auth()->user()->ongoingAssignment->id}}" api="https://tupad.lzrk.host"/>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="alert alert-warning mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                                  </svg>
                                Upload a photo of the completed cleaning task to mark it as accomplished
                            </div> --}}
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header align-items-center d-flex gap-2">
                        <svg style="width:25px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        Task Logs
                    </div>
                    <div class="card-body">
                        @forelse (auth()->user()->tasks()->where('assignments.status', 'DONE')->latest()->get() as $item)
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                {{$item->title}}
                                <div>
                                    <span class="bg-warning text-white px-2 rounded">{{$item->status == 'PENDING' ? 'FOR EVALUATION': 'DONE'}}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Description</th>
                                        <td style="font-size: 14px;">
                                            {{$item->description}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Period
                                        </th>
                                        <td>
                                            {{$item->from->format('m/d/Y')}} - {{$item->to->format('m/d/Y')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Duration
                                        </th>
                                        <td>
                                            {{$item->to->diff($item->from)->format('%d day(s)')}}
                                        </td>
                                    </tr>
                                </table>
                                <div class="row">
                                    @php
                                        $images = \App\Models\TaskResult::whereUserId(auth()->id())->whereTaskId($item->id)->latest()->take(2)->get();
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">Before</div>
                                            <div class="card-body">
                                                <img src="https://tupad.lzrk.host/storage/{{$images[1]->image}}" class="w-100" alt="">
                                                @php
                                                    $before = $images[1];
                                                    $objects = [];
                                                    foreach ($before->result['predictions'] as $o) {
                                                        if (array_key_exists($o['class'], $objects)) {
                                                            $objects[$o['class']] ++;
                                                        } else {
                                                            $objects[$o['class']] = 1;
                                                        }
                                                    }
                                                @endphp
                                                <table class=" mt-2 table-sm table-bordered table">
                                                    <thead>
                                                        <tr>
                                                            <th>Object</th>
                                                            <th>Count</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($objects as $key=>$value)
                                                            <td>{{$key}}</td>
                                                            <td>{{$value}}</td>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a href="/result/{{$before->id}}">View Image Analyzed</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">After</div>
                                            <div class="card-body">
                                                <img src="https://tupad.lzrk.host/storage/{{$images[0]->image}}" class="w-100" alt="">
                                                @php
                                                    $after = $images[0];
                                                    $objects = [];
                                                    foreach ($after->result['predictions'] as $o) {
                                                        if (array_key_exists($o['class'], $objects)) {
                                                            $objects[$o['class']] ++;
                                                        } else {
                                                            $objects[$o['class']] = 1;
                                                        }
                                                    }
                                                @endphp
                                                <table class=" mt-2 table-sm table-bordered table">
                                                    <thead>
                                                        <tr>
                                                            <th>Object</th>
                                                            <th>Count</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($objects as $key=>$value)
                                                            <td>{{$key}}</td>
                                                            <td>{{$value}}</td>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a  href="/result/{{$after->id}}">View Image Analyzed</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="alert alert-secondary">No Data Found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
