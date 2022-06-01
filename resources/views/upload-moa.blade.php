<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <title>{{config('app.name', 'Nuwang')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.16.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script defer src="{{ mix('js/app.js') }}"></script>
</head>
<body>
    <div id="app">
        <div class="flex justify-center uppercase mt-4 ">
            <form action="/upload-moa" method="POST" class="border p-3 bg-white" enctype="multipart/form-data">
                @csrf
                <h1 class="text-center font-bold mb-4">Upload Moa</h1>
                <input type="file" name="file" required>
                @error('file')
                <div class="text-sm">
                    {{$message}}
                </div>
                @enderror
                <div class="mt-2">
                    <a class="btn btn-link" href="{{url()->previous()}}">Cancel</a> <button class="btn btn-sm">Upload</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
