<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-finance-details-content :selectedYear="$selectedYear" :selectedMonth="$selectedMonth"/>
    <script>
        window.onload = function () {
            window.print()
        }
    </script>
</body>
