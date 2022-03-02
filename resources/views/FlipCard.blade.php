<!DOCTYPE html>
<html lang="en" data-theme="wireframe" >
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Memory game</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/svg/3132/3132772.svg" type="image/x-icon" />
    <link
      href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Righteous&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/Cards/styles/main.css" />
    <link rel="stylesheet" href="/Cards/styles/card.css" />
    <link rel="stylesheet" href="/Cards/styles/win.css" /><!--Estilo da tela de vitória-->
    <link rel="stylesheet" href="/Cards/styles/responsive.css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.2.2/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card {
            border-radius:2px !important;
        }
        .card.flip[data-nome="sapo"],
        .card.flip[data-nome="sapo"] img {
            background:url('/storage/{{$images[0]->path}}');
            background-position: center;
            background-size: cover;
        }

        .card.flip[data-nome="vaca"],
        .card.flip[data-nome="vaca"] img {
            background:url('/storage/{{$images[1]->path}}');
            background-position: center;
            background-size: cover;
        }

        .card.flip[data-nome="canguru"],
        .card.flip[data-nome="canguru"] img {
            background:url('/storage/{{$images[2]->path}}');
            background-position: center;
            background-size: cover;
        }

        .card.flip[data-nome="leao"],
        .card.flip[data-nome="leao"] img {
            background:url('/storage/{{$images[3]->path}}');
            background-position: center;
            background-size: cover;
        }

        .card.flip[data-nome="passaro"],
        .card.flip[data-nome="passaro"] img {
            background:url('/storage/{{$images[4]->path}}');
            background-position: center;
            background-size: cover;
        }

        .card.flip[data-nome="elefante"],
        .card.flip[data-nome="elefante"] img {
            background:url('/storage/{{$images[5]->path}}');
            background-position: center;
            background-size: cover;
        }
    </style>
  </head>
  <body>
    <x-navbar></x-navbar>
    <!--ALTERAÇÃO* Essa div vai ser exibida quando o jogador vencer a partida!-->
    <div id="vitoria">
      <div id="container">
        <form action="/record-game">
            <h1>Great!</h1>
            {{-- <p>Você encontrou todos os pares com</p> --}}
            {{-- <h2><span id="movimentosvitoria">0</span> ERROS</h2> --}}
            <a href="/home">Back to Dashboard</a>
        </form>
      </div>
    </div>
    <!--FIM-ALTERAÇÃO*-->
    <section id="responsivo">
      <h2>Missed <span id="movimentos2">0</span></h2>
      <!-- <button id="btn-mudartema">Mudar tema</button>
          <button id="btn-reiniciar">Reiniciar</button> -->
      <a href="{{url()->current()}}">Restart</a>
    </section>

    <div class="corpo">
      <section id="esq">
        <h2>Missed <span id="movimentos">0</span></h2>
        <!-- <button id="btn-mudartema">Mudar tema</button>
            <button id="btn-reiniciar">Reiniciar</button> -->
        <a href="{{url()->current()}}">Restart</a>
      </section>
      <section class="jogo">
        <div class="card" data-nome = "sapo">
          <img
            class="frente"
            src="https://picsum.photos/id/242/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "sapo">
          <img
            class="frente"
            src="https://picsum.photos/id/242/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "vaca">
          <img
            class="frente"
            src="https://picsum.photos/id/241/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "vaca">
          <img
            class="frente"
            src="https://picsum.photos/id/241/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "canguru">
          <img
            class="frente"
            src="https://picsum.photos/id/240/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "canguru">
          <img
            class="frente"
            src="https://picsum.photos/id/240/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "leao">
          <img
            class="frente"
            src="https://picsum.photos/id/239/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "leao">
          <img
            class="frente"
            src="https://picsum.photos/id/239/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "passaro">
          <img
            class="frente"
            src="https://picsum.photos/id/238/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "passaro">
          <img
            class="frente"
            src="https://picsum.photos/id/238/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "elefante">
          <img
            class="frente"
            src="https://picsum.photos/id/237/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
        <div class="card" data-nome = "elefante">
          <img
            class="frente"
            src="https://picsum.photos/id/237/200/300"
            alt="card"
          />
          <img
            class="verso"
            src="/none.png"
            alt="card"
          />
        </div>
      </section>
      <section id="dir"></section>
    </div>
    <x-footer></x-footer>
    {{-- <script src="/none/scripts/index.js"></script> --}}
    <script>
        //Deck

let deck = [
  {
    id: 1,
    name: "Sapo",
    color: "#84CFFA",
    imagem: "https://picsum.photos/id/237/200/300",
    descricao: ["descricao 1", "descricao 2", "descricao 3"],
    virado: true,
  },
  {
    id: 2,
    name: "Vaca",
    color: "#FA8484",
    imagem: "https://picsum.photos/id/238/200/300",
    descricao: ["descricao 1", "descricao 2", "descricao 3"],
    virado: true,
  },
  {
    id: 3,
    name: "Canguru",
    color: "#E984FA",
    imagem: "https://picsum.photos/id/239/200/300",
    descricao: ["descricao 1", "descricao 2", "descricao 3"],
    virado: true,
  },
  {
    id: 4,
    name: "Leão",
    color: "#84FAAC",
    imagem: "https://picsum.photos/id/240/200/300",
    descricao: ["descricao 1", "descricao 2", "descricao 3"],
    virado: true,
  },
  {
    id: 5,
    name: "Pássaro",
    color: "#8684FA",
    imagem: "https://picsum.photos/id/401/200/300",
    descricao: ["descricao 1", "descricao 2", "descricao 3"],
    virado: true,
  },
  {
    id: 6,
    name: "Elefante",
    color: "#F7FA84",
    imagem: "https://picsum.photos/402/237/200/300",
    descricao: ["descricao 1", "descricao 2", "descricao 3"],
    virado: true,
  },
];

const cards = document.querySelectorAll('.card');

let hasFlippedCard = false;
let lockBoard = false;
let firstCard, secondCard;
let movements = 0;
let winContador = 0;

function flipCard() {
    //this.classList.toggle('flip');
    if (lockBoard) return;
    if (this === firstCard) return;

    this.classList.add('flip');

    if (!hasFlippedCard) {
        hasFlippedCard = true;
        firstCard = this;
        return;
        }

        console.log(winContador)

        secondCard = this;

        checkForMatch();
    }

    //Conferindo se é igual

    function checkForMatch() {
        if(firstCard.dataset.nome !== secondCard.dataset.nome) {
        movements++;
        }
        document.getElementById("movimentos").innerHTML = `${movements}`;
        document.getElementById("movimentos2").innerHTML = `${movements}`;

        if (firstCard.dataset.nome === secondCard.dataset.nome) {
        winContador++;
        disableCards();
        //ALTERAÇÃO* Confere se o "winContador" é igual a "6", que é o número máximo de vitórias que pode haver no jogo!
        if(winContador == 6) {
            let data = {
                user: {{auth()->id()}},
                wrongs:movements,
                turns:movements,
                time:0,
                type:`{{\App\Models\GameRecord::TYPE_CARD}}`,
            };

            const options = {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            }

            fetch('/api/save-record', options)
                .then(res => res.json())
                .then(res => {
                    console.log(res.data);
                    document.querySelector('#vitoria').style.display = 'block'
                    document.querySelector('#movimentosvitoria').innerHTML = movements;
                });
        }
        //FIM-ALTERAÇÃO*
        return;
        }


        unflipCards();

        console.log(movements);

    }

    //Desabilitando o clique nas cartas viradas

    function disableCards() {
        firstCard.removeEventListener('click', flipCard);
        secondCard.removeEventListener('click', flipCard);

        resetBoard();
    }

    //Virando as cartas erradas de volta

    function unflipCards() {
        lockBoard = true;

        setTimeout(() => {
        firstCard.classList.remove('flip');
        secondCard.classList.remove('flip');

        resetBoard();

        }, 1500);
    }

    function resetBoard() {
        [hasFlippedCard, lockBoard] = [false, false];
        [firstCard, secondCard] = [null, null];
    }

    //Embaralhando cartas (IIFE) Vai ser executada assim que for lida

    (function shuffle() {
        cards.forEach(card => {
        let ramdomPos = Math.floor(Math.random() * 12);
        card.style.order = ramdomPos;
        });
    })();

    cards.forEach(card => card.addEventListener('click', flipCard));

    </script>
  </body>
</html>
