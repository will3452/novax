<x-layout>
    <div class="w-11/12 mx-auto my-4">
        <h1 class="text-center text-2xl uppercase mb-4">
            Applications
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
            <x-card title="Gallery" img="/clay-banks-fEVaiLwWvlU-unsplash.jpg" proceed-text="View All" href="{{route('gallery')}}">
                Add new images related to your family and experience that you want to remember and don't want to forget.
            </x-card>
            <x-card title="BMI Calculator" img="/neonbrand-5ddH9Y2accI-unsplash.jpg" proceed-text="Try Now" href="javascript:alert(`comming soon`)">
                Calculate and Track your BMI record.
            </x-card>
            <x-card title="Health Tips" img="/s-o-c-i-a-l-c-u-t-hwy3W3qFjgM-unsplash.jpg" proceed-text="Try now" href="javascript:alert(`comming soon`)">
                Browse Health tips, from our health experts.
            </x-card>
        </div>
    </div>
</x-layout>
