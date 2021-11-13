<x-app>
    <style>
        .input-choice{
            cursor: pointer;
        }
    </style>
    <x-page-container>
            <!-- Page Heading -->
        <x-page-header>
            Exam Result!
        </x-page-header>
       <div>
           <h1 class="text-success">
               {{$remark}}
           </h1>
           <h4>
               Score : {{$score}}/{{$perfectScore}}
           </h4>
           <div>
            <a class="btn btn-primary btn-sm" href="/subjects/{{$exam->module->subject->id}}">Back to subjects</a>
            <button class="btn btn-success btn-sm">Share Score</button>
           </div>
       </div>
    </x-page-container>
</x-app>
