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
        <form action="submit-answers" method="POST" enctype="multipart/form-data" id="mainForm">
            @csrf
            <input type="hidden" name="model_type" value="{{get_class($model)}}">
            <input type="hidden" name="model_id" value="{{$model->id}}">
            @foreach ($model->questions as $question)
                <x-card>
                    <x-question q-id="{{$question->id}}" number="{{$loop->index + 1}}" :choices="$question->answers">
                        {!!$question->question!!}
                    </x-question>
                </x-card>
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
    <div id="avatar" class="fixed bottom-0 right-0 w-1/2 flex items-start hidden ">
        <div class="bg-yellow-300 rounded-xl p-4 font-bold text-yellow-900 shadow">
            {{nova_get_setting('avatar_start_message', "You've 1 hour and 30 mins to ace the quiz or exams! Good luck!")}}
        </div>
        <img src="/avatar.png" alt="" class="block w-48 relative animate-bounce">
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.9.1/axios.min.js' integrity='sha512-Xk3wWei2TGrsh9kDSBKUMIjw/86sLUvhtnv9f7fOuIwhhiUTKz8szkWkzHthrM5Bb3Bu9idSzkxOrkzhcneuiw==' crossorigin='anonymous'></script>
    <script>
        const avatar = document.getElementById('avatar');
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
                url: 'api/save-video',
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
            fd.set('attempt_id', {{$attempt->id}});
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


                    // let container = await new DataTransfer();
                    // await container.items.add(file);
                    // videoInput.files = await container.files;
                    // await mainForm.submit();
                })

                mediaRecorder.start();
                avatar.classList.remove('hidden');
                setTimeout(() => {
                    avatar.classList.add('hidden');
                }, 5000);
            }catch {
                alert("Not having permission to record the screen will cause you to be unable to access this quiz or exam!");
                window.location.href = "/error";
            }

        }

        startRecord();
    </script>
</x-layout>
