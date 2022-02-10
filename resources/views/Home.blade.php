<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brumultiverse | Home</title>
    <link href="/bru_assets/circle_logo.png" rel="icon"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .active {
            background:url('/bru_assets/button_bg.png') !important;
            background-position: right;
            background-size: cover;
        }
    </style>
</head>
<body style="background:#0F021B !important;" class="text-white">
    <x-home-nav></x-home-nav>
    <div
    style="
        background: url('/bru_assets/main_bg.png');
        height:400px;
        background-position:center;
        background-size:cover;
    "
    class="relative flex items-center"
    >
        <x-home-slogan></x-home-slogan>
    </div>

    {{-- introductions --}}
    <x-home-text-container>
        The brainchild of Khiara Laurea and Miel Salva, BRUMULTIVERSE is vast, having multifold dimensions and realms, and parallel realities and universes, characters that come to life in the dead of night, and names that echo whispered dreams and stirred feelings. It is an immense plane, where billions of stories, waiting to be told, exist. Some of the best ones have already been written, while others await their rightful storytellers.
    </x-home-text-container>

    {{-- art picture --}}
    <div
    style="
        margin-top:2em;
        background: url('/bru_assets/map_bg.jpg');
        height:300px;
        background-position:bottom;
        background-size:contain;
        background-attachment:fixed;
    ">
    </div>

    <x-home-text-container>
        Precisely because of that, BRUMULTIVERSE explores the infinite potentials and promises of human existence and circumstances we have yet to understand. It is ever expanding, built and rooted firmly in the joint musings, imaginations, beliefs, perceptions and conceptions of the Filipino creators and of authors and artists of all genres and from varying backgrounds around the globe.
    </x-home-text-container>

    <x-home-text-container>
        In 2021, BRUMULTIVERSE is launched and introduced through Realidad Dimension, one of six dimensions, for its first phase. Within this dimension is Tellurian Realm or the realm of the living and of reality. And here, on Earth, is a university, where all its mysteries unfold.
    </x-home-text-container>

    <x-home-text-container>
        Please note, however, that while we recognize your awesome works and ideas, we only publish stories set within the BRUMULTIVERSE.
    </x-home-text-container>

    <footer>
        <div class="flex justify-center mt-4">
            <img src="/bru_assets/circle_logo.png" alt="circle logo" class="w-20">
        </div>
        <x-home-text-container>
            We’d love for you to join our growing BRU family!
            <h2 class="text-center font-bold text-2xl">
                BRUMULTIVERSE
            </h2>
            Immerse yourself, experience and be part of each university story on e-books, audio books, short videos and songs from authors and artists around the globe!
        </x-home-text-container>
    </footer>
</body>
</html>
