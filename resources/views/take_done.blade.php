<x-layout>
    <x-page-title>
        Your got : {{$score}}
    </x-page-title>
    @foreach ($record->answers as $a)
        <div class="my-2 border-2 rounded">
            {{$a->question->question}}
        </div>
    @endforeach
   <div class="text-center mt-4">
        <a href="/exams" class=" btn btn-sm btn-primary">back to list of exams</a>
   </div>
</x-layout>
