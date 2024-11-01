<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-front-page :selectedYear="$selectedYear">
        Financial Report {{$selectedYear}}
    </x-front-page>
    <x-page-break />
    <x-finance-content :selectedYear="$selectedYear" :selectedMonth="$selectedMonth"/>
    <x-front-page :selectedYear="$selectedYear">
        Progress Report {{$selectedYear}}
    </x-front-page>
    <x-page-break />
    <x-progress-content :selectedYear="$selectedYear" :month="$selectedMonth"></x-progress-content>
    <script>
        window.onload = function () {
            window.print()
        }
    </script>
</body>
