<h1 class="text-center text-2xl uppercase mb-4">
    Applications
</h1>
@if (request()->has('alert'))
    <x-alert-success>
        {{request()->alert}}
    </x-alert-success>
@endif
<div class="flex flex-wrap justify-center">
    <x-card title="Gallery" img="/clay-banks-fEVaiLwWvlU-unsplash.jpg" proceed-text="View All" href="{{route('gallery')}}">
        Add new images related to your family and experience that you want to remember and don't want to forget.
    </x-card>
    <x-card title="BMI Calculator" img="/neonbrand-5ddH9Y2accI-unsplash.jpg" proceed-text="Try Now" href="/bmi">
        Calculate and Track your BMI record.
    </x-card>
    <x-card title="Health Tips" img="/s-o-c-i-a-l-c-u-t-hwy3W3qFjgM-unsplash.jpg" proceed-text="Try now" href="/tips">
        Browse Health tips, from our health experts.
    </x-card>
    <x-card title="Todo list" img="/workshop-2Kqhw3qST0o-unsplash.jpg" proceed-text="Try now" href="/todos">
        In order to ensure that you don't forget anything and are able to effectively plan out your tasks so that they are all accomplished in the correct time frame.
    </x-card>
</div>
