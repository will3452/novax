<template>
    <div>
        <a-drawer width="500" @close="selectedStudent = null" :visible="selectedStudent != null" title="Student Details">
            <a-descriptions :column="1" size="small" :bordered="true">
                <a-descriptions-item label="Name">
                    {{ selectedStudent ? selectedStudent.name : '--' }}
                </a-descriptions-item>
                <a-descriptions-item label="Student #">
                    {{ selectedStudent ? selectedStudent.profile.number : '--' }}
                </a-descriptions-item>
                <a-descriptions-item label="Course">
                    {{ selectedStudent ? selectedStudent.profile.course : '--' }}
                </a-descriptions-item>
                <a-descriptions-item label="Address">
                    {{ selectedStudent ? selectedStudent.profile.address : '--' }}
                </a-descriptions-item>
                <a-descriptions-item label="Mobile">
                    {{ selectedStudent ? selectedStudent.profile.mobile : '--' }}
                </a-descriptions-item>
            </a-descriptions>
            <a-popconfirm placement="topLeft" ok-text="Yes" cancel-text="No" @confirm="confirm">
                <div slot="title">
                    All record will erase too, Are you sure you want to remove this student?
                </div>
                <a-button type="danger" style="margin-top: 1em">REMOVE</a-button>
            </a-popconfirm>
        </a-drawer>
        <a-modal @ok="submit" :visible="showModal" @cancel="showModal = false" :closable="false">
            <a-form-model :rules="rules" :model="newStudent" ref="form">
                <a-form-model-item prop="student_id" label="Select Student" layout="horizontal" :wrapper-col="{ span: 16 }"
                    :label-col="{ span: 8 }">
                    <a-select style="width:100%; " v-model="newStudent.student_id">
                        <a-select-option v-for="s in students.filter(e => e.profile != null)" :key="s.id" :value="s.id">
                            {{ s.name }} - {{ s.profile.number }}
                        </a-select-option>
                    </a-select>
                </a-form-model-item>
            </a-form-model>
        </a-modal>
        <a-row :gutter="[16, 16]">
            <a-col :span="6">
                <a-card :hoverable="true" @click="addStudent" class="card">
                    <a-row type="flex" justify="center" style="text-align:center; " align="center">
                        <a-col :span="24">
                            <a-icon type="plus" style="font-size:75px;"></a-icon>
                        </a-col>
                        <a-col :span="24">
                            NEW STUDENT
                        </a-col>
                    </a-row>
                </a-card>
            </a-col>
            <a-col :span="6" v-for="s in load.students" :key="s.id">
                <view-section-student-card :student="s" @click="selectStudent"></view-section-student-card>
            </a-col>
        </a-row>
    </div>
</template>
<script>
import ViewSectionStudentCard from './ViewSectionStudentCard.vue';
export default {
    components: {
        ViewSectionStudentCard
    },
    props: ['load'],
    data() {
        return {
            submitLoading: false,
            showModal: false,
            students: [],
            selectedStudent: null,
            newStudent: {},
            rules: {
                student_id: [{ required: true, message: 'Student is required.' }]
            },
        };
    },
    async mounted() {
        await this.loadStudents()
    },
    methods: {
        selectStudent(student) {
            console.log(student)
            this.selectedStudent = student;
        },
        async remove() {
            try {
                let payload = {
                    student_id: this.selectedStudent.id,
                    teaching_load_id: this.load.id,
                };
                var { data } = await axios.post('/nova-vendor/sections/remove-student', payload);

                console.log(data);

                this.$notification.success({ message: 'Success', description: 'Student removed successfully' });
                this.$emit('reload');
            } catch (error) {
                this.$notification.error({ message: 'Error', description: error.response.data.message });
            }
        },
        confirm() {
            this.remove();
        },
        addStudent() {
            this.showModal = true;
        },
        async submit() {
            this.$refs.form.validate(async (valid) => {
                if (valid) {
                    try {
                        this.newStudent.subject_id = this.load.subject_id;
                        this.newStudent.academic_year_id = this.load.academic_year_id;
                        this.newStudent.teaching_load_id = this.load.id;
                        this.newStudent.semester_id = this.load.semester_id;
                        let { data } = await axios.post('/nova-vendor/sections/new-student', this.newStudent);
                        this.$notification.success({ message: 'Success', message: 'Student has been added successfully' });
                        this.$emit('reload');
                    } catch (error) {
                        this.$notification.error({ message: 'error', description: error.response.data.message });
                    }
                }
            })

        },
        async loadStudents() {
            try {
                let { data } = await axios.get('/nova-vendor/sections/students');
                this.students = data;
            } catch (error) {
                this.$notification.error(error);
            }
        },
    }
}
</script>

<style scoped>
.secondary {
    color: #777;
    font-size: 12px;
    font-family: monospace;
}

.name {
    font-weight: 900;
    text-transform: uppercase;
}

.card {
    border-radius: 10px;
}
</style>
