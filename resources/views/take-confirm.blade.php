<x-new-layout>
    <form action="/take-now/{{$e->id}}" method="POST">
        @csrf
        <h4>Do you want to take &quot;<span class="font-bold">{{$e->name}}</span>&quot; now?</h4>
        @if ($e->code)
            <div class="my-2">
                <div class="label">
                    <div class="label-text">Please enter the code</div>
                </div>
                <input type="text" class="input input-bordered w-full" name="code">
                <div class="label">
                    <div class="label-text text-xs">You can get the code to the assigned teacher.</div>
                </div>
            </div>
        @endif
        <button class="btn btn-primary">Take Now</button>
    </form>
</x-new-layout>
