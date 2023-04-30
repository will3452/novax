<template>
    <a-card hoverable @click="viewSection(load)">
        <img slot="cover" alt="example" :src="getCover(load.subject.image)" style="max-height:200px; object-fit:cover; " />

        <a-card-meta :title="load.subject.name" :description="load.subject.description">
        </a-card-meta>
    </a-card>
</template>

<script>
export default {
    props: ['load'],
    methods: {
        getCover(image) {
            return image ? "/storage/" + image : 'https://gw.alipayobjects.com/zos/rmsportal/JiqGstEfoWAOHiTxclqi.png';
        },
        viewSection(load) {
            this.$router.push({ name: 'view-section', params: { loadId: this.load.id } });
        }
    }
}
</script>
