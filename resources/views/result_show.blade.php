<x-layout>
    <div class="bg-yellow-200">
        <div class="container mx-auto py-5">
            <p class="uppercase tracking-widest font-bold text-xl">
                {{$model->name}} <span class="text-green-600">(RESULTS : {{$totalScore}} / {{$totalItems}})</span>
            </p>
            <p class="text-sm">
                by {{\App\Models\User::find($model->user_id)->name}}
            </p>
        </div>
    </div>
    <div class="mx-auto container">
        @foreach ($results as $item)
            <x-card>
                <x-answer number="{{$loop->index + 1}}" answer="{{$item->answer->answer}}" type="{{$item->type}}">
                    {!!$item->question->question!!}
                </x-answer>
            </x-card>
        @endforeach
        <div class="flex justify-end">
            <a href="/" class="shadow p-4 rounded border font-bold uppercase block text-white bg-blue-500 border-blue-600 px-6">Back to the Dashboard</a>
        </div>

    </div>
    <div id="avatar" class="fixed bottom-0 right-0 w-1/2 flex items-start">
        <div class="bg-yellow-300 rounded-xl p-4 font-bold text-yellow-900 shadow">
            {{nova_get_setting('avatar_end_message', "Thanks for answering!")}}
        </div>
        <img src="/avatar.png" alt="" class="block w-48 relative animate-bounce">
    </div>
</x-layout>
