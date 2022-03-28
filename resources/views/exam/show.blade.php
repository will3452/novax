<x-layout>
    <x-page-title>
        {{$exam->name}}
    </x-page-title>
    @teacher
    <div class="flex justify-center my-4">
        <x-modal button="Create new question">
            <form action="/questions" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="exam_id" value="{{$exam->id}}">
                <div class="form-control" x-data="{type:true}">
                    <label for="" class="label">
                        <div class="label-text">
                            Question
                            <a href="#" x-show="type" x-on:click.prevent="type=false" class="text-xs underline text-blue-500">upload image instead?</a>
                            <a href="#" x-on:click.prevent="type=true"  x-show="!type" class="text-xs underline text-blue-500">type question instead?</a>
                        </div>
                    </label>
                    <template x-if="type">
                        <textarea required type="text" name="question" class="textarea textarea-bordered w-full"></textarea>
                    </template>
                    <template x-if="!type">
                        <input type="file" name="question_image" accept="image/*" required>
                    </template>
                </div>
                <div class="form-control" x-data="{type:''}">
                    <div class="label">
                        <div class="label-text">Type</div>
                    </div>
                    <select name="type" x-model="type" class="select select-bordered w-full" required>
                        <option value="" disabled selected></option>
                        <option value="{{\App\Models\Question::TYPE_MULTIPLE_CHOICE}}">{{\App\Models\Question::TYPE_MULTIPLE_CHOICE}}</option>
                        <option value="{{\App\Models\Question::TYPE_IDENTIFICATION}}">{{\App\Models\Question::TYPE_IDENTIFICATION}}</option>
                        <option value="{{\App\Models\Question::TYPE_TRUE_OR_FALSE}}">{{\App\Models\Question::TYPE_TRUE_OR_FALSE}}</option>
                        <option value="{{\App\Models\Question::TYPE_MULTIPLE_ANSWER}}">{{\App\Models\Question::TYPE_MULTIPLE_ANSWER}}</option>
                        @if ($exam->is_manual_checking)
                            <option value="{{\App\Models\Question::TYPE_ESSAY}}">{{\App\Models\Question::TYPE_ESSAY}}</option>
                        @endif
                    </select>
                    <div class="form-control">
                        <template x-if="type == `{{\App\Models\Question::TYPE_TRUE_OR_FALSE}}`">
                            <div class="my-1">
                                <div class="label">
                                    <div class="label-text">Correct answer</div>
                                </div>
                                <div class="form-control">
                                    <label class="label cursor-pointer">
                                      <span class="label-text">True</span>
                                      <input type="radio" name="answer" value="1" class="radio checked:bg-blue-500" checked>
                                    </label>
                                  </div>
                                  <div class="form-control">
                                    <label class="label cursor-pointer">
                                      <span class="label-text">False</span>
                                      <input type="radio" name="answer" value="0" class="radio checked:bg-red-500">
                                    </label>
                                  </div>
                            </div>
                        </template>
                        <template x-if="type == `{{\App\Models\Question::TYPE_IDENTIFICATION}}`">
                            <div class="my-1">
                                <div class="label">
                                    <div class="label-text">Correct answer</div>
                                </div>
                                <input type="text" name="answer" required class="input input-bordered w-full">
                            </div>
                        </template>
                        <template x-if="type == `{{\App\Models\Question::TYPE_MULTIPLE_CHOICE}}` || type == `{{\App\Models\Question::TYPE_MULTIPLE_ANSWER}}`">
                            <div>
                                <div class="my-1">
                                    <div class="label">
                                        <div class="label-text">Correct answer</div>
                                    </div>

                                    <template x-if="type == `{{\App\Models\Question::TYPE_MULTIPLE_ANSWER}}`">
                                        <div>
                                            <input id="tt" type="text" name="answer" required class="input input-bordered w-full">
                                            <script>
                                                var x = document.querySelector('#tt');
                                                var xt = new Tagify(x);
                                            </script>
                                        </div>
                                    </template>

                                    <template x-if="type == `{{\App\Models\Question::TYPE_MULTIPLE_CHOICE}}`">
                                        <div>
                                            <input type="text" name="answer" required class="input input-bordered w-full">
                                        </div>
                                    </template>
                                </div>
                                <div class="my-1">
                                    <div class="label">
                                        <div class="label-text">Choices</div>
                                    </div>
                                    <input type="text" name="choices" required class="input input-bordered w-full">
                                    <script>
                                        var input = document.querySelector('input[name=choices]');
                                        new Tagify(input);
                                    </script>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <button class="btn btn-primary mt-4" type="submit">submit</button>
            </form>
        </x-modal>
    </div>
    @endteacher
    <x-table>
        <thead>
            <tr>
                <th>
                    Question
                </th>
                <th>
                    Correct Answer
                </th>
                <th>
                    Type
                </th>
                <th>
                    Choices
                </th>
                <th>

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exam->questions as $q)
                <tr>
                    <td>
                        @if ($q->question_image)
                            <a target="_blank" href="{{$q->storage_question}}">
                                <img src="{{$q->storage_question}}" alt="" style="width:50px !important;">
                            </a>
                        @else
                            {{$q->question}}
                        @endif
                    </td>
                    <td>
                        @if ($q->type === \App\Models\Question::TYPE_MULTIPLE_ANSWER)
                            @foreach ($q->getAllChoice($q->answer) as $c)
                                <span>{{$c}}</span>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        @else
                            {{$q->answer}}
                        @endif
                    </td>
                    <td>
                        {{$q->type}}
                    </td>
                    <td>
                        @foreach ($q->getAllChoice(null) as $c)
                            <span>{{$c}}</span>
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <x-modal button="delete" extra="btn-xs btn-warning">
                            <form action="/questions/{{$q->id}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <h1>
                                    Are you sure you want to delete this question ?
                                </h1>
                                <div class="mt-3">
                                    <button class="btn btn-warning">Yes, I'm sure!</button>
                                </div>
                            </form>
                        </x-modal>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table>
    @push('styles')
        <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/@yaireo/tagify"></script>
        <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    @endpush
</x-layout>
