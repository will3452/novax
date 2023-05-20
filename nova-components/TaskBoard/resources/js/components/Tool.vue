<template>
    <div :key="forceUpdateKey">
        <a-modal title="Setting" :visible="showSettingModal" :ok-text="'Apply'" @cancel="showSettingModal = false"
            @ok="applyHandler">
            <a-form-item label="View Status">
                <a-select class="w-full" mode="multiple" v-model="form">
                    <a-select-option v-for="status in statuses" :key="status" :value="status">
                        {{ status }}
                    </a-select-option>
                </a-select>
            </a-form-item>
        </a-modal>
        <a-card>
            <a-row type="flex" align="middle" slot="title">
                <a-icon type="appstore" class="mr-2" />
                TASK BOARD
            </a-row>
            <div class="flex" slot="extra">
                <a-button @click="showSettingModal = true" class="mr-2" type="primary">
                    <a-icon type="setting" /> Setting
                </a-button>

            </div>
        </a-card>
        <a-row type="flex" :gutter="[5, 5]" style="margin-top: 0.25em; overflow-x: auto; width: 80vw; " key="containerKey">
            <a-col :span="6" v-for="status in viewStatus" :key="status">
                <task-list @hide="hideHandler" @reload="reload" :name="status"
                    :url="`/tasks/?status=${status}`"></task-list>
            </a-col>
        </a-row>
        <a-empty v-if="viewStatus.length == 0" style="margin-top: 1em"></a-empty>
    </div>
</template>

<script>
import TaskList from './TaskList.vue';
export default {
    components: {
        TaskList,
    },
    metaInfo() {
        return {
            title: 'TaskBoard',
        }
    },
    data() {
        return {
            showSettingModal: false,
            forceUpdateKey: 0,
            tasks: [],
            containerKey: 1,
            form: ['FOR APPROVAL', 'ON GOING', 'ON HOLD', 'CANCELLED', 'APPROVED', 'REJECTED', 'DONE'],
            statuses: ['FOR APPROVAL', 'ON GOING', 'ON HOLD', 'CANCELLED', 'APPROVED', 'REJECTED', 'DONE'],
            viewStatus: ['FOR APPROVAL', 'ON GOING', 'ON HOLD', 'CANCELLED', 'APPROVED', 'REJECTED', 'DONE'],
        };
    },
    methods: {
        hideHandler(status) {
            this.viewStatus = this.viewStatus.filter(e => e != status)
        },
        applyHandler() {
            this.viewStatus = this.form;
        },
        reload() {
            // Inside your component method or Vue instance
            this.forceUpdateKey++;
        }
    }
}
</script>
