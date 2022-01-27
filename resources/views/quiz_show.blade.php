<x-layout>
    <x-alert-info>
        {{ \Illuminate\Foundation\Inspiring::quote() }}
    </x-alert-info>
    <div class="bg-yellow-200">
        <div class="container mx-auto py-5">
            <p class="uppercase tracking-widest font-bold text-xl">
                {{$model->name}}
            </p>
            <p class="text-sm">
                by {{\App\Models\User::find($model->user_id)->name}}
            </p>
        </div>
    </div>
    <div class="container mx-auto">
        <form action="submit-answers" method="POST">
            @csrf
            <input type="hidden" name="model_type" value="{{get_class($model)}}">
            <input type="hidden" name="model_id" value="{{$model->id}}">
            @foreach ($model->questions as $question)
                <x-card>
                    <x-question q-id="{{$question->id}}" number="{{$loop->index + 1}}" :choices="$question->answers">
                        {{$question->question}}
                    </x-question>
                </x-card>
            @endforeach
            <div class="flex justify-end">
                <button class="shadow p-4 rounded border font-bold uppercase block text-white bg-blue-500 border-blue-600 px-6">submit</button>
            </div>
        </form>
    </div>
</x-layout>
