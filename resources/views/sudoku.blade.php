<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/game.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0;">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="stylesheet" type="text/css" href="/Sudoku/css/game.css">
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="css/ie.css">
    <![endif]-->
    <script>
        alert('Sudoku is played on a grid of 9 x 9 spaces. Within the rows and columns are 9 “squares” (made up of 3 x 3 spaces). Each row, column and square (9 spaces each) needs to be filled out with the numbers 1-9, without repeating any numbers within the row, column or square.');
    </script>
</head>
<body>

    <section id="page">
        <div style="text-align: center;font-size:32px;font-weight:900;color:white;" id="timer">0</div>
        <div id="sTable"></div>
    </section>
    <section>
        <div class="select">
            <div>1</div>
            <div>2</div>
            <div>3</div>
            <div>4</div>
            <div>5</div>
            <div>6</div>
            <div>7</div>
            <div>8</div>
            <div>9</div>
        </div>
    </section>
    <div style="margin-top:10px;display:flex;justify-content:center;">
        <div style="visibility:hidden" id="user">{{auth()->id()}}</div>
        <div style="visibility:hidden" id="type">{{\App\Models\GameRecord::TYPE_SUDOKU}}</div>
        <div>
            <a href="/games/sudoku" style="text-decoration:none;color:#fff;margin-right:10px; padding:10px; font-weight:900;font-family:sans-serif; font-size:12px; background:red; border:none;">
                RESTART
            </a>
            <button style="padding:10px; font-weight:900;font-family:sans-serif;margin-right:10px;  font-size:12px; background:#222; border:none;color:#fff;" id="end">
                END GAME
            </button>
        </div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="/Sudoku/js/game.js"></script>
</body>
</html>
