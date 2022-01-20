<x-layout>
    <x-covid-header></x-covid-header>
    <h1 class="text-center text-2xl text-center font-bold uppercase py-2 bg-red-700 text-white rounded-b-lg">
        Covid Facts & Articles
    </h1>
    <div>
        <ul class="px-2 my-2">
            @foreach (\App\Models\CovidInfo::get() as $item)
            <li class="font-bold mb-2">
                <a href="/covid/{{$item->id}}" class="block shadow p-2 rounded bg-gray-300">{{$item->title}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</x-layout>
