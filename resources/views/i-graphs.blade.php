<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <title>Ingredients</title>
</head>

<body>
    <canvas id="lt" width="400" height="100">
        <p>Hello Fallback World</p>
    </canvas>

    <script>
        window.onload = function() {
            const config = {
                type: 'line',
                data: {
                    datasets: [{
                        data: [0, 0],
                    }, {
                        data: [0, 1]
                    }, {
                        data: [1, 0],
                        showLine: true // overrides the `line` dataset default
                    }, {
                        type: 'scatter', // 'line' dataset default does not affect this dataset since it's a 'scatter'
                        data: [1, 1]
                    }]
                },
                options: {},
            }

            const ltCtx = document.getElementById('lt');

            new Chart(ltCtx, {
                type: 'bar',
                data: {
                    labels: ['Item 1', 'Item 2', 'Item 3'], // List of items
                    datasets: [{
                        data: [30, 45, 25], // Values for each item
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            })
        }
    </script>
</body>
