<template>
    <div>
        <canvas ref="canvas" style="display: none;"></canvas>
        <div v-show="mediaStream">
            <video ref="vid" class="w-100" id="vid"></video>
        </div>
        <div v-show="! mediaStream">
        </div>
        <button id="but" @click="openWebcam" v-if="mediaStream == null" class="btn btn-sm btn-secondary">
            Open WebCam
        </button>
        <!-- <input type="file" @change="fileChange"/> -->
        <button v-if="mediaStream != null" class="btn btn-sm btn-danger" @click="captureImage">{{ action }}</button>
        <img v-if="capturedImage" :disabled="loading" :src="capturedImage" alt="Captured Image" class="w-100" style="display: none;"/>
        <div v-if="loading" class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" :style="{width: `${progress}%`}"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['api', 'task', 'userId', 'action'],
    data () {
        return {
            file: null,
            loading: false,
            progress: 0,
            mediaStream: null,
            capturedImage: null,
        }
    },
    methods: {
        fileChange(e) {
            this.file  = e.target.files[0];
        },

        base64ToBlob(base64) {
        // Decode base64 string
        const byteString = atob(base64.split(",")[1]);
        const mimeString = base64.split(",")[0].split(":")[1].split(";")[0];

        // Create an ArrayBuffer and Uint8Array to store binary data
        const arrayBuffer = new ArrayBuffer(byteString.length);
        const uint8Array = new Uint8Array(arrayBuffer);
        for (let i = 0; i < byteString.length; i++) {
            uint8Array[i] = byteString.charCodeAt(i);
        }

        // Create and return a Blob from the binary data
        return new Blob([uint8Array], { type: mimeString });
        },
        async captureImage() {
            const video = this.$refs.vid;
            const canvas = this.$refs.canvas;

            // Set canvas dimensions to match the video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw the current frame from the video onto the canvas
            const ctx = canvas.getContext("2d");
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert the canvas to a data URL (base64 string)
            this.capturedImage = await canvas.toDataURL("image/png");
            this.file = this.base64ToBlob(this.capturedImage)
            this.submit()
            },
        closeWebcam() {
            if (this.mediaStream) {
                // Stop all tracks in the media stream
                this.mediaStream.getTracks().forEach((track) => track.stop());
                this.mediaStream = null; // Clear the stored media stream
                this.$refs.video.srcObject = null; // Remove the video source
            } else {
                alert("No webcam is active.");
            }
        },
        openWebcam () {
            navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false,
                })
                .then((stream) => {
                    this.mediaStream = stream;
                    console.log(this.$refs);
                    // Changing the source of video to current stream.
                    this.$refs['vid'].srcObject = stream;
                    this.$refs['vid'].addEventListener("loadedmetadata", () => {
                    this.$refs['vid'].play();
                    });
                })
                .catch(window.alert);
        },
        async submit () {
           try {
            this.loading = true;
            this.progress = 10;
            let fd = new FormData()
            fd.append('image', this.file);
            let api = this.api + '/api/upload-image';
            let response = await axios.post(api, fd)
            this.progress += 40;
            let result = await axios.post("https://detect.roboflow.com/tupad-program/2?api_key=k4C9arHZknWSYWhXuT32&image=" + `${this.api}/storage/${response.data}`)
            console.log(result.data);
            this.progress += 30;
            await axios.post('/api/upload-task-result', {
                 user_id: this.userId,
                 task_id: this.task,
                 image: response.data,
                 result: result.data,
            })
            this.progress += 20;
            window.location.reload()
           } catch (error) {
            alert('Something went wrong please contact the administrator!')
            console.log('error => ', error)
           } finally {
            this.loading = false
           }
        }
    }
}
</script>
