<x-new-layout>
    <form action="/take-now/{{$e->id}}" method="POST" id="form">
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
        <a class="btn btn-primary" href="#" onclick="takeNowHandler()" >Take Now</a>

        @push('scripts')
            <style>
                .bootbox-close-button, .close {
                    display: none;
                }
            </style>
            <!-- CSS only -->
            <!-- CSS only -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
            <script>
                function takeNowHandler () {
                    bootbox.confirm("The system will record your exam, To do this you must approve the permission on your computer before the exam starts. Not granting permission can result in automatic getting a score of zero (0).", function(result){
                        if (result) {
                            $('#form').submit();
                        }
                    });
                }
            </script>
        @endpush
    </form>
</x-new-layout>
