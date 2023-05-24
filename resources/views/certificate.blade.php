<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .certificate {
            width: 900px;
            height: 600px;
            border: 4px double #222;
            position: relative;
        }
        .center {
            text-align: center !important;
        }
        .title {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 50px;
            margin-top: 2em;
            text-transform: uppercase;
        }

        .sub {
            font-size: 24px;
        }

        .desc {
            font-style: italic;
        }

        .ref {
            font-family: monospace;
            position: absolute;
            left: 10px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h2 class="ref"># {{ \Str::padLeft($award->id, 6, 0) }}</h2>
        <h1 class="center title">{{$award->title}}</h1>
        <p class="center sub">Presented To:  {{$award->user->name}}</p>
        <p class="center desc">{{$award->description}}</p>
    </div>
</body>
</html>
