@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Usage Analytics</h1>
            <a href="/admin" class="btn btn-primary">Back to Management</a>
        </div>
        <div class="row g-4">
            <!-- Ingredient Usage from the last 7 Days -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Ingredient Usage from the last 7 Days
                        <select id="dailyIngredientSelect" class="form-select mt-2" style="width: 200px;">
                            <option value="none">None</option>
                        </select>
                        <input type="date" id="datePicker" class="form-control mt-2" style="width: 200px;">
                    </div>
                    <div class="card-body">
                        <canvas id="dl" class="w-100 h-auto"></canvas>
                    </div>
                </div>
            </div>
            <!-- Total Ingredient Usage - Current Month This Year vs. Last Year -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Total Ingredient Usage - Current Month This Year vs. Last Year
                        <select id="monthlyIngredientSelect" class="form-select mt-2" style="width: 200px;">
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="ml" class="w-100 h-auto"></canvas>
                    </div>
                </div>
            </div>
            <!-- Total Ingredient Usage - Last Year vs. Current Year -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Total Ingredient Usage - Last Year vs. Current Year
                        <select id="yearlyIngredientSelect" class="form-select mt-2" style="width: 200px;">
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="yl" class="w-100 h-auto"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        const today = new Date();
        const currentDay = today.getDate();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();

        // Utility function to group by ingredient name and collect all data
        function groupByIngredient(data) {
            const grouped = {};
            data.forEach(item => {
                const ingredientName = item.label;
                if (!grouped[ingredientName]) {
                    grouped[ingredientName] = {
                        label: ingredientName,
                        data: [],
                        backgroundColor: item.backgroundColor
                    };
                }
                grouped[ingredientName].data.push({
                    x: item.c_date,
                    y: item.data[0].y
                });
            });
            return grouped;
        }

        // Filter Daily Data (Current Day and Last 6 Days)
        const dailyUsageData = [
            @foreach ($dailyUsage as $item)
                {
                    label: '{{\App\Models\Ingredient::find($item->ingredient_id)->name}}',
                    data: [{ x: '{{$item->c_date}}', y: {{$item->total}} }],
                    backgroundColor: ["{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}"],
                    ingredient_id: '{{$item->ingredient_id}}',
                    c_date: '{{$item->c_date}}'
                },
            @endforeach
        ];

        // Adjust the logic to filter data correctly based on the current day and last 6 days
        function getFilteredDailyData(selectedDate = today) {
            const filteredData = dailyUsageData.filter((item) => {
                const itemDate = new Date(item.c_date);
                const itemDay = itemDate.getDate();
                const itemMonth = itemDate.getMonth();
                const itemYear = itemDate.getFullYear();
                const selectedDay = new Date(selectedDate);

                // Case 1: If it's the current year and current month
                if (itemYear === selectedDay.getFullYear() && itemMonth === selectedDay.getMonth()) {
                    return itemDay >= selectedDay.getDate() - 6 && itemDay <= selectedDay.getDate();
                }

                // Case 2: Handle the transition between months (e.g., 1st of the month)
                if (itemYear === selectedDay.getFullYear() && itemMonth === selectedDay.getMonth() - 1) {
                    const prevMonthLastDay = new Date(selectedDay.getFullYear(), selectedDay.getMonth(), 0).getDate(); // Last day of the previous month
                    return itemDay >= prevMonthLastDay - (6 - selectedDay.getDate()) && itemDay <= prevMonthLastDay;
                }

                return false;
            });
            return filteredData;
        }

        const groupedDailyData = groupByIngredient(getFilteredDailyData());
        const dailyDatasets = Object.values(groupedDailyData);

        // Populate the dropdown with unique ingredients for daily usage
        const dailyIngredientSelect = document.getElementById('dailyIngredientSelect');
        Object.keys(groupedDailyData).forEach(ingredient => {
            const option = document.createElement('option');
            option.value = ingredient;
            option.textContent = ingredient;
            dailyIngredientSelect.appendChild(option);
        });

        const dlCtx = document.getElementById('dl');
        const dailyChart = new Chart(dlCtx, {
            type: 'bar',
            data: {
                datasets: dailyDatasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // **NEW CODE**: Updated Filtering Monthly Data (Current Month and Same Month Last Year)
        const monthlyUsageData = [
            @foreach ($monthlyUsage as $item)
                {
                    label: '{{\App\Models\Ingredient::find($item->ingredient_id)->name}}',
                    data: [{ x: '{{$item->c_date}}', y: {{$item->total}} }],
                    backgroundColor: ["{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}"],
                    ingredient_id: '{{$item->ingredient_id}}',
                    c_date: '{{$item->c_date}}'
                },
            @endforeach
        ];

        const filteredMonthlyData = monthlyUsageData.filter((item) => {
            const itemDate = new Date(item.c_date);
            const itemMonth = itemDate.getMonth();  // 0-based month
            const itemYear = itemDate.getFullYear();

            // Case 1: Current year and the current month
            if (itemYear === currentYear && itemMonth === currentMonth) {
                return true;  // Include current month data this year
            }

            // Case 2: Last year and the current month (same month as this year, but last year)
            if (itemYear === currentYear - 1 && itemMonth === currentMonth) {
                return true;  // Include the same month data from last year
            }

            return false;  // Exclude other months and years
        });

        const groupedMonthlyData = groupByIngredient(filteredMonthlyData);
        const monthlyDatasets = Object.values(groupedMonthlyData);

        // **NEW CODE**: Populate the dropdown with unique ingredients for monthly usage
        const monthlyIngredientSelect = document.getElementById('monthlyIngredientSelect');
        Object.keys(groupedMonthlyData).forEach(ingredient => {
            const option = document.createElement('option');
            option.value = ingredient;
            option.textContent = ingredient;
            monthlyIngredientSelect.appendChild(option);
        });

        const mlCtx = document.getElementById('ml');
        const monthlyChart = new Chart(mlCtx, {
            type: 'bar',
            data: {
                datasets: monthlyDatasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Handle Dropdown Selection for Monthly Graph
        document.getElementById('monthlyIngredientSelect').addEventListener('change', function(event) {
            const selectedIngredient = event.target.value;

            // Apply filtering based on the selected ingredient
            monthlyChart.data.datasets.forEach((dataset) => {
                dataset.hidden = selectedIngredient !== 'none' && dataset.label !== selectedIngredient;
            });

            monthlyChart.update();
        });

        // Yearly Usage Data
        const yearlyUsageData = [
            @foreach ($yearlyUsage as $item)
                {
                    label: '{{ \App\Models\Ingredient::find($item->ingredient_id)->name }}',
                    data: [{ x: '{{$item->c_date}}', y: {{$item->total}} }],
                    backgroundColor: "{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}",
                    c_date: '{{$item->c_date}}'
                },
            @endforeach
        ];

        const groupedYearlyData = groupByIngredient(yearlyUsageData);
        const yearlyDatasets = Object.values(groupedYearlyData);

        const ylCtx = document.getElementById('yl');
        const yearlyChart = new Chart(ylCtx, {
            type: 'bar',
            data: {
                datasets: yearlyDatasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Handle Dropdown Selection for Daily Graph
        document.getElementById('dailyIngredientSelect').addEventListener('change', function(event) {
            const selectedIngredient = event.target.value;
            dailyChart.data.datasets.forEach((dataset) => {
                dataset.hidden = selectedIngredient !== 'none' && dataset.label !== selectedIngredient;
            });
            dailyChart.update();
        });

        // Handle Date Picker Selection for Daily Graph
        document.getElementById('datePicker').addEventListener('change', function(event) {
            const selectedDate = event.target.value;
            const filteredData = getFilteredDailyData(selectedDate);
            const groupedFilteredData = groupByIngredient(filteredData);
            const datasets = Object.values(groupedFilteredData);
            dailyChart.data.datasets = datasets;
            dailyChart.update();
        });

        // NEW: Handle Dropdown Selection for Monthly Graph
        document.getElementById('monthlyIngredientSelect').addEventListener('change', function(event) {
            const selectedIngredient = event.target.value;

        // NEW: Apply filtering based on the selected ingredient
            monthlyChart.data.datasets.forEach((dataset) => {
                dataset.hidden = selectedIngredient !== 'none' && dataset.label !== selectedIngredient;
            });

            monthlyChart.update();
        });

        const yearlyIngredientSelect = document.getElementById('yearlyIngredientSelect');
        Object.keys(groupedYearlyData).forEach(ingredient => {
            const option = document.createElement('option');
            option.value = ingredient;
            option.textContent = ingredient;
            yearlyIngredientSelect.appendChild(option);
        });

        yearlyIngredientSelect.addEventListener('change', function(event) {
            const selectedIngredient = event.target.value;
            yearlyChart.data.datasets.forEach(dataset => {
                dataset.hidden = selectedIngredient !== 'none' && dataset.label !== selectedIngredient;
            });
            yearlyChart.update();
        });

    </script>
@endsection
