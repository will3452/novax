<template>
    <div>
        <a-modal :visible="showForm" @ok="submit" @cancel="showForm = false; uploadedFile = false">
            <a-upload-dragger action="/api/upload" name="template" @change="handleChange"
                accept=".xls, .xlsx, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                <p class="ant-upload-drag-icon">
                    <a-icon type="inbox" />
                </p>
                <p class="ant-upload-text">
                    Click or drag file to this area to upload
                </p>
            </a-upload-dragger>
        </a-modal>
        <a-modal :visible="showFormImage" @ok="submitImage" @cancel="showForm = false; uploadedFile = false">
            <a-upload :file-list="fileList" :remove="handleRemove" :before-upload="beforeUpload">
                <a-button> <a-icon type="upload" /> Select File </a-button>
            </a-upload>
        </a-modal>
        <heading class="mb-6">Miscellaneous</heading>
        <a-alert message="Warning" :description="note" type="warning" show-icon />
        <div class="mt-2">
            <a-button type="primary" @click="downloadTemplate">
                <a-icon type="download" />
                Download Excel template</a-button>
            <a-button type="secondary" @click=" showForm = true">
                <a-icon type="upload" />
                Upload Excel</a-button>
            <a-button @click=" showFormImage = true">
                <a-icon type="upload" />
                Upload Image</a-button>
        </div>
    </div>
</template>

<script>
var grades = [];
export default {
    metaInfo() {
        return {
            title: 'ImportAndExport',
        }
    },
    data() {
        return {
            showForm: false,
            showFormImage: false,
            uploadedFile: '',
            grades,
            fileList: [],
            note: "This feature can be used to register the grades of students. The following are the limitations of this feature: you need to download the template from the system, and all values entered in each cell must be correct.",
        }
    },
    mounted() {
        //
    },
    methods: {
        handleRemove(file) {
            const index = this.fileList.indexOf(file);
            const newFileList = this.fileList.slice();
            newFileList.splice(index, 1);
            this.fileList = newFileList;
        },
        beforeUpload(file) {
            this.fileList = [...this.fileList, file];
            return false;
        },
        async submitImage() {
            let data = new FormData()
            this.fileList.forEach(file => data.append('document', file, file.name))

            let xhr = new XMLHttpRequest();
            xhr.addEventListener("readystatechange", function () {
                if (this.readyState === 4) {
                    console.log(JSON.parse(this.responseText));
                    let response = JSON.parse(this.responseText);
                    grades = response.document.inference.prediction.grade.values.map(e => e.content);
                }
            });


            xhr.open("POST", "https://api.mindee.net/v1/products/Elezerk/demo/v1/predict");
            xhr.setRequestHeader("Authorization", "Token 4c3803f323b512c6c2c1f2d783b8864c");
            xhr.send(data);
        },
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
