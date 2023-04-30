<template>
    <a-row :gutter="[16, 16]">
        <a-col :span="16">
            <a-modal @ok="submit" :visible="showModal" @cancel="showModal = false" title="NEW ANNOUNCEMENT">
                <a-form-model :model="payload" ref="form" layout="horizontal" :rules="rules">
                    <a-form-model-item label="title" prop="title" :label-col="{ span: 4 }" :wrapper-col="{ span: 18 }">
                        <a-input v-model="payload.title"></a-input>
                    </a-form-model-item>
                    <a-form-model-item label="body" prop="body" :label-col="{ span: 4 }" :wrapper-col="{ span: 18 }">
                        <a-textarea v-model="payload.body"></a-textarea>
                    </a-form-model-item>
                </a-form-model>
            </a-modal>
            <a-card>
                <div slot="title">
                    <a-icon type="notification" />
                    ANNOUNCEMENTS
                </div>
                <div slot="extra">
                    <a-button type="primary" @click="showModal = true">
                        <a-icon type="plus" />
                        CREATE NEW
                    </a-button>
                </div>
            </a-card>

            <a-row v-if="load.announcements.length" :gutter="[16, 16]" style="margin-top: 8px;">
                <a-col :key="a.id" v-for="a in announcements">
                    <a-card :bordered="false">
                        <div slot="title">
                            <a-avatar> {{ a.user.name[0] }} </a-avatar>
                            <span style="margin-left: 1em; ">
                                {{ a.title }}
                            </span>
                        </div>
                        <small slot="extra">
                            {{ moment(a.created_at).fromNow() }}
                        </small>
                        {{ a.body }}
                        <a-divider>Comments</a-divider>
                        <a-form-model :model="comment">
                            <a-row :gutter="[16, 16]">
                                <a-col :span="20">
                                    <a-form-model-item prop="comment">
                                        <a-textarea v-model="comment.comment"></a-textarea>
                                    </a-form-model-item>
                                </a-col>
                                <a-col :span="4">
                                    <a-button>
                                        Submit
                                    </a-button>
                                </a-col>
                            </a-row>
                        </a-form-model>
                        <a-row :gutter="[16, 16]">
                            <a-col>
                                <a-comment>

                                    <a slot="author">Han Solo</a>
                                    <a-avatar slot="avatar"
                                        src="https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png"
                                        alt="Han Solo" />
                                    <p slot="content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi quas,
                                    </p>
                                    <a-tooltip slot="datetime" :title="moment().format('YYYY-MM-DD HH:mm:ss')">
                                        <span>{{ moment().fromNow() }}</span>
                                    </a-tooltip>
                                </a-comment>
                            </a-col>
                        </a-row>
                    </a-card>
                </a-col>
            </a-row>
            <a-empty v-else style="margin-top: 16px;"></a-empty>
        </a-col>
        <a-col :span="8">
            <a-affix :offset-top="16">
                <section-card-item :load="load"></section-card-item>
            </a-affix>

        </a-col>
    </a-row>
</template>

<script>
import SectionCardItem from '../components/SectionCardItem.vue';
export default {
    components: {
        SectionCardItem
    },
    props: ['load'],
    data() {
        return {
            showModal: false,
            payload: {},
            comment: {},
            rules: {
                title: [
                    { required: true, trigger: 'change' }
                ],
                body: [
                    { required: true, trigger: 'change' }
                ]
            },
        }
    },
    computed: {
        announcements() {
            return this.load.announcements.reverse();
        }
    },
    methods: {
        moment,
        submit() {
            this.$refs.form.validate((valid) => {
                if (valid) {
                    try {
                        this.payload.teaching_load_id = this.load.id;
                        let { data } = axios.post('/nova-vendor/sections/announcements', this.payload);
                        this.$notification.success({ message: 'Success', description: 'Announcement has been added.' });
                        this.showModal = false;
                        this.payload = {};
                        this.$emit('reload');
                    } catch (error) {
                        this.$notification.error({ message: 'Error', description: error.message })
                    }
                }
            })
        }
    }
}
</script>
