<x-layout>
    <h1 class="text-2xl font-bold text-center bg-gradient-to-r from-green-400 to-blue-500 py-4">
        QUIZ
        <div class="text-center">
            <a href="/" class="btn btn-sm">back to home</a>
        </div>
    </h1>
    <h1 class="text-2xl font-bold text-center bg-gradient-to-r from-green-400 to-blue-500 py-4 h-screen">
        <div>YOUR SCORE</div>
        <div>
            <span class="text-4xl">
                {{$score}}
            </span> / {{$total}}
        </div>
    </h1>
</x-layout>
