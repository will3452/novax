
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Success Page</title>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class=" text-center">
    @if ($valid)
        <h1 class="text-green-500 font-bold text-3xl">VERIFICATION RESULT</h1>
        <p class="text-gray-600 text-base">This document with a reference <span class="font-bold">#{{$copy->reference}}</span> is correct, and everything that is stated here is true.</p>
        <div>
            <a href="{{route('issue', ['profile' => $copy->profile_id, 'document' => $copy->document])}}" class="p-2 bg-green-400 text-white block mt-4">
                DOWNLOAD A COPY
            </a>
        </div>
    @else
        <h1 class="text-red-500 font-bold text-3xl">VERIFICATION RESULT</h1>
        <p class="text-gray-600 text-base">This document is not valid, and everything that is stated here is wrong.</p>
        <div>
            <a href="mailto:{{nova_get_setting('barangay_email')}}" class="p-2 bg-red-400 text-white block mt-4">
               REPORT NOW
            </a>
        </div>
    @endif
  </div>
</body>
</html>
