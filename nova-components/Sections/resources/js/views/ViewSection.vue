<template>
    <a-spin :spinning="loading">
        <a-icon slot="indicator" type="loading"></a-icon>
        <a-tabs tab-position="right" v-model="currentTab">
            <a-tab-pane key="feed" tab="Feeds">
                <view-section-feed :load="load" @reload="loadTeachingLoads"></view-section-feed>
            </a-tab-pane>
            <a-tab-pane key="class_record" tab="Class Records">
                <div>
                    hello wolrd
                </div>
            </a-tab-pane>
            <a-tab-pane key="activity" tab="Activities">
                <view-section-activities :load="load" @reload="loadTeachingLoads"></view-section-activities>
            </a-tab-pane>
            <a-tab-pane key="student" tab="Students">
                <view-section-students :load="load" @reload="loadTeachingLoads"></view-section-students>
            </a-tab-pane>
        </a-tabs>
    </a-spin>
</template>

<script>
import ViewSectionFeed from '../components/ViewSectionFeed.vue';
import ViewSectionStudents from '../components/ViewSectionStudents.vue';
import ViewSectionActivities from '../components/ViewSectionActivities.vue';
export default {
    components: {
        ViewSectionFeed,
        ViewSectionStudents,
        ViewSectionActivities,
    },
    async mounted() {
        await this.loadTeachingLoads();
    },
    data() {
        return {
            load: {}, currentTab: 'activity',
            loading: false,
        }
    },
    methods: {
        getCover(image) {
            return image ? "/storage/" + image : 'https://gw.alipayobjects.com/zos/rmsportal/JiqGstEfoWAOHiTxclqi.png';
        },
        async loadTeachingLoads() {
            try {
                this.loading = true;
                let { data } = await axios.get('/nova-vendor/sections/teaching-loads/' + this.$route.params.loadId);
                this.load = data;
            } catch (error) {
                this.$notification.error({ message: 'Error', description: 'Something went wrong.' })
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
