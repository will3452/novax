<template>
    <div>
        <button class="btn btn-default btn-primary hover:bg-primary-dark"
            @click="$router.push('/view-lecture')">BACK</button>
        <card class="p-4 mt-2 flex">
            <iframe :src="'/storage/' + file" style="width:70%;" height="600" />

            <!-- <div>
                <canvas ref="canvas"> </canvas>
                <video ref="video" style="width:200px; height:150px; border:2px solid #222; margin-left: 10px; " />
                <div>
                    {{ logs }}
                </div>
            </div> -->
        </card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            logs: [],
            ic: null,
        }
    },
    mounted() {
        setTimeout(() => {
            navigator.mediaDevices
            .getUserMedia({ video: true, audio: true, })
            .then((stream) => {
                this.$refs.video.srcObject = stream;
                console.log(stream);
                this.$refs.video.play();
            })
            .catch(error => {
                console.log(error);
            })
        }, 2000);

         setInterval(() => {
            const context = this.$refs.canvas.getContext("2d");
            context.drawImage(this.$refs.video, 0, 0, 200, 150);

            const data =  this.$refs.canvas.toDataURL("image/png");
            console.log("data >> ", data);
        }, 10000);
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
