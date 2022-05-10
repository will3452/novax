<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$exam->name}}</title>
    <style>
        * {
            font-family: monospace;
        }
        .q {
            margin-top:20px;display:flex;align-items:flex-start;font-weight: 900;
        }
        .a-item{
            margin: 10px 0px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            Name:
        </div>
        <div>
            Strand/Section:
        </div>
        <div>
            Date:
        </div>
        <div>
            Instructor/Teacher:
        </div>
        <div>
            Score:
        </div>
    </div>

    @foreach ($exam->questions as $key=>$q)
    <div class="q">
        {{$key+1}} . {!!$q->question ?? "<img style='height:100px;' src='$q->storage_question'/>"!!}
        @if ($q->type == \App\Models\Question::TYPE_TRUE_OR_FALSE)
        ( True of False )
        @endif
    </div>
    <div style="padding-left: 10px;">
        @php
            $letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k'];
        @endphp
        @if (in_array($q->type, [\App\Models\Question::TYPE_MULTIPLE_ANSWER, \App\Models\Question::TYPE_MULTIPLE_CHOICE]))

            @foreach ($q->getAllChoice($q->choices) as $li => $c)
                <div class="a-item">
                    [{{$letters[$li]}}] {{$c}}
                </div>
            @endforeach
        @endif
    </div>
    @endforeach

    <script>
        window.print();
    </script>
</body>
</html>
