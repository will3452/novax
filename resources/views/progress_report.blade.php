<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-progress-content :selectedYear="$selectedYear" :month="$selectedMonth"></x-progress-content>
    <script>
        window.onload = function () {
            window.print()
        }
    </script>
</body>
