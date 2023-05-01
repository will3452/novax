<template>
    <div>
        <a-modal :visible="showForm" @ok="submit" @cancel="showForm = false; uploadedFile = false">
            <a-upload-dragger action="/api/upload" name="template" @change=" handleChange "
                accept=".xls, .xlsx, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                <p class="ant-upload-drag-icon">
                    <a-icon type="inbox" />
                </p>
                <p class="ant-upload-text">
                    Click or drag file to this area to upload
                </p>
            </a-upload-dragger>
        </a-modal>
        <heading class="mb-6">Excel</heading>
        <a-alert message="Warning" :description=" note " type="warning" show-icon />
        <div class="mt-2">
            <a-button type="primary" @click=" downloadTemplate ">
                <a-icon type="download" />
                Download template</a-button>
            <a-button type="secondary" @click=" showForm = true ">
                <a-icon type="upload" />
                Upload</a-button>
        </div>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
            title: 'ImportAndExport',
        }
    },
    data() {
        return {
            showForm: false,
            uploadedFile: '',
            note: "This feature can be used to register the grades of students. The following are the limitations of this feature: you need to download the template from the system, and all values entered in each cell must be correct.",
        }
    },
    mounted() {
        //
    },
    methods: {
        async submit() {
            if (!this.uploadedFile) {
                this.$notification.error({ message: 'Error', description: 'Please upload file' });
                return;
            }

            let { data } = await axios.post('/api/import', { template: this.uploadedFile });
            this.$notification.success({ message: 'success', description: 'Grade has been uploaded.' })
            this.showForm = false;
        },
        handleChange(e) {
            let file = e.fileList[0];
            if (file.response) {
                this.uploadedFile = file.response;
            }
        },
        downloadTemplate() {
            let a = document.createElement('a');
            a.href = '/template.xlsx';
            a.download = `template-${Date.now()}`;
            a.click();
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
