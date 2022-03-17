<x-layout>
    <div class="w-screen h-screen flex justify-center items-center bg-gray-100"
    x-data="{
        screenWidth:0,
        screenHeight:0,
        change() {
            let btn = this.$refs.button;
            btn.style.top  = `${Math.floor(Math.random() * this.screenHeight) - 10}px`;
            btn.style.left  = `${Math.floor(Math.random() * this.screenWidth) - 10}px`;
            console.log(btn)
        },
        init() {
            this.screenWidth= window.innerWidth;
            this.screenHeight = window.innerHeight;
        }
    }"
    >
        <div class="text-center">
            <h1 class="text-3xl uppercase font-bold text-gray-700">
                Yourzaj.xyz
            </h1>
            <a x-on:mouseover="change()" x-ref="button" class="fixed bg-gray-800 p-2 rounded-lg text-white uppercase font-bold">
                Administrator
            </a>
        </div>
    </div>
</x-layout>
