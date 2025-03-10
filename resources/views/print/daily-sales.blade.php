<x-print-layout>
    <div class="grid grid-cols-1 gap-2">
        @foreach ($dates as $date)
            <x-daily-sales-item :branch="$branch" :date="$date"></x-daily-sales-item>
        @endforeach
    </div>
</x-print-layout>
