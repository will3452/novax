<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Career Trajectory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="mx-auto max-w-[1000px] p-4 mt-4">
        <h1 class="text-4xl font-bold text-center text-gray-800">CAREER TRAJECTORY</h1>
        <canvas class="mt-4" id="myChart"></canvas>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        let d = @json($records);
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Career Trajectory'],
            datasets: d.map( e => ({
              label: e.career,
              data: [e.count],
              borderWidth: 1
            }))
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            },
            plugins: {
                legend: {
                    position: 'left'
                }
            }
          }
        });
      </script>
</body>
</html>