<template>
    <a-spin :spinning="loading">
        <a-icon slot="indicator" type="loading"></a-icon>
        <a-tabs tab-position="right" v-model="currentTab">
            <a-tab-pane key="feed">
                <div slot="tab">
                    <a-icon type="notification" />
                    FEEDS
                </div>
                <view-section-feed :load="load" :key="'feed' + cKey" @reload="loadTeachingLoads"></view-section-feed>
            </a-tab-pane>
            <a-tab-pane key="attendance">
                <div slot="tab">
                    <a-icon type="calendar" />
                    ATTENDANCES
                </div>
                <view-section-attendance :load="load" :key="'attendance' + cKey"
                    @reload="loadTeachingLoads"></view-section-attendance>
            </a-tab-pane>
            <a-tab-pane key="class_record">
                <div slot="tab">
                    <a-icon type="table" />
                    CLASS RECORD
                </div>
                <view-section-class-record :load="load" :key="'class_record' + cKey"
                    @reload="loadTeachingLoads"></view-section-class-record>
            </a-tab-pane>
            <a-tab-pane key="final_grade">
                <div slot="tab">
                    <a-icon type="file-done" />
                    FINAL GRADE
                </div>
                <view-section-final-grade :load="load" :key="'final_grade' + cKey"
                    @reload="loadTeachingLoads"></view-section-final-grade>
            </a-tab-pane>
            <a-tab-pane key="activity">
                <div slot="tab">
                    <a-icon type="file-add" />
                    ACTIVITIES
                </div>
                <view-section-activities :load="load" :key="'activity' + cKey"
                    @reload="loadTeachingLoads"></view-section-activities>
            </a-tab-pane>
            <a-tab-pane key="student">
                <div slot="tab">
                    <a-icon type="usergroup-add" />
                    STUDENTS
                </div>
                <view-section-students :load="load" :key="'student' + cKey"
                    @reload="loadTeachingLoads"></view-section-students>
            </a-tab-pane>
        </a-tabs>
    </a-spin>
</template>

<script>
import ViewSectionFeed from '../components/ViewSectionFeed.vue';
import ViewSectionStudents from '../components/ViewSectionStudents.vue';
import ViewSectionActivities from '../components/ViewSectionActivities.vue';
import ViewSectionClassRecord from '../components/ViewSectionClassRecord.vue';
import ViewSectionAttendance from '../components/ViewSectionAttendance.vue';
import ViewSectionFinalGrade from '../components/ViewSectionFinalGrade.vue';
export default {
    components: {
        ViewSectionFeed,
        ViewSectionStudents,
        ViewSectionActivities,
        ViewSectionClassRecord,
        ViewSectionAttendance,
        ViewSectionFinalGrade
    },
    async mounted() {
        await this.loadTeachingLoads();
    },
    data() {
        return {
            cKey: 0,
            load: {},
            currentTab: 'feed',
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
