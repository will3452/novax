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
            <a-card v-if="user.type != 'Student'">
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
                                        <a-textarea :ref="`a${a.id}`"></a-textarea>
                                    </a-form-model-item>
                                </a-col>
                                <a-col :span="4">
                                    <a-button @click="submitComment(a.id, `a${a.id}`)">
                                        Submit
                                    </a-button>
                                </a-col>
                            </a-row>
                        </a-form-model>
                        <a-row :gutter="[16, 16]">
                            <a-col v-for="c in a.comments" :key="c.id">
                                <a-comment>
                                    <a slot="author">{{ c.user.name }}</a>
                                    <a-avatar slot="avatar"
                                        :src="'https://ui-avatars.com/api/?background=random&name=' + c.user.name"
                                        alt="Han Solo" />
                                    <p slot="content">{{ c.content }}
                                    </p>
                                    <a-tooltip slot="datetime" :title="moment(c.created_at).format('YYYY-MM-DD HH:mm:ss')">
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
    props: ['load', 'user'],
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
        async submitComment(aId, box) {
            try {

                let { data } = axios.post('/api/comments', {
                    content: this.$refs[box][0].$el.value,
                    user_id: this.user.id,
                    commentable_id: aId
                });

                this.$refs[box][0].setValue('')

                this.$emit('reload');
            } catch (error) {
                this.$notification.error('Submit comment error')
            }
        },
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
