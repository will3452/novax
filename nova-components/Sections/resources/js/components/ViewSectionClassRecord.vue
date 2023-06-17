<template>
    <div>
        <Header :load="load" />
        <a-card :tab-list="tabList" :active-tab-key="activeTab" @tabChange="(e) => activeTab = e">

            <div v-if="activeTab === 'Class Record'">
                <a-card :bordered="false">
                    <a-form-model layout="inline" slot="title">
                        <a-form-model-item label="Type">
                            <a-select style="width:150px;" v-model="type">
                                <a-select-option :key="option" v-for="option in typeOptions" :value="option">{{ option
                                }}</a-select-option>
                            </a-select>
                        </a-form-model-item>
                        <a-form-model-item label="Term">
                            <a-select style="width:150px; " v-model="term">
                                <a-select-option :key="option" v-for="option in ['Prelim', 'Midterm', 'Pre-Final', 'Final']"
                                    :value="option">{{ option }}</a-select-option>
                            </a-select>
                        </a-form-model-item>
                        <a-form-model-item label="Category">
                            <a-select style="width:150px; " v-model="category">
                                <a-select-option :key="option" v-for="option in categoryOptions" :value="option">{{ option
                                }}</a-select-option>
                            </a-select>
                        </a-form-model-item>
                        <a-form-model-item>
                            <a-button type="primary" @click="loadData"> <a-icon type="reload"></a-icon> Load</a-button>
                        </a-form-model-item>
                        <a-form-model-item>
                            <download-excel
                                :header="[` Subject : ${load.subject.name}`, `Instructor:  ${load.teacher.name}`]"
                                ref="download" :name="`${type} - ${term}.xls`" v-show="false" :data="downloableDataSource">
                            </download-excel>
                            <a-button type="secondary" @click="download"> <a-icon type="download"></a-icon>
                                Download</a-button>
                        </a-form-model-item>
                    </a-form-model>

                </a-card>
                <div v-if="dataSource.length" style="margin: 1em 0px; ">
                    <a-button size="small" type="secondary" @click="editAll">
                        Edit All
                    </a-button>
                    <a-button size="small" type="primary" @click="saveAll">
                        Save All
                    </a-button>
                </div>
                <a-table v-if="category != 'All'" :columns="columns" :data-source="dataSource" size="small" :scroll="{ x: true }" :pagination="false"
                    bordered>
                    <div slot="no" slot-scope="item, record, index">
                        {{ index + 1 }}
                    </div>
                    <editable-cell slot="editable" slot-scope="item, record, index" :text="item.score"
                        @change="cellChange(item, $event)" :ref="`cel-${item.activity_id}-${index}`"></editable-cell>
                </a-table>

                <a-table v-else bordered :pagination="false" :columns="allColumns" :data-source="this.load.students">

                </a-table>
            </div>
            <div v-if="activeTab === 'Activities'">
                <view-section-activities :load="load" :key="'activity' + aKey" @reload="aKey++"></view-section-activities>
            </div>
            <div v-if="activeTab === 'misc'">

                <a-button dowload type="primary" href="/class record template.xlsx">
                    <a-icon type="download"></a-icon>
                    Download Excel Template
                </a-button>
                <a-button @click="uploadModal = true">
                    <a-icon type="upload"></a-icon>
                    Upload Record
                </a-button>
                <a-modal :visible="uploadModal" @cancel="uploadModal = false" ok-text="Upload" @ok="uploadHandler">
                    <a-form-model slot="title">
                        <a-form-model-item label="Type">
                            <a-select style="width:100%;" v-model="activity_id">
                                <a-select-option :key="option.id" v-for="option in load.activities" :value="option.id">
                                    {{ option.description }}
                                </a-select-option>
                            </a-select>
                        </a-form-model-item>
                        <a-upload :file-list="fileList" :remove="handleRemove" :before-upload="beforeUpload">
                            <a-button> <a-icon type="upload" /> Select File </a-button>
                        </a-upload>
                    </a-form-model>
                </a-modal>
            </div>
        </a-card>
    </div>
</template>


<script>
import Header from './Header.vue';
import ViewSectionActivities from './ViewSectionActivities.vue';
import EditableCell from './EditableCell.vue';
export default {
    components: {
        EditableCell,
        ViewSectionActivities,
        Header,
    },
    props: ['load'],
    data() {
        return {
            activity_id: null,
            fileList: [],
            uploadModal: false,
            aKey: 0,
            activeTab: 'Class Record',
            columns: [],
            dataSource: [],
            type: null,
            term: null,
            category: null,
            uploadType: null,
            uploadTerm: null,
            uploadCategory: null,
            tabList: [
                {
                    key: 'Class Record',
                    tab: 'Class Record',
                },
                {
                    key: 'Activities',
                    tab: 'Activities',
                },
                {
                    key: 'misc',
                    tab: 'Miscellaneous ',
                }
            ]
        }
    },

    methods: {
        uploadHandler() {
            let payload = {
                activity_id: this.activity_id,
            };

            let fd = new FormData();

            this.fileList.forEach(file => fd.append('files', file));

            fd.append('data', JSON.stringify(payload));

            window.axios.post('/api/upload-record', fd);
        },
        beforeUpload(file) {
            this.fileList = [...this.fileList, file];
            return false;
        },
        handleRemove(file) {
            const index = this.fileList.indexOf(file);
            const newFileList = this.fileList.slice();
            newFileList.splice(index, 1);
            this.fileList = newFileList;
        },
        download() {
            console.log("data source >> ", this.dataSource);
            this.$refs.download.generate()
        },
        editAll() {
            let keys = Object.keys(this.$refs);
            console.log('keys >>', keys);
            for (let key of keys) {
                if (key.includes('cel')) {
                    this.$refs[key].edit();
                }
            }
        },
        saveAll() {
            let keys = Object.keys(this.$refs);
            console.log('keys >>', keys);
            for (let key of keys) {
                if (key.includes('cel')) {
                    this.$refs[key].check();
                }
            }
        },
        getTransmutedValue(initialValue, numberOfItems) {
            try {
                if (numberOfItems < initialValue) {
                    throw new Error("Initial Grade is not valid.");
                }

                // check if passed or not
                let isPassed = initialValue / numberOfItems * 50 + 50 > 70;

                let result = null;

                if (isPassed) {
                    result = initialValue / numberOfItems * 50 + 50;
                } else {
                    result = (((initialValue / numberOfItems * 50 + 50) - 50) / 4) + 65;
                }

                return Math.floor(result); // FLOOR use to round down the result eg. 65.9 -> 65
            } catch (error) {
                return error.message;
            }
        },

        async cellChange(score, event) {
            try {

                score.score = event;
                let { data } = await axios.post('/nova-vendor/sections/update-score', score);
            } catch (error) {
                console.log("cellChange >> ", error);
            }
        },
        reset() {

            this.$emit('reload');

            this.columns = [];
            this.dataSource = [];
        },
        loadDataMeta() {


            this.columns.push({
                title: 'No.',
                key: 'no',
                scopedSlots: { customRender: 'no' },
            });

            this.columns.push({
                title: 'Student',
                key: 'name',
                dataIndex: 'name',
            });

            this.columns.push({
                title: 'Student No.',
                key: 'number',
                dataIndex: 'number',
            });
        },
        async loadData() {
            try {

                this.reset();

                let _activities = this.load.activities.filter(a => a.type == this.type && a.term == this.term && a.category == this.category);

                if (_activities.length == 0 && this.category != 'All') {
                    this.$notification.info({ message: 'No Activity Found.', description: 'Please add activity.' });
                    return;
                }


                // just load some default column
                this.loadDataMeta();

                _activities.forEach(activity => {
                    this.columns.push({
                        title: `${activity.description} [${activity.max_score}]`,
                        key: activity.description,
                        dataIndex: activity.id,
                        scopedSlots: { customRender: 'editable' },
                    });
                });

                // this.columns.push({
                //     title: 'Equivalent',
                //     key: 'equivalent',
                //     dataIndex: 'equivalent',
                // })

                // load maximum score
                _activities.forEach(a => {

                })

                // load students
                this.load.students.forEach(s => {
                    let _student = {
                        name: s.name,
                        number: s.profile.number,
                    };
                    _activities.forEach(a => {
                        let _score = this.load.scores.find(score => score.activity_id == a.id && score.student_id == s.id);
                        if (!_score) {
                            _student[a.id] = { activity_id: a.id, student_id: s.id, teaching_load_id: this.load.id };
                        } else {
                            _student[a.id] = _score;
                        }
                    })
                    this.dataSource.push(_student);
                })



            } catch (error) {
                if (this.category == 'All') return;
                console.log(error)
            }
        },
    },

    computed: {
        allData() {
            let activities = Object.freeze(this.load.activities);
            return activities;
        },
        allColumns() {
            try {
                let _col = [
                    {
                        title:'Student',
                        key: 'student',
                        customRender: (text, record, index) => {
                            return text.name;
                        }
                    }
                ];
                let activities = Object.freeze(this.load.activities);
                let scores = Object.freeze(this.load.scores);
                let studentRecords = Object.freeze(this.load.student_records);

                for (let act of activities.filter( e => e.term == this.term && e.type == this.type)) {
                    let exists = _col.find(e => e.title == act.category)

                    if (! exists) {
                        let _newCol = {
                            title: act.category,
                            key: act.category,
                            children: [],
                        }

                        _newCol.children.push({
                            title: _newCol.children.length + 1,
                            key: act.category +_newCol.children.length + 1,
                            customRender: (text, record, index ) => {

                                let score = scores.find(s => s.activity_id == act.id && record.id == s.student_id);
                                return score ? score.score : '-';
                            }
                        })

                        _col.push(_newCol);
                    } else {
                        exists.children.push({
                            title: exists.children.length + 1,
                            key: act.category +exists.children.length + 1,
                            customRender: (text, record, index ) => {
                                let score = scores.find(s => s.activity_id == act.id && record.id == s.student_id);
                                return score ? score.score : '-';
                            }
                        })
                    }
                }

                _col.push({
                    title: this.term + ' Grade',
                    customRender: (text, record, index ) => {
                        let grade = studentRecords.find( s => s.student_id == text.id)
                        let key = 'total_grade';
                        if (this.term == 'Prelim') {
                            key = 'prelim_grade';
                        }

                        if (this.term == 'Midterm') {
                            key = 'midterm_grade';
                        }

                        if (this.term == 'Pre-Final') {
                            key = 'pre_final_grade';
                        }

                        if (this.term == 'Final') {
                            key = 'final_grade';
                        }

                        return grade[key];
                    }
                })

                return _col;
            } catch(error) {
                console.log('allColumns >> error ', error);
                return [];
            }
        },
        downloableDataSource() {
            return this.dataSource.map(data => {
                let newForm = {};
                Object.keys(data).forEach((key, index) => {
                    if (typeof data[key] == 'object') {
                        newForm['Activity ' + (index + 1)] = data[key].score;
                    } else {
                        newForm[key] = data[key];
                    }
                })

                return newForm;
            });
        },
        typeOptions() {
            try {
                if (!this.load.subject.has_lab) return ['Lecture'];
                return ['Lecture', 'Laboratory'];
            } catch (error) {
                return [];
            }
        },
        categoryOptions() {
            if (this.type == 'Lecture') return ['Quizzes/Seatwork/Assignment', 'Long Quiz', 'Recitation', 'Exam', 'All'];
            return ['Lab Activities', 'Exam', 'All'];
        }
    }
}
</script>
