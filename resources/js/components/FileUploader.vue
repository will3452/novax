<template>
    <div>
        <input type="file" ref="file" @change="handleUpload">
        <button :disabled="isLoading" @click="uploadFile">upload file</button>
        <div style="width:100px;height:15px; border:1px #222 solid; position:relative;">
            <div style="height:100%;background:red;position:absolute;" :style="{width:progress + 'px'}"></div>
             <div style="width:100px; text-center;" >progress: {{progress}} %</div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                file: null,
                isLoading:false,
                progress: 0,
            }
        },
        methods: {
            handleUpload() {
                this.file = this.$refs.file.files[0];
                console.log(this.file);
            },

            uploadFile() {
                this.isLoading = true;
                let formData = new FormData();

                formData.append('file', this.file);

                axios.post('/', formData, {headers: { 'Content-Type' : 'multipart/form-data' },
                onUploadProgress: ({loaded, total})=> {
                    this.progress = (loaded / total) * 100;
                    console.log(loaded, total);
                }})
                    .then(res=>{
                        this.isLoading = false;
                        this.$refs.file.value = '';
                        console.log(res.data);
                    })
                    .catch(err=>{
                        alert('something went wrong!');
                    })
            }
        }
    }
</script>
