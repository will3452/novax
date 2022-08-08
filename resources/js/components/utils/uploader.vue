<template>
    <a-upload-dragger
        action="/api/file-image-upload"
        method="POST"
        name="file"
        @change="fileChangeHandler">
        <p class="ant-upload-drag-icon"><a-icon type="inbox" /></p>
        <slot/>
    </a-upload-dragger>
</template>

<script>
    export default {
        methods: {
            fileChangeHandler (info) {
                let status = info.file.status
                if (status === 'done') {
                    this.$message.success(`file uploaded successfully.`)
                    console.log('file uploaded >> ', info.file.response)
                    this.$emit('uploaded', info.file.response)
                } else if(status === 'error') {
                    this.$message.error(`file upload failed.`);
                }
            },
        }
    }
</script>
