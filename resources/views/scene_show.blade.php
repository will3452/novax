<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="/js/app.js"></script>
    <link rel="stylesheet" href="/css/app.css"/>
</head>
<body>
    <div class="text-center">
        <a href="/story-mode/{{$scene->story_id}}" class="btn btn-primary m-2">
            READ STORY
        </a>
    </div>
    <div id="app">
        <example-component :scene="{{$scene}}" ></example-component>
    </div>
</body>
</html>
