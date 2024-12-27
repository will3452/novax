@extends('layouts.app')

@section('content-2')
    <div class="container">
        <div class="my-4">
            <a href="{{url()->previous()}}" class="btn btn-danger">back to dashboard</a>
         </div>
         <div class="card">
            <div class="card-header">
                Image Result
            </div>
            <div class="card-body">
                <canvas id="detectionCanvas" width="{{$tr->result['image']['width']}}" height="{{$tr->result['image']['height']}}"></canvas>
            </div>
         </div>
          <script>
            // Get canvas and its 2D context
            const canvas = document.getElementById('detectionCanvas');
            const ctx = canvas.getContext('2d');

            // Image width and height
            const imageWidth = {{$tr->result['image']['width']}};
            const imageHeight = {{$tr->result['image']['height']}};

            // Sample image to draw (replace with actual image)
            const img = new Image();
            img.src = 'https://tupad.lzrk.host/storage/{{$tr->image}}'; // Replace with the actual image URL

            // Detection predictions
            const predictions = @json($tr->result['predictions'])

            // Draw the image and detections
            img.onload = function() {
              // Draw the image
              ctx.drawImage(img, 0, 0, imageWidth, imageHeight);

              // Set styles for the rectangles and text
              ctx.strokeStyle = 'red'; // Color for rectangle borders
              ctx.lineWidth = 2;
              ctx.font = '16px Arial';
              ctx.fillStyle = 'red'; // Color for labels

              // Loop through predictions and draw rectangles with labels
              predictions.forEach(prediction => {
                // Draw the rectangle for the detection
                ctx.strokeRect(prediction.x, prediction.y, prediction.width, prediction.height);

                // Draw the class label and confidence score
                const label = `${prediction.class} (${(prediction.confidence * 100).toFixed(2)}%)`;
                ctx.fillText(label, prediction.x, prediction.y - 5); // Position label above the box
              });
            };
          </script>

    </div>
 @endsection
