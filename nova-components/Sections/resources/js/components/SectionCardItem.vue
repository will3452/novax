<template>
    <a-card hoverable @click="viewSection(load)">
        <img slot="cover" alt="example" :src="getCover(load.subject.image)" style="max-height:200px; object-fit:cover; " />


        <a-card-meta :title="load.subject.name" :description="load.subject.description">
        </a-card-meta>
        <div v-if="!editDescription" @dblclick.stop="editDescription = true" @click.stop>
            {{ description || load.description }}
            <a-button @click.stop="editDescription = true" type="link">
                <a-icon type="edit"></a-icon>
                Edit
            </a-button>
        </div>
        <a-row v-else @click.stop>
            <a-col :span="18">
                <a-input @click.stop type="text" v-model="description" />
            </a-col>
            <a-col :span="2">
                <a-button size="small" @click.stop="save">save</a-button>
            </a-col>
        </a-row>
    </a-card>
</template>

<script>
export default {
    props: ['load'],
    data() {
        return {
            editDescription: false,
            description: '',
        }
    },
    methods: {
        getCover(image) {
            return image ? "/storage/" + image : 'https://gw.alipayobjects.com/zos/rmsportal/JiqGstEfoWAOHiTxclqi.png';
        },
        viewSection(load) {
            this.$router.push({ name: 'view-section', params: { loadId: this.load.id } });
        },
        save() {
            window.axios.post('/api/load/' + this.load.id, { description: this.description })
            this.editDescription = false;
        }
    }
}
</script>
