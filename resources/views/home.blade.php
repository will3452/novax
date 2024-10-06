@extends('layouts.app')

@section('content')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
@auth

<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            @foreach(auth()->user()->appointments as $a)
                {
                    title: "{{$a->service}}",
                    start: '{{$a->date->format('Y-m-d')}}',
                    end: '{{$a->date->format('Y-m-d')}}',
                },
            @endforeach
        ],
      });
      calendar.render();
    });

  </script>
@endauth
<div class="px-4">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card mb-5">
                <div class="card-header">
                    Calendar
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ __('Appointment') }}
                    </div>
                    <div>
                        <a href="/#services">Browse Services</a>
                    </div>
                </div>

                <div class="card-body">
                    @forelse (auth()->user()->appointments()->latest()->get() as $item)
                        <div class="card card-body mb-2">
                            <div>
                                <div>
                                    <b>Service : </b> {{ $item->service}}
                                </div>
                                <div>
                                    <b>Date & time : </b> {{ $item->date->format('m/d/Y')}} {{$item->time_start}} - {{$item->time_end}}
                                </div>
                                <div>
                                    <b>Remarks : </b> {{ $item->remarks}}
                                </div>
                                <div>
                                    <b>Status : </b> {{ $item->status}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-secondary">No Appointment</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
