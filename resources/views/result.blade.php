<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Canvas Object Detection</title>
  <style>
  </style>
</head>
<body>
 <div>
    <a href="{{url()->previous()}}">back</a>
 </div>
  <canvas id="detectionCanvas" width="{{$tr->result['image']['width']}}" height="{{$tr->result['image']['height']}}"></canvas>
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

</body>
</html>
