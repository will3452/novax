@props(['id' => \Str::random(16), 'data' => [], 'title' => ''])
<script>
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
            var data = google.visualization.arrayToDataTable([
                @foreach($data as $key=>$val)
                    ['{{$key}}', {{is_numeric($val) ? $val : "`$val`"}}],
                @endforeach
            ]);
            var options = {
            title: '{{$title}}',
            is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('{{$id}}'));
            chart.draw(data, options);
        }
</script>
<div id="{{$id}}"></div>
