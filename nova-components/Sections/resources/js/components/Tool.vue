<template>
    <div>
        <TheHeader />
        <a-row v-if="user.teaching_loads.length" :gutter="[10, 10]">
            <a-col :span="8" v-for="load in user.teaching_loads" :key="load.id">
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
        }
    },
    methods: {
        async loadUsers() {
            try {
                let { data } = await axios.get('/nova-vendor/sections/user');
                this.user = data;
            } catch (error) {
                console.log('loadUsers error >> ', error)
            }
        },
    },
    mounted() {
        this.loadUsers();
    },
}
</script>

<style>
/* Scoped Styles */
</style>
