@props(['selectedYear'])
<div class="flex items-start justify-between">
    <img src="/storage/{{nova_get_setting('logo')}}" alt="" class="w-[100px] h-[100px]">
    <div class="text-center">
        <h1 class="font-bold">
            Resurrection Power Christian Church International
        </h1>
        <h2>La Paz, Tarlac - Philippines</h2>
        <h3 class="text-2xl font-bold mt-4">Financial Summary Report {{$selectedYear}}</h3>
    </div>
    <div class="w-[100px]"></div>
</div>
