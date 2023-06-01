<template>
    <div>
        <a-drawer :visible="grades.length" @close="grades = []" width="500">
            <a-form-model-item label="Student">
                <a-select allowClear style="width:100%; " v-model="student_id" optionFilterProp="key" show-search>
                    <a-select-option v-for="s in students.filter(e => e.profile != null)" :key="s.name" :value="s.id">
                        {{ s.name }} - {{ s.profile.number }}
                    </a-select-option>
                </a-select>
            </a-form-model-item>
            <a-form-model-item label="Semester">
                <a-select allowClear style="width:100%; " v-model="semester_id" optionFilterProp="key" show-search>
                    <a-select-option v-for="s in semesters" :key="s.id" :value="s.id">
                        {{ s.semester }}
                    </a-select-option>
                </a-select>
            </a-form-model-item>
            <a-row :gutter="[16, 16]" v-for="grade, index of grades" :key="index">
                <a-col :span="12">
                    <a-form-model-item label="Subject Code">
                        <a-input v-model="payload.grades[index].code" required></a-input>
                    </a-form-model-item>
                </a-col>
                <a-col :span="12">
                    <a-form-model-item label="Grade">
                        <a-input v-model="payload.grades[index].grade" required></a-input>
                    </a-form-model-item>
                </a-col>
            </a-row>
            <a-button @click="gradeSubmit">
                SUBMIT
            </a-button>
        </a-drawer>
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
        <a-modal :visible="showFormImage" :loading="loading" @ok="submitImage" @cancel="cancelHandler">
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
            <a-button @click=" showFormImage = true" :loading="loading">
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
            loading: false,
            showForm: false,
            showFormImage: false,
            uploadedFile: '',
            grades,
            fileList: [],
            grades: [],
            students: [],
            semesters: [],
            student_id: null,
            semester_id: null,
            payload: { grades: [], },
            note: "This feature can be used to register the grades of students. The following are the limitations of this feature: you need to download the template from the system, and all values entered in each cell must be correct.",
        }
    },
    mounted() {
        this.loadStudents();
        this.loadSemester();
    },
    methods: {
        async gradeSubmit() {
            try {
                this.payload.student_id = this.student_id;
                this.payload.semester_id = this.semester_id;
                console.log('payload>> ', this.payload);
                let { data } = await axios.post('/api/submit-grade-of-student', this.payload);
                console.log('data >> ', data);
                this.grades = [];
                this.$notification.success({ message: 'Success', description: 'Grade has been imported.' })
            } catch (error) {
                console.log(error)
                this.$notification.error({ message: 'ERROR', description: 'failede to saved!' });
            }
        },
        async loadStudents() {
            try {
                let { data } = await axios.get('/api/semester');
                this.semesters = data;
            } catch (error) {
                console.log(error)
            }
        },
        async loadSemester() {
            try {
                let { data } = await axios.get('/api/students');
                this.students = data;
            } catch (error) {
                this.$notification.error(error);
            }
        },
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
            this.$notification.info({ message: 'Info', description: 'Please wait the image is processing.' })
            this.loading = true;
            let data = new FormData()
            this.fileList.forEach(file => data.append('document', file, file.name))

            let { data: response } = await window.axios.post('https://api.mindee.net/v1/products/Elezerk/demo/v1/predict', data, {
                headers: {
                    Authorization: 'Token 4c3803f323b512c6c2c1f2d783b8864c',
                }
            });

            try {
                this.grades = response.document.inference.prediction.grade.values.map(e => e.content);
                if (this.grades.length == 0) throw new Error('error');
                for (let i = 0; i < this.grades.length; i++) {
                    this.payload.grades.push({ grade: this.grades[i] });
                }
            } catch (error) {
                this.$notification.error({ message: "Error", description: 'No Grade found' });
            } finally {
                this.loading = false;
            }

            // let xhr = new XMLHttpRequest();
            // xhr.addEventListener("readystatechange", function () {
            //     if (this.readyState === 4) {
            //         console.log(JSON.parse(this.responseText));
            //         let response = JSON.parse(this.responseText);
            //         grades = response.document.inference.prediction.grade.values.map(e => e.content);
            //     }
            // });


            // xhr.open("POST", "https://api.mindee.net/v1/products/Elezerk/demo/v1/predict");
            // xhr.setRequestHeader("Authorization", "Token 4c3803f323b512c6c2c1f2d783b8864c");
            // xhr.send(data);
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
        cancelHandler() {
            this.showFormImage = false;
            this.uploadedFile = false
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
