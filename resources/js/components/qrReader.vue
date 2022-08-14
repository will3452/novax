<template>
    <div>
        <a-spin :spinning="loading"></a-spin>
        <!-- <p>Result : <code>{{result}}</code></p> -->
        <no-ssr>
            <qr-reader @code-scanned="showResult"></qr-reader>
        </no-ssr>
    </div>
</template>

<script>
import qrReader from 'vue-qr-reader/dist/lib/vue-qr-reader.umd.js'
import noSsr from 'vue-no-ssr'
export default {
    components: {
        qrReader,
        noSsr,
    },
    data () {
        return {
            result: '',
            loading: false,
        }
    },
    methods: {
        showResult(data) {
            this.result = data
            console.log("RESULT >> ", data)
            this.getDetails()
        },
        async getDetails () {
            try {
                this.loading = true
            } catch (err) {
                this.$message.error('Something went wrong.')
                console.log('response error >> ', err)
            } finally {
                this.loading = false
            }
        }
    }
}
</script>
