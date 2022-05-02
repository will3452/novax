<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Report</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="p-4">
    <div class="row">
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">
                    Group Counselling
                </div>
                <div class="card-body">
                    <h2>{{\App\Models\GroupCounselling::count()}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">
                    Individual Counselling
                </div>
                <div class="card-body">
                    <h2>{{\App\Models\IndividualCounselling::count()}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">
                    Total Number of Students
                </div>
                <div class="card-body">
                    <h2>{{\App\Models\Student::count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div>
        <canvas id="myChart"></canvas>
      </div>
      <script>
        const labels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
        ];

        const data = {
          labels: labels,
          datasets: [
              @foreach($series as $s)
                {
                    label: "{{$s['label']}}",
                    backgroundColor: "{{$s['borderColor']}}",
                    borderColor: "{{$s['borderColor']}}",
                    data: [{{implode(',', $s['data'])}}],
                },
              @endforeach
          ]
        };

        const config = {
          type: 'line',
          data: data,
          options: {}
        };
      </script>
    <script>
        const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
      </script>
      <script>
          window.onload = function () {
              window.print();
          }
      </script>
</body>
</html>
