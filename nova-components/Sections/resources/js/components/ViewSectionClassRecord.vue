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
                    </a-form-model>
                    <div slot="extra" v-if="dataSource.length">
                        <a-button type="secondary" @click="editAll">
                            Edit All
                        </a-button>
                        <a-button type="primary" @click="saveAll">
                            Save All
                        </a-button>
                    </div>
                </a-card>
                <a-table :columns="columns" :data-source="dataSource" size="small" :scroll="{ x: true }" :pagination="false"
                    bordered>
                    <div slot="no" slot-scope="item, record, index">
                        {{ index + 1 }}
                    </div>
                    <editable-cell slot="editable" slot-scope="item, record, index" :text="item.score"
                        @change="cellChange(item, $event)" :ref="`cel-${item.activity_id}-${index}`"></editable-cell>
                </a-table>
            </div>
            <div v-else>
                <view-section-activities :load="load" :key="'activity' + aKey" @reload="aKey++"></view-section-activities>
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
            aKey: 0,
            activeTab: 'Class Record',
            columns: [],
            dataSource: [],
            type: null,
            term: null,
            category: null,
            tabList: [
                {
                    key: 'Class Record',
                    tab: 'Class Record',
                },
                {
                    key: 'Activities',
                    tab: 'Activities',
                }
            ]
        }
    },

    methods: {
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

                if (_activities.length == 0) {
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
                console.log(error)
            }
        },
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
            if (this.type == 'Lecture') return ['Quizzes/Seatwork/Assignment', 'Long Quiz', 'Recitation', 'Exam'];
            return ['Lab Activities', 'Exam'];
        }
    }
}
</script>
