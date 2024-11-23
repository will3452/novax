@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Order Analytics</h1>
            <a href="/admin" class="btn btn-primary">Back to Management</a>
        </div>
        <div class="row g-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Product Orders from the last 7 Days
                        <select id="dailyProductSelect" class="form-select mt-2" style="width: 200px;">
                            <option value="none">None</option>
                        </select>
                        <input type="date" id="datePicker" class="form-control mt-2" style="width: 200px;">
                    </div>
                    <div class="card-body">
                        <canvas id="dl"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Total Product Orders - Current Month This Year vs. Last Year
                        <select id="monthlyProductSelect" class="form-select mt-2" style="width: 200px;">
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="ml"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Total Product Orders - Last Year vs. Current Year
                        <select id="yearlyProductSelect" class="form-select mt-2" style="width: 200px;">
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="yl"></canvas>
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

        // Utility function to group by product name and collect all data
        function groupByProduct(data) {
            const grouped = {};
            data.forEach(item => {
                const productName = item.label;
                if (!grouped[productName]) {
                    grouped[productName] = {
                        label: productName,
                        data: [],
                        backgroundColor: item.backgroundColor
                    };
                }
                grouped[productName].data.push({
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
                    label: '{{ \App\Models\Product::find($item->product_id)->name }}',
                    data: [{ x: '{{$item->c_date}}', y: {{$item->total}} }],
                    backgroundColor: ["{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}"],
                    product_id: '{{$item->product_id}}',
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

                if (itemYear === selectedDay.getFullYear() && itemMonth === selectedDay.getMonth()) {
                    return itemDay >= selectedDay.getDate() - 6 && itemDay <= selectedDay.getDate();
                }

                if (itemYear === selectedDay.getFullYear() && itemMonth === selectedDay.getMonth() - 1) {
                    const prevMonthLastDay = new Date(selectedDay.getFullYear(), selectedDay.getMonth(), 0).getDate();
                    return itemDay >= prevMonthLastDay - (6 - selectedDay.getDate()) && itemDay <= prevMonthLastDay;
                }

                return false;
            });
            return filteredData;
        }

        const groupedDailyData = groupByProduct(getFilteredDailyData());
        const dailyDatasets = Object.values(groupedDailyData);

        const dailyProductSelect = document.getElementById('dailyProductSelect');
        Object.keys(groupedDailyData).forEach(product => {
            const option = document.createElement('option');
            option.value = product;
            option.textContent = product;
            dailyProductSelect.appendChild(option);
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

        const monthlyUsageData = [
            @foreach ($monthlyUsage as $item)
                {
                    label: '{{ \App\Models\Product::find($item->product_id)->name }}',
                    data: [{ x: '{{$item->c_date}}', y: {{$item->total}} }],
                    backgroundColor: ["{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}"],
                    product_id: '{{$item->product_id}}',
                    c_date: '{{$item->c_date}}'
                },
            @endforeach
        ];

        const filteredMonthlyData = monthlyUsageData.filter((item) => {
            const itemDate = new Date(item.c_date);
            const itemMonth = itemDate.getMonth();
            const itemYear = itemDate.getFullYear();

            if (itemYear === currentYear && itemMonth === currentMonth) {
                return true;
            }

            if (itemYear === currentYear - 1 && itemMonth === currentMonth) {
                return true;
            }

            return false;
        });

        const groupedMonthlyData = groupByProduct(filteredMonthlyData);
        const monthlyDatasets = Object.values(groupedMonthlyData);

        const monthlyProductSelect = document.getElementById('monthlyProductSelect');
        Object.keys(groupedMonthlyData).forEach(product => {
            const option = document.createElement('option');
            option.value = product;
            option.textContent = product;
            monthlyProductSelect.appendChild(option);
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

        document.getElementById('monthlyProductSelect').addEventListener('change', function(event) {
            const selectedProduct = event.target.value;
            monthlyChart.data.datasets.forEach((dataset) => {
                dataset.hidden = selectedProduct !== 'none' && dataset.label !== selectedProduct;
            });
            monthlyChart.update();
        });

        const yearlyUsageData = [
            @foreach ($yearlyUsage as $item)
                {
                    label: '{{ \App\Models\Product::find($item->product_id)->name }}',
                    data: [{ x: '{{$item->c_date}}', y: {{$item->total}} }],
                    backgroundColor: "{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}",
                    c_date: '{{$item->c_date}}'
                },
            @endforeach
        ];

        const groupedYearlyData = groupByProduct(yearlyUsageData);
        const yearlyDatasets = Object.values(groupedYearlyData);

        const yearlyProductSelect = document.getElementById('yearlyProductSelect');
        Object.keys(groupedYearlyData).forEach(product => {
            const option = document.createElement('option');
            option.value = product;
            option.textContent = product;
            yearlyProductSelect.appendChild(option);
        });

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

        yearlyProductSelect.addEventListener('change', function(event) {
            const selectedProduct = event.target.value;
            yearlyChart.data.datasets.forEach(dataset => {
                dataset.hidden = selectedProduct !== 'none' && dataset.label !== selectedProduct;
            });
            yearlyChart.update();
        });

    </script>
@endsection
