var _levels = [
    [  [[7],[2],[],[9],[4],[5],[],[3],[]],
        [[],[3],[9],[2],[],[6],[],[],[4]],
        [[1],[5],[],[7],[3],[8],[6],[9],[2]],
        [[6],[4],[7],[1],[],[3],[],[2],[]],
        [[9],[8],[2],[6],[5],[7],[4],[1],[3]],
        [[3],[],[5],[4],[9],[2],[7],[],[6]],
        [[4],[9],[3],[],[6],[1],[],[5],[7]],
        [[5],[7],[],[3],[2],[],[8],[6],[9]],
        [[],[],[8],[5],[7],[9],[3],[4],[]]
    ],
    [
        [[1], [2], [7], [], [], [], [3], [], []],
        [[4], [], [3], [], [1], [2], [], [8], [5]],
        [[], [5], [9], [], [3], [], [1], [], [6]],
        [[3], [], [1], [5], [4], [7], [], [], []],
        [[], [9], [2], [], [], [1], [5], [7], [8]],
        [[7], [4], [5], [], [8], [], [9], [3], [1]],
        [[2], [1], [], [3], [], [5], [8], [], [9]],
        [[9], [3], [4], [], [], [], [], [5], []],
        [[5], [], [], [], [9], [], [4], [], [3]],
    ],
    [
        [[1], [2], [], [], [7], [], [3], [], [8]],
        [[3], [],  [6],[], [1], [2],[9], [5],[7]],
        [[5], [],  [4],[], [6], [], [2], [1],[3]],
        [[2], [],  [1],[], [],  [3],[],  [], [5]],
        [[4], [3], [5],[1],[2], [], [8], [9], []],
        [[],  [6], [], [], [],  [5],[1], [],  []],
        [[6], [1], [2],[], [4], [], [5], [], [9]],
        [[],  [4], [3],[6],[],  [7],[],  [8],[1]],
        [[],  [5], [], [], [3], [], [],  [6],[2]],
    ],
    [
        [[1], [9], [3], [], [], [8], [2], [], []],
        [[2], [7], [],  [], [1],[6], [],  [5],[4]],
        [[4], [5], [],  [], [2],[9], [1], [], []],
        [[],  [1], [],  [4],[] ,[],  [7], [], [8]],
        [[],  [2], [6], [], [3],[1], [],  [4],[]],
        [[9], [],  [],  [5],[], [2], [],  [], [1]],
        [[],  [],  [1], [2],[], [],  [4], [], [9]],
        [[5], [8], [],  [1],[9],[],  [3], [], [6]],
        [[6], [],  [2], [], [4],[],  [],  [1], []],
    ],
    [
        [[1], [5], [], [], [], [], [], [], [3]],
        [[],  [],  [], [], [5],[3],[], [8], [7]],
        [[7], [2], [3],[], [4],[], [], [5], []],
        [[],  [6], [], [2],[], [], [], [1], []],
        [[3], [1], [4],[], [9],[7],[8],[],  [6]],
        [[],  [],  [5],[], [6],[], [], [4], []],
        [[2], [8], [], [], [3],[6],[7],[9], []],
        [[],  [3], [], [7],[], [], [], [],  [8]],
        [[6], [],  [7],[], [], [], [], [],  []],
    ]

];
var Sudoku = {

    //-------------------------------GAME DATA---------------------------------
    //the Sudoku game data, game can be different if the data changes
    matrix: _levels[Math.floor(Math.random() * (_levels.length - 0) + 0)],


    //-----------------------------START FUNCTION-------------------------------
    //render game board and input Sudoku numbers
    start: function(){

        //render game board
        for (var i = 0; i < 9; i++) {
            var row = $('<tr></tr>');
            for(var j = 0; j < 9; j++){
                var sBlock = $('<td class="sBox edit"></td>');
                sBlock.attr('id','Block'+'_'+ i + '_' + j).text(Sudoku.matrix[i][j]);   //store the block location in the id
                row.append(sBlock);
                if(Sudoku.matrix[i][j] != ''){  //the number in block with edit class can be changed
                    sBlock.removeClass('edit');
                }
                var groups = Math.floor(Math.sqrt(9));  //use different color to distinguish different groups
                var gA = Math.floor(i / groups);
                var gB = Math.floor(j / groups);
                if (gA % 2 == gB % 2) {
                    sBlock.addClass('sGroup');
                }else{
                    sBlock.addClass('sGroup2');
                }
            $('#sTable').append(row);
            }
        }
    },

    //------------------------------------PLAY FUNCTION-------------------------
    //handle click event in the game playing
    play : function(){
        $('.sBox').click(function(event){   //if the block in the table been clicked
            event.stopPropagation();
            if($(this).hasClass('edit') == true){   //if it's a editable block
                $('.selectActive').removeClass('selectActive');
                $(this).addClass('selectActive');
                if (!navigator.userAgent.match(/mobile/i)) {    //if it's not a mobile device, show select panel around where the event happens
                    $('.select').css('top',event.pageY).css('left',event.pageX).addClass('active');
                }else{                                          //if it's a mobile device, always show the select panel in the middle
                    $('.select').css('top','40%').css('left','50%').addClass('active');
                }
            }
        });

        $('.select div').click(function(){  //if the select panel been clicked
            turn ++;
            console.log(turn);
            var thisInput = $(this).text();
            var location = $('.selectActive').attr('id').split('_');    //analyze the id to get the location of the block selected
            var thisRow = parseInt(location[1]);    //the x-axis of the block
            var thisCol = parseInt(location[2]);    //the y-axis of the block
            Sudoku.matrix[thisRow][thisCol] = parseInt(thisInput);  //update the input to the data matrix

            //check the number input
            $('.sWrong').removeClass('sWrong');
            Sudoku.compare();   //check the input by calling the compare function

            //after select a number
            $('.selectActive').text(parseInt(thisInput));            //set the number to block
            $('.selectActive').removeClass('selectActive');
            $('.select').removeClass('active');
        });

        $('html').click(function(){     //the user can click any other part of the page (like background) to close the select panel
            $('.selectActive').removeClass('selectActive');
            $('.select').removeClass('active');
        })

    },

    //--------------------------------COMPARE FUNCTION--------------------------
    //compare numbers on the board to find potential mistake
    compare : function(){
        var matrix = Sudoku.matrix;
         for(var i=0; i<9; i++){
             for(var j=0; j<9; j++){
                 for(var h=0; h<9; h++){
                     if(
                         (matrix[i][j] == matrix[i][h] && j != h)   //valid rows in Sudoku rules
                         || (matrix[i][j] == matrix[h][j] && i != h)    //valid cols in Sudoku rules
                       ){
                         $('#Block_'+i+'_'+j).addClass('sWrong');   //if the number is wrong, show it with a red background
                     }
                 for(var k = 0; k < 3; k++) //valid groups in Sudoku rules
                     for(var l = 0; l < 3; l++)
                         if(
                            (matrix[i][j] == matrix[parseInt(i / 3) * 3 + k][parseInt(j / 3) * 3 + l])
                            && (!(i == parseInt(i / 3) * 3+k && j == parseInt(j / 3) * 3+l))
                            ){
                                 $('#Block_'+i+'_'+j).addClass('sWrong');
                             };
                 }
             }
         }

         wrong = $('.sWrong').length;
    }
};


var timer = 0;
var wrong = 0;
var turn = 0;


setInterval(() => {
    timer ++;
    $('#timer').text(`${timer}`);
}, 1000);

function submitRecord () {
    $.post("/api/save-record", {
        user:$('#user').text(),
        wrongs:wrong,
        turns:turn,
        time: timer,
        type:$('#type').text(),
    }, function (data, status) {
        window.location.href = `/home?alert=Your game record has been saved!`;
    } );
}

$('#end').click(function () {
    submitRecord();
});

$(document).ready(function(){
    Sudoku.start();
    Sudoku.play();
});
