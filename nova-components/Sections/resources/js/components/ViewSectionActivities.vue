<template>
    <div>
        <a-modal title="Activity" @ok="submit" :visible="showForm" @cancel="showForm = false">
            <a-form-model ref="form" :rules="rules" layout="horizontal" :model="payload" :wrapper-col="{ span: 18 }"
                :label-col="{ span: 6 }">

                <a-form-model-item label="Type" prop="type">
                    <a-select class="w-full" v-model="payload.type">
                        <a-select-option :key="option" v-for="option in typeOptions" :value="option">{{ option
                        }}</a-select-option>
                    </a-select>
                </a-form-model-item>
                <a-form-model-item label="Category" prop="category">
                    <a-select class="w-full" v-model="payload.category">
                        <a-select-option :key="option" v-for="option in categoryOptions" :value="option">{{ option
                        }}</a-select-option>
                    </a-select>
                </a-form-model-item>
                <a-form-model-item label="Description" prop="description">
                    <a-input v-model="payload.description"></a-input>
                </a-form-model-item>
                <a-form-model-item label="Max Score" prop="max_score">
                    <a-input-number :min="1" class="w-full" v-model="payload.max_score"></a-input-number>
                </a-form-model-item>
                <a-form-model-item label="Term" prop="term">
                    <a-select class="w-full" v-model="payload.term">
                        <a-select-option :key="option" v-for="option in ['Prelim', 'Midterm', 'Pre-Final', , 'Final']"
                            :value="option">{{ option }}</a-select-option>
                    </a-select>
                </a-form-model-item>
            </a-form-model>
        </a-modal>
        <a-card title="Activities">
            <div slot="extra">
                <a-button type="primary" @click="showForm = true">
                    <a-icon type="plus"></a-icon>
                    New Activity
                </a-button>
            </div>
            <a-table :key="tableKey" :columns="columns"
                :data-source="load.activities.filter(e => e.category != 'Attendance')" :scroll="{ x: true }">
                <template slot="action" slot-scope="item, record">
                    <a-popover placement="leftBottom">
                        <div slot="content">
                            <div>
                                <a-button type="link" @click="edit(record)">
                                    <a-icon type="edit"></a-icon> Update
                                </a-button>
                            </div>
                            <div>
                                <a-popconfirm placement="topLeft" ok-text="Yes" cancel-text="No"
                                    @confirm="deleteActivity(record)">
                                    <div slot="title">
                                        Are you sure you want to delete this activity?
                                    </div>
                                    <a-button type="link">
                                        <a-icon type="delete"></a-icon>Delete</a-button>
                                </a-popconfirm>
                            </div>
                        </div>
                        <a-icon type="more"></a-icon>
                    </a-popover>
                </template>
            </a-table>
        </a-card>
    </div>
</template>


<script>
export default {
    props: ['load'],
    data() {
        return {
            tableKey: 0,
            payload: {},
            showForm: false,
            columns: [
                {
                    title: 'Type',
                    key: 'type',
                    dataIndex: 'type',
                },
                {
                    title: 'Category',
                    key: 'category',
                    dataIndex: 'category',
                },
                {
                    title: 'Description',
                    key: 'description',
                    dataIndex: 'description',
                },
                {
                    title: 'Max score',
                    key: 'max_score',
                    dataIndex: 'max_score',
                },
                {
                    title: 'Term',
                    key: 'term',
                    dataIndex: 'term',
                },
                {
                    title: 'Action',
                    key: 'action',
                    scopedSlots: { customRender: 'action' },
                },
            ],
            rules: {
                type: [
                    { required: true, }
                ],
                category: [
                    { required: true, }
                ],
                description: [
                    { required: true, }
                ],
                max_score: [
                    { required: true },
                ],
                term: [
                    { required: true }
                ],
            },
        }
    },
    computed: {
        typeOptions() {
            try {
                if (!this.load.subject.has_lab) return ['Lecture'];
                return ['Lecture', 'Laboratory'];
            } catch (error) {
                return [];
            }
        },
        categoryOptions() {
            if (this.payload.type == 'Lecture') return ['Quizzes/Seatwork/Assignment', 'Long Quiz', 'Recitation', 'Exam'];
            return ['Lab Activities', 'Exam'];
        }
    },
    methods: {
        async deleteActivity(a) {
            let { data } = await axios.post('/nova-vendor/sections/remove-activity/' + a.id);
            this.$notification.success({ message: 'Success', description: 'Activity has been deleted successfully' });
            this.$emit('reload');
        },
        edit(a) {
            this.payload = { ...a };
            this.showForm = true;
        },
        submit() {
            this.$refs.form.validate(async (valid) => {
                if (valid) {
                    this.payload.teaching_load_id = this.load.id;
                    if (this.payload.id) {
                        await axios.post('/nova-vendor/sections/update-activity/' + this.payload.id, this.payload);
                        this.$notification.success({ message: 'success', description: 'Activity has been updated.' })
                    } else {
                        await axios.post('/nova-vendor/sections/new-activity', this.payload);
                        this.$notification.success({ message: 'success', description: 'Activity has been added.' })
                    }
                    this.showForm = false;
                    this.payload = {};
                    this.tableKey++;
                    this.$emit('reload');
                }
            })
        }
    }
}
</script>
