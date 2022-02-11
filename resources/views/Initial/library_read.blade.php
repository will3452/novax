<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($chapters as $chapter)
        <h3>
            Chapter Title: {{$chapter->title}}
        </h3>
        <div>
            {!!$chapter->content!!}
        </div>
    @endforeach
    {{$chapters}}
</body>
</html>
