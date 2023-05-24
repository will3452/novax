<template>
    <drop @drop="dropHandler" :key="name">
        <a-card :title="name" :style="{ borderTop: '.5em solid ' + this.getColor(name) }">
            <a-input-search style="margin-bottom: 0.5em; " v-model="keyword" placeholder="Search task"></a-input-search>
            <a-icon type="eye-invisible" slot="extra" @click="$emit('hide', name)" style="cursor:pointer; " />
            <a-spin :spinning="loading" class="w-full">
                <a-icon type="loading" slot="indicator"></a-icon>
                <drag style="margin-bottom: 0.5em; " @dragend="dragendHandler" v-for="item in filteredItems" :key="item.id"
                    :data="item">
                    <a-card @click='$emit("show-details", item)' hoverable>
                        <a-row align="top" slot="title" :gutter="[5, 5]" type="flex">
                            <a-icon type="align-left" class="mr-2" />
                            <div>
                                <div>
                                    {{ getEntity(item).name }}
                                </div>
                                <small>
                                    {{ getEntity(item).classification.classification }}
                                </small>
                            </div>
                        </a-row>

                        <a-tag slot="extra" :color="getColor(item.status)"> {{ item.status }}</a-tag>
                        <p>
                            {{ getEntity(item).description }}
                        </p>
                    </a-card>
                </drag>
            </a-spin>
            <a-empty v-if="!items.length"></a-empty>
        </a-card>
    </drop>
</template>

<script>

import { Drag, Drop } from 'vue-easy-dnd';

export default {
    props: ['url', 'name'],

    components: {
        Drag,
        Drop,
    },
    data() {
        return {
            items: [],
            loading: true,
            keyword: '',
            showDrawer: false,
        }
    },
    async mounted() {
        try {
            let { data } = await axios.get(this.url);
            this.items = data;
        } catch (error) {
            console.log(error);
        } finally {
            this.loading = false;
        }
    },
    computed: {
        filteredItems() {
            try {
                if (this.keyword == '') return this.items;
                return this.items.filter(item => this.getEntity(item).name.includes(this.keyword))
            } catch (error) {
                return []
            }
        }
    },
    methods: {
        dragendHandler(item) {
            console.log('dragendHandler >> ', item)
            this.loadData();
            this.$emit('reload')
        },
        async dropHandler(item) {
            console.log(item.data)
            let response = await axios.post(this.url, { id: item.data.id });
            console.log(`drop to  ${this.name} >> ${item.data.id}`)
            this.loadData();
            this.$emit('reload')
        },
        getColor(status) {
            return ({
                'FOR APPROVAL': 'orange',
                'ON GOING': 'blue',
                'ON HOLD': 'gray',
                'CANCELLED': 'black',
                'REJECTED': 'red',
                'APPROVED': 'green',
                'DONE': 'yellow',
            })[status];
        },
        getEntity(item) {
            if (item.project_id != null) {
                return item.project;
            }

            return item.ticket;
        },
        async loadData() {
            let { data } = await axios.get('/tasks');
            this.tasks = data;
        },
        dragStartHandler(event) {
            console.log(event)
        },
    }
}
</script>
