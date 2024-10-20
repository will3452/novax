<template>
    <div>
        <input type="file" @change="fileChange"/>
        <button class="btn btn-sm btn-success" @click="submit">Submit</button>
    </div>
</template>

<script>
export default {
    data () {
        return {
            file: null,
        }
    },
    methods: {
        fileChange(e) {
            this.file  = e.target.files[0];
        },
        async submit () {
            let fd = new FormData()
            fd.append('image', this.file);
            let response = await axios.post('/api/upload-image', fd)
            console.log('response ', response)
            axios({
                method: "POST",
                url: "https://detect.roboflow.com/tupad-program/2",
                params: {
                    api_key: "k4C9arHZknWSYWhXuT32",
                    image: '',
                }
            })
            .then(function(response) {
                console.log(response.data);
            })
            .catch(function(error) {
                console.log(error.message);
            });
        }
    }
}
</script>
