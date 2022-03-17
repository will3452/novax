<x-layout>
    <div class="w-11/12 mx-auto my-4">
        <h1 class="text-center text-2xl uppercase mb-4">
            Games
        </h1>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        <div class="flex flex-wrap justify-center">
            <x-card title="Sudoku" img="/soduku.jpg" href="/games/sudoku">
                a puzzle in which players insert the numbers one to nine into a grid consisting of nine squares subdivided into a further nine smaller squares in such a way that every number appears once in each horizontal line, vertical line, and square.
            </x-card>
            <x-card title="Memory flip cards" img="/cards.jpg" href="{{auth()->user()->images()->count() >= 6 ? '/games/flip-card' : 'javascript:alert(`Please Upload at lease 6 Images first. `)'}}">
                Flashcards are a proven method to speed up your learning. As well as flashcards, Memory's Smart mode uses a modern twist to the flashcard concept, offering you many ways to answer questions and to optimise your learning path automatically.
            </x-card>
            <x-card title="Chess" img="/felix-mittermeier-nAjil1z3eLk-unsplash.jpg" href="/Chess/chess.html">
Chess is a board game played between two players. It is sometimes called Western chess or international chess to distinguish it from related games such as xiangqi and shogi.
            </x-card>
        </div>
    </div>
</x-layout>
