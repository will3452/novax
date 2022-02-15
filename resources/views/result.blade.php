<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .block {
            display: inline-block;
            margin:0px;
            width:2px;
            height:2px;
            /* border:1px solid #222; */
        }
        .flex {
            display: flex;
        }
    </style>
</head>
<body>
    colors
    <br>
    @for ($i = 0; $i < $width; $i++)
        <div class="flex">
            @for ($y = 0; $y < $height; $y++)
                <span class="block" style="background: rgb({{$colors[$i][$y]['r']}}, {{$colors[$i][$y]['g']}}, {{$colors[$i][$y]['b']}})"></span>
            @endfor
        </div>
    @endfor
</body>
</html>
