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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ __('FAQ') }}
                    </div>
                </div>

                <div class="card-body accordion">
                    @forelse (\App\Models\BotResponse::latest()->get() as $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="head-{{$item->id}}">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{$item->id}}" aria-expanded="{{$loop->first ? 'true': 'false'}}" aria-controls="collapseOne-{{$item->id}}">
                            {{$item->question}}
                          </button>
                        </h2>
                        <div id="collapseOne-{{$item->id}}" class="accordion-collapse collapse {{$loop->first ? 'show': ''}}" aria-labelledby="head-{{$item->id}}" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            {{$item->answer}}
                          </div>
                        </div>
                      </div>
                    @empty
                        <div class="alert alert-secondary">No FAQ</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
