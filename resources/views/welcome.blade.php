<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .animation {
            position: relative; 
            animation-name: bounce; 
            animation-duration: 500ms;
            animation-direction: alternate;
            animation-timing-function: linear; 
            animation-iteration-count: infinite;
        }

        @keyframes bounce {
            from {
                top: 0; 
            }
            to {
                top: 10px; 
            }
        }
    </style>
</head>

<body class="flex items-center justify-center h-screen text-center w-screen p-0 m-0" style="background:url('/home.png'); background-size:cover;background-position:center;">
    <div class="">
        <h1 class="text-6xl text-white font-bold drop-shadow-lg" style="text-shadow:2px 0 #000;">MTICKS</h1>
        <h2 class="text-4xl mt-4 text-white font-bold drop-shadow-lg" style="text-shadow:2px 0 #000;">MOBILE BUS TICKETING</h2>
        <h3 class="mt-4 text-2xl text-white uppercase italic font-thin" style="text-shadow:2px 0 #000;">Download the app here</h3>
        <div class="flex justify-center m-2 animation">
            <a target="_blank" href="https://drive.google.com/file/d/16I735WnMDklTINwrcDmxArSj2ARbAB1W/view?usp=drive_link" class="flex w-20 h-20 block justify-center p-2 uppercase border-white font-bold text-white items-center bg-blue-600 mt-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            </a>
        </div>
    </div>
</body>