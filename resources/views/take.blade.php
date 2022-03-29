<x-layout>
    <x-page-title>
        {{$record->exam_name}}
    </x-page-title>
    {{-- timer --}}
    <x-timer :time="$time"></x-timer>
    {{-- questions --}}
    <div>
        <form id="mainForm" action="/submit/{{$record->id}}" method="POST">
            @csrf
            @foreach ($exam->questions as $q)
                <div class="my-6">
                    <div>
                        <span class="badge badge-primary font-bold text-white">
                            {{$loop->index + 1}}
                        </span>
                        @if ($q->question_image)
                            <img src="{{$q->storage_question}}" alt="" class="inline-block max-h-40">
                        @else
                            {{$q->question}}
                        @endif
                    </div>
                    <div class="ml-4 my-2">
                        <input type="hidden" name="q[{{$loop->index}}]" value="{{$q->id}}" />
                        @if ($q->type === \App\Models\Question::TYPE_IDENTIFICATION)
                            <input type="text" name="a[{{$loop->index}}]" class="input input-bordered input-sm">
                        @endif

                        @if ($q->type === \App\Models\Question::TYPE_TRUE_OR_FALSE)
                            <div class="flex">
                                <span class="mr-4">
                                    <input type="radio" name="a[{{$loop->index}}]" value="1"> True
                                </span>
                                <span class="mr-4">
                                    <input type="radio" name="a[{{$loop->index}}]" value="0"> False
                                </span>
                            </div>
                        @endif

                        @if ($q->type === \App\Models\Question::TYPE_ESSAY)
                            <div class="flex">
                                <textarea name="a[{{$loop->index}}]" id="" cols="30" rows="10" class="w-full textarea textarea-bordered"></textarea>
                            </div>
                        @endif

                        @if ($q->type === \App\Models\Question::TYPE_MULTIPLE_CHOICE)
                            <div class="flex flex-wrap">
                                @php
                                    $x = $loop->index;
                                @endphp
                                @foreach ($q->getAllChoice($q->choices) as $c)
                                    <span class="mr-4">
                                        <input type="radio" name="a[{{$x}}]" value="{{$c}}"> {{$c}}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        @if ($q->type === \App\Models\Question::TYPE_MULTIPLE_ANSWER)
                            <div class="flex flex-wrap">
                                @php
                                    $x = $loop->index;
                                @endphp
                                @foreach ($q->getAllChoice($q->choices) as $c)
                                    <span class="mr-4">
                                        <input type="checkbox" name="a[{{$x}}][]" value="{{$c}}"> {{$c}}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="flex justify-end">
                <button id="submitBtn" type="button" onclick="submitForm()" class="shadow p-4 rounded border font-bold uppercase block text-white bg-blue-500 border-blue-600 px-6">submit</button>
            </div>
            <div class="flex justify-end">
                <div  id="pleaseBtn" class="hidden">
                    <button type="button" disabled class="flex  p-4 rounded items-center font-bold uppercase block  px-6"> <img src="/loading.gif" alt="" style="width:100px;"> Please Wait, Don't refresh your page.</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.9.1/axios.min.js' integrity='sha512-Xk3wWei2TGrsh9kDSBKUMIjw/86sLUvhtnv9f7fOuIwhhiUTKz8szkWkzHthrM5Bb3Bu9idSzkxOrkzhcneuiw==' crossorigin='anonymous'></script>
    <script>
        const mainForm = document.getElementById('mainForm');
        const videoInput = document.getElementById('video');
        const submitBtn = document.getElementById('submitBtn');
        const pleaseBtn = document.getElementById('pleaseBtn');
        let fileName = '';
        const fileChunks = [];
        let uploaded = 0;
        // videoInput.addEventListener('change', function (e) {
        //     console.log(e.target.files[0]);
        // });
        let mediaRecorder = null;
        function submitForm(e) {
            mediaRecorder.stop();
        }
        function createChunks(file) {
            let size = 2000000, chunks = Math.ceil(file.size / size);
            for (let i = 0; i < chunks; i++) {
                fileChunks.push(file.slice(
                    i * size, Math.min(i * size + size, file.size), file.type
                ));
            }
        }
        function upload () {
            axios({
                method: 'POST',
                data: formData(),
                url: '/api/save-video',
                headers: {
                    'Content-Type': 'application/octet-stream'
                },
                onUploadProgress: event => {
                    uploaded += event.loaded;
                }
            })
                .then((response)=>{
                    fileChunks.shift();
                    if (! fileChunks.length) {
                        mainForm.submit();
                    }
                    console.log(response.data);
                    if (fileChunks.length) {
                        upload();
                    }
                }).catch(err=>{
                    console.log(err)
                })
        }
        function formData() {
            let fd = new FormData;
            fd.set('is_last', fileChunks.length === 1);
            fd.set('file', fileChunks[0], `${fileName}.part`);
            fd.set('record_id', {{$record->id}});
            return fd;
        }
        async function startRecord () {
            try {
                let stream = await navigator.mediaDevices.getDisplayMedia({
                    video: true
                });
                const mime = MediaRecorder.isTypeSupported("video/webm; codecs=vp9")
                    ? "video/webm; codecs=vp9"
                    : "video/webm";
                mediaRecorder = new MediaRecorder(stream, {
                    mimeType: mime
                });
                let chunks = []
                mediaRecorder.addEventListener('dataavailable', function(e) {
                    chunks.push(e.data)
                });
                mediaRecorder.addEventListener('stop', function(){
                    submitBtn.classList.add('hidden');
                    pleaseBtn.classList.remove('hidden');
                    let blob = new Blob(chunks, {
                        type: chunks[0].type,
                    });
                     fileName = "{{auth()->id() . now()->format('mdYhis')}}.webm";
                    let file = new File([blob], fileName, {type:'video/webm', lastModified:new Date().getTime()}, 'utf-8');
                    createChunks(file);
                    upload();
                });
                await mediaRecorder.start();
                history.forward();
            }catch {
                alert("Not having permission to record the screen will cause you to be unable to access this exam!");
                window.location.href = "/error";
            }
        }
        startRecord();
    </script>
    @endpush
</x-layout>
