<template>
    <card class="flex flex-col items-center justify-center">
        <div class="px-3 py-3" v-if="status !== null">
            <h1 class="text-center text-lg text-80 font-light mb-4" >Latest Document Requested</h1>

            <div class="flex justify-center" v-if="status === 'resolved'">
                <a :href="downloadLink" class="btn btn-default btn-primary" @click="hitDownload()" download>download</a>
            </div>

            <div class="flex justify-center text-gray-400" v-else>
                Your Request is not ready.
            </div>
        </div>
        <div class="px-3 py-3" v-else>
            <h1 class="text-center text-lg text-80 font-light mb-4" >You have no request yet.</h1>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    data() {
        return {
            downloadLink:false,
            status:"resolved"
        }
    },

    mounted() {
        this.getLatestDocumentUrl()
    },

    methods: {
        getLatestDocumentUrl() {
            Nova.request().get('/nova-vendor/latest-document-requested/download-link')
                .then(({data})=>{
                    this.status = data.status;
                    this.downloadLink = data.downloadLink;
                })
                .catch(err=>{
                    this.$toasted.show('Error, Something went wrong!', {type:'error'});
                })
        },
        hitDownload() {
            this.$toasted.show('Your Document is now downloading!', {type:'success'});
        }
    },

}
</script>
