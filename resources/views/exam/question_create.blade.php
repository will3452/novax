<x-new-layout>
    <h4>
        New Question
    </h4>
    <form action="/questions" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf
        <input type="hidden" name="exam_id" value="{{$exam->id}}">
        <div class="form-control" x-data="{type:true}">
            <label for="" class="label">
                <div class="label-text">
                    Question
                    <a href="#" x-show="type" x-on:click.prevent="type=false" class="text-success underline text-blue-500">upload image instead?</a>
                    <a href="#" x-on:click.prevent="type=true"  x-show="!type" class="text-success underline text-blue-500">type question instead?</a>
                </div>
            </label>
            <template x-if="type">
                <textarea required type="text" name="question" class="form-control border p-2"></textarea>
            </template>
            <template x-if="!type">
                <div>
                    <input type="file" name="question_image" accept="image/*" required>
                </div>
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
                        <input type="text" name="answer" required class="form-control border">
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
                                    <input type="text" name="answer" required class="form-control border">
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
    @push('styles')
        <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    @endpush
    @push('scripts')
        <script src="https://unpkg.com/@yaireo/tagify"></script>
        <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    @endpush
</x-new-layout>
