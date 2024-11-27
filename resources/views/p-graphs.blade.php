@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Include the datalabels plugin -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Order Analytics</h1>
            <a href="/admin" class="btn btn-primary">Back to Management</a>
        </div>
        <div class="row g-4">
            <!-- Total Product Sacks -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Total Product Sacks
                        <select id="yearlyProductSelect" class="form-select mt-2" style="width: 200px;">
                            <option value="none">None</option>
                            <!-- Options will be added dynamically -->
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="yl" class="w-100 h-auto"></canvas>
                    </div>
                </div>
            </div>

            <!-- New Row for Dynamic Lists -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Top 10 Ordered Products
                    </div>
                    <div class="card-body">
                        <ul id="topOrderedList" class="list-group">
                            <!-- Top 10 Ordered Products will be added dynamically -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Top 10 Least Ordered Products
                    </div>
                    <div class="card-body">
                        <ul id="leastOrderedList" class="list-group">
                            <!-- Top 10 Least Ordered Products will be added dynamically -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const today = new Date();
        const currentYear = today.getFullYear();

        // Prepare the raw data, fetched from the server-side
        const yearlyUsageData = [
            @foreach ($yearlyUsage as $item)
                {
                    label: '{{ \App\Models\Product::find($item->product_id)->name }}',
                    total: {{$item->total}},
                    backgroundColor: "{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}",  // Random color
                    product_id: {{$item->product_id}},  // Keep the product ID for filtering
                },
            @endforeach
        ];

        // Sort the products by total sacks in descending order
        yearlyUsageData.sort((a, b) => b.total - a.total);  // Sort by total sacks in descending order

        // Extract the labels (product names), data (sack totals), and background colors
        const productLabels = yearlyUsageData.map(item => item.label);
        const productTotals = yearlyUsageData.map(item => item.total);
        const backgroundColors = yearlyUsageData.map(item => item.backgroundColor);
        const productIds = yearlyUsageData.map(item => item.product_id);

        const ylCtx = document.getElementById('yl');
        const yearlyChart = new Chart(ylCtx, {
            type: 'bar',  // Horizontal bar chart
            data: {
                labels: productLabels,  // Product names as labels
                datasets: [{
                    label: 'Total Sacks',  // Updated label for sacks
                    data: productTotals,  // Total sacks for each product
                    backgroundColor: backgroundColors,  // Random colors for each product
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',  // Make the chart horizontal
                plugins: {
                    legend: {
                        position: 'top',  // Display the legend at the top
                    },
                    // Enable the datalabels plugin
                    datalabels: {
                        color: '#fff',  // Text color (white)
                        align: 'center',  // Center the label inside the bar
                        font: {
                            weight: 'bold',  // Bold text for visibility
                        },
                        formatter: (value) => value  // Show the total value inside the bar
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            },
            plugins: [ChartDataLabels] // Register the datalabels plugin
        });

        // Populate the product selection dropdown dynamically with product names
        const yearlyProductSelect = document.getElementById('yearlyProductSelect');
        yearlyUsageData.forEach(item => {
            const option = document.createElement('option');
            option.value = item.product_id;  // Use product ID as the value for filtering
            option.textContent = item.label;  // Display product name
            yearlyProductSelect.appendChild(option);
        });

        // Filter the chart based on product selection
        document.getElementById('yearlyProductSelect').addEventListener('change', function(event) {
            const selectedProductId = event.target.value;

            if (selectedProductId === 'none') {
                // Show all products if "None" is selected
                yearlyChart.data.datasets[0].data = productTotals;
                yearlyChart.data.datasets[0].backgroundColor = backgroundColors;
                yearlyChart.data.labels = productLabels;
            } else {
                // Filter and show only the selected product
                const filteredData = yearlyUsageData.filter(item => item.product_id == selectedProductId);
                const filteredLabels = filteredData.map(item => item.label);
                const filteredTotals = filteredData.map(item => item.total);
                const filteredBackgroundColors = filteredData.map(item => item.backgroundColor);

                // Update chart data for the selected product only
                yearlyChart.data.labels = filteredLabels;
                yearlyChart.data.datasets[0].data = filteredTotals;
                yearlyChart.data.datasets[0].backgroundColor = filteredBackgroundColors;
            }

            // Update the chart after filtering
            yearlyChart.update();
        });

        // Populate the Top 10 Ordered Products list
        const topOrderedList = document.getElementById('topOrderedList');
        const topOrderedData = yearlyUsageData.slice(0, 10);  // Take the top 10 products by total sacks
        topOrderedData.forEach(item => {
            const listItem = document.createElement('li');
            listItem.classList.add('list-group-item');
            listItem.textContent = `${item.label}: ${item.total} sacks`;  // Changed to sacks
            topOrderedList.appendChild(listItem);
        });

        // Populate the Top 10 Least Ordered Products list
        const leastOrderedList = document.getElementById('leastOrderedList');
        const leastOrderedData = yearlyUsageData.slice(-10).reverse();  // Take the bottom 10 products by total sacks
        leastOrderedData.forEach(item => {
            const listItem = document.createElement('li');
            listItem.classList.add('list-group-item');
            listItem.textContent = `${item.label}: ${item.total} sacks`;  // Changed to sacks
            leastOrderedList.appendChild(listItem);
        });

        // Add hover effects for the list items
        document.querySelectorAll('.list-group-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                item.style.cursor = 'pointer';
                item.style.transform = 'scale(1.05)';
                item.style.transition = 'transform 0.2s ease-in-out';
            });
            item.addEventListener('mouseleave', function() {
                item.style.transform = 'scale(1)';
            });
        });
    </script>
@endsection
