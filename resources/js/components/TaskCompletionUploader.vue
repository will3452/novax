<template>
    <div>
        <input type="file" @change="fileChange"/>
        <button v-if="! loading" class="btn btn-sm btn-success" @click="submit">Submit</button>
        <div v-else class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" :style="{width: `${progress}%`}"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['api', 'task', 'userId'],
    data () {
        return {
            file: null,
            loading: false,
            progress: 0,
        }
    },
    methods: {
        fileChange(e) {
            this.file  = e.target.files[0];
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
            alert('Task has been moved to for evaluation!')
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
