@props(['id' => \Str::random(16), 'data' => [], 'title' => ''])
<div id="calendar{{$id}}"></div>
<script type="text/javascript">
    google.charts.load("current", {packages:["calendar"]});
    google.charts.setOnLoadCallback(drawChartCalendar);

 function drawChartCalendar() {
     var dataTable{{$id}} = new google.visualization.DataTable();
     dataTable{{$id}}.addColumn({ type: 'date', id: 'Date' });
     dataTable{{$id}}.addColumn({ type: 'number', id: 'count' });
     dataTable{{$id}}.addRows([
        @foreach($data as $key=>$val)
            [ new Date('{{$key}}'), {{$val}} ],
        @endforeach
      ]);

     var chart{{$id}} = new google.visualization.Calendar(document.getElementById('calendar{{$id}}'));

     var options{{$id}} = {
       title: "{{$title}}",
       calendar: { cellSize: 13 },
       noDataPattern: {
           backgroundColor: '#ccc',
           color: '#ccc'
         }
     };

     chart{{$id}}.draw(dataTable{{$id}}, options{{$id}});
 }
  </script>
