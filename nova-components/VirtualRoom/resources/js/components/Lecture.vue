<template>
    <div>
        <button class="btn btn-default btn-primary hover:bg-primary-dark"
            @click="$router.push('/view-lecture');clearInterval()">BACK</button>
        <card class="p-4 mt-2 flex">
            <iframe :src="'/storage/' + file" style="width:70%;" height="600" />

            <div>
                <canvas ref="canvas"> </canvas>
                <div ref='container'></div>
                <video ref="video" muted style="width:200px; height:150px; border:2px solid #222; margin-left: 10px; " />
                <div>
                    {{ logs }}
                </div>
            </div>
        </card>
    </div>
</template>

<script>
import * as faceapi from 'face-api.js';

export default {
    data() {
        return {
            logs: [],
            ic: null,
            loop: null,
        }
    },
    methods: {
        base64ImageToBlob(str) {
  // extract content type and base64 payload from original string
  var pos = str.indexOf(';base64,');
  var type = str.substring(5, pos);
  var b64 = str.substr(pos + 8);

  // decode base64
  var imageContent = atob(b64);

  // create an ArrayBuffer and a view (as unsigned 8-bit)
  var buffer = new ArrayBuffer(imageContent.length);
  var view = new Uint8Array(buffer);

  // fill the view, using the decoded base64
  for(var n = 0; n < imageContent.length; n++) {
    view[n] = imageContent.charCodeAt(n);
  }

  // convert ArrayBuffer to Blob
  var blob = new Blob([buffer], { type: type });

  return blob;
},
        async detect(data) {
            try {
                let img = new Image(300, 150);
                console.log('image');
                const detection = await faceapi.detectAllFaces(this.$refs.video).withFaceLandmarks().withFaceExpressions()
                console.log(detection)


                img.src = data;

            } catch (error) {
                console.log('detect error', error)
            }
        },
        async clearInterval() {
            window.clearInterval(this.loop);
        },
        async setup() {
            await faceapi.nets.ssdMobilenetv1.loadFromUri('/models')
            await faceapi.nets.faceExpressionNet.loadFromUri('/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
            console.log('Models have loaded successfully.');
        },
    },
    mounted() {
        setTimeout(() => {
            navigator.mediaDevices
            .getUserMedia({ video: true, audio: true, })
            .then((stream) => {
                this.$refs.video.srcObject = stream;
                this.$refs.video.play();
            })
            .catch(error => {
                console.log(error);
            })
        }, 2000);

         this.loop = setInterval(async () => {
            const context = this.$refs.canvas.getContext("2d");
            context.drawImage(this.$refs.video, 0, 0, 200, 150);

            const data =  this.$refs.canvas.toDataURL("image/png");
            let img = new Image(200, 150)
            img.src = data;
            let fd = new FormData()
            let fileName = 'upload.png';
            let file = new File([this.base64ImageToBlob(data)], fileName, {type: 'image/png'})
            fd.append('file', file)

            fd.append('lecture_id', this.$store.state.lecture.id)

            await window.axios.post('/save', fd);

        }, 60000 * 3); // 3 mins
    },

    computed: {
        file() {
            try {
                return this.$store.state.lecture.file;
            } catch {
                return ''
            }

        }
    }
}
</script>
