<x-layout>
    <div class="overflow-y-auto w-screen h-screen flex justify-center  bg-gradient-to-r from-green-400 to-blue-500 relative">
        <div x-data="{
            paired: [],
            item: null,
            items: {{count($p1)}},
            clickHandler(id) {
                if (this.item == null) {
                    this.item = id

                    return
                }

                if (this.item == id) {
                    this.paired.push(id)
                }

                this.item = null
            }
        }">
            <div class="mb-5">
                <h1 class="text-center text-4xl uppercase mt-2 font-mono">Matching Game</h1>
                <div class="text-center">
                    <a href="/" class="btn btn-sm">back to home</a>
                </div>
            </div>
            <div class="text-green-200 text-center text-2xl" x-show="items == paired.length">
                Great! you solved the game.
            </div>
            <div class="flex items-center flex-wrap justify-between">
                <div class="w-1/3">
                    {{-- p1 --}}
                    @foreach ($p1 as $item)
                        <div x-show="! paired.includes({{$item->id}})">
                            <img x-on:click="clickHandler({{$item->id}})" src="/storage/{{$item->item_1}}" alt="" width="100" class="m-2 cursor-pointer">
                        </div>
                    @endforeach
                </div>
                <div class="w-1/3  ">
                    {{-- p2 --}}
                    @foreach ($p2 as $item)
                        <div x-show="! paired.includes({{$item->id}})">
                            <img x-on:click="clickHandler({{$item->id}})" src="/storage/{{$item->item_2}}" alt="" width="100" class="m-2 cursor-pointer">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-layout>
