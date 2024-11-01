@props(['selectedYear', 'month'])
@for ($selectedMonth = 1; $selectedMonth <= $month; $selectedMonth++)
<x-progress-header :selected-month="$selectedMonth"></x-progress-header>
<div class="space-y-4 mt-4">
    <x-heading>Summary</x-heading>
</div>
@php
    $sundays = [];
    $startOfMonth = \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, 1);

    // Find the first Sunday of the month
    if (!$startOfMonth->isSunday()) {
        $startOfMonth->next(\Carbon\Carbon::SUNDAY);
    }

    // Loop through each Sunday until the end of the month
    while ($startOfMonth->month == $selectedMonth) {
        $sundays[] = $startOfMonth->format('Y-m-d');
        $startOfMonth->addWeek(); // Move to the next Sunday
    }
    $totAt = 0;
    $totF = 0;
    $totS = 0;
    $totT = 0;
    $totFf = 0;
    $totR = 0;
@endphp
<table class="w-full">
    <thead>
        <tr>
            <th class="border">Week</th>
            <th class="border">Attendees</th>
            <th class="border">First Timers</th>
            <th class="border">2nd  Timers</th>
            <th class="border">3rd Timers</th>
            <th class="border">4th Timers</th>
            <th class="border">Regular</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sundays as $week)
            <tr>
                @php
                    $date = \Carbon\Carbon::parse($week);
                    $att = \App\Models\Attendance::whereDate('date', $date)->get();
                    $totAt += count($att);
                    $ft = [];
                    foreach ($att as $a) {
                        if ($a->member->attendanceAsOf($date) == 1) {
                            array_push($ft, $a->member->name);
                        }
                    }
                    $st = [];
                    foreach ($att as $a) {
                        if ($a->member->attendanceAsOf($date) == 2) {
                            array_push($st, $a->member->name);
                        }
                    }

                    $tt = [];
                    foreach ($att as $a) {
                        if ($a->member->attendanceAsOf($date) == 3) {
                            array_push($tt, $a->member->name);
                        }
                    }

                    $fft = [];
                    foreach ($att as $a) {
                        if ($a->member->attendanceAsOf($date) == 4) {
                            array_push($fft, $a->member->name);
                        }
                    }

                    $regular = count($att) - (count($ft) + count($st) + count($tt) + count($fft));
                    $totF += count($ft);
                    $totS += count($st);
                    $totT += count($tt);
                    $totFf += count($fft);
                    $totR += $regular;
                @endphp
                <td class="border text-center">
                    {{$date->weekOfMonth}}
                </td>
                <td  class="border text-center">
                    {{count($att)}}
                </td>
                <td class="border text-center">
                    {{count($ft)}}
                </td>
                <td class="border text-center">
                    {{count($st)}}
                </td>
                <td class="border text-center">
                    {{count($tt)}}
                </td>
                <td class="border text-center">
                    {{count($fft)}}
                </td>
                <td  class="border text-center">
                    {{$regular}}
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="border text-center font-bold">Average</td>
            <td class="border text-center">{{$totAt  / count($sundays)}}</td>
            <td class="border text-center">{{$totF  / count($sundays)}}</td>
            <td class="border text-center">{{$totS  / count($sundays)}}</td>
            <td class="border text-center">{{$totT  / count($sundays)}}</td>
            <td class="border text-center">{{$totFf  / count($sundays)}}</td>
            <td class="border text-center">{{$totR  / count($sundays)}}</td>
        </tr>
        {{-- <tr>
            <td class="border text-center font-bold">Total</td>
            <td class="border text-center">{{$totAt}}</td>
            <td class="border text-center">{{$totF}}</td>
            <td class="border text-center">{{$totS}}</td>
            <td class="border text-center">{{$totT}}</td>
            <td class="border text-center">{{$totFf}}</td>
            <td class="border text-center">{{$totR}}</td>
        </tr> --}}
    </tbody>
</table>
@foreach ($sundays as $sunday)
    @php
        $date = \Carbon\Carbon::parse($sunday);
        $att = \App\Models\Attendance::whereDate('date', $date)->get();
    @endphp
    <x-page-break />
    <x-progress-header :selected-month="$selectedMonth"></x-progress-header>
    <x-heading>Detailed Attendance Week {{$date->weekOfMonth}}</x-heading>
    <table class="border w-full">
        <thead>
            <tr>
                <th class="border text-center">No</th>
                <th class="border text-center">Name</th>
                <th  class="border text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($att as $a)
            <tr>
                <td class="border text-center text-xs">{{$loop->index + 1}}</td>
                <td class="border text-center text-xs">{{$a->member->name}}</td>
                @php
                    $noA = $a->member->attendanceAsOf($date);
                @endphp
                <td class="border text-center text-xs">{{$noA >= 4 || $a->member->progress_status == 'Regular' ? 'Regular' : ($noA == 4 ? '4th' : ($noA == 3 ? '3rd' : ($noA == 2 ? '2nd' : ($noA == 1 ? '1st' : '')))) }}</td>
            </tr>
            @empty
            <tr>
                <td>
                    No Data.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endforeach
<x-page-break></x-page-break>
@endfor
