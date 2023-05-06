<template>
    <div>
        <TheHeader />
        <a-row v-if="teachingLoads.length" :gutter="[10, 10]">
            <a-col :span="8" v-for="load in teachingLoads" :key="load.id">
                <section-card-item :load="load" :key="load.id"></section-card-item>
            </a-col>
        </a-row>
        <a-empty v-else></a-empty>
    </div>
</template>

<script>
import TheHeader from './TheHeader.vue';
import SectionCardItem from './SectionCardItem.vue';
export default {
    metaInfo() {
        return {
            title: 'Sections',
        }
    },
    components: {
        TheHeader,
        SectionCardItem,
    },
    data() {
        return {
            user: {},
            sections: [],
        }
    },
    methods: {
        async loadUsers() {
            try {
                let { data } = await axios.get('/nova-vendor/sections/user');
                this.user = data;
                if (this.user.type == 'Student') {
                    let loads = this.user.student_records.filter(e => e.teaching_load_id != null).map(e => e.teaching_load_id)
                    let { data } = await axios.post('/nova-vendor/sections/get-loads', { loads });
                    this.sections = data;
                }
            } catch (error) {
                console.log('loadUsers error >> ', error)
            }
        },
    },
    mounted() {
        this.loadUsers();
    },
    computed: {
        teachingLoads() {
            if (this.user.type != 'Student') {
                return this.user.teaching_loads;
            }

            return this.sections;
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
