<template>
    <span>
        {{isLoading ? 'Loading...' : field.value}}
    </span>
</template>

<script>
export default {
    props: ['resourceName', 'field',],
    methods: {
        async setup() {
            try {
                if (this.field.value.includes('storage') || this.fields.value.includes('http')) throw new error('pull to the api!');
            } catch (error) {
                let { data } = await window.axios.post('https://zylalabs.com/api/116/emotion+detection+api/167/detect+emotion', {
                    url: window.location.origin  + this.field.value,
                    // url:  this.field.value,
                }, {
                    headers: {
                        'Authorization': 'Bearer '+ '2461|23coCzetQgegC67t0zu9ppd7GGxsHeBYLWNymOaX'
                    }
                })

                await window.axios.post('/api/update/', {
                    emotion: data[0].emotion.value,
                    file: this.field.value,
                })

                this.field.value = data[0].emotion.value;

            } finally {
                this.isLoading = false;
            }
        }
    },
    data () {
        return {
            isLoading: true,
        }
    },
    mounted() {
        this.setup();
    },
}
</script>
