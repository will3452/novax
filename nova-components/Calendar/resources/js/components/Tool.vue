<template>
    <div>
        <div class="flex gap-4" >
            <div class="w-full md:w-1/2">
                    <vc-calendar @dayclick="onDayClick" :attributes="events" is-expanded></vc-calendar>
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex items-center justify-between ">
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[24px]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <h3>Appointments List</h3>
                    </div>
                    <div>
                        <input placeholder="Search By Patient Name" v-model="keyword" class="border px-2 p-1 rounded-md" type="text">
                    </div>
                </div>
                <div class="space-y-4 mt-4 h-[80vh] overflow-y-auto">

                <div v-if="loading">Getting data...</div>
                <div v-if="! filtered.length" class="bg-gray-200 p-4 rounded-md text-center text-gray-500 font-bold">
                    No Data. Please select Date
                </div>
                    <div v-for="item in filtered" :key="item.id" class="cursor-pointer">
                        <div class="bg-white shadow-md border rounded" @click="$router.push('/resources/patient-records/' + item.patient.id)">
                            <div class="flex justify-between  items-center">
                                <div class="flex items-center gap-2 p-4">
                                    <img class="w-[50px] h-[50px] inline-block rounded-full" :src="`https://ui-avatars.com/api/?name=${item.patient.name}`"/>
                                    <div>
                                        <h1 class="font-bold">{{ item.patient.name }} ({{ item.patient.gender || '?' }}) - {{ item.service || 'Unknown Service' }}</h1>
                                        <h2 class="text-xs">{{ item.patient.email }}</h2>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="border-r p-4">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[16px]">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                            </svg>
                                            <div>
                                                {{ item.date.split('T')[0] }}
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[16px]">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>

                                            <div>
                                                {{item.slot}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 flex flex-col justify-center items-center gap-2">
                                        <button @click.prevent.stop="changeStatus(item.id, 'Finished')" class="bg-green-500 text-white rounded-md" title="Mark as Finished">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-[35px] h-[24px]"stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>

                                        </button>
                                        <button @click.prevent.stop="changeStatus(item.id, 'Cancelled')" class="bg-red-500 text-white rounded-md" title="Cancel">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[35px] h-[24px]">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
          title: 'Calendar',
        }
    },
    data() {
        return {
            records: [],
            selected: [],
            loading: true,
            keyword: '',
        }
    },
    computed: {
        events () {
            let _events = this.records.map( e => ({dates: new Date(e.date), key: e.id, bar: {color: 'green',}, customData: {...e}}));
            _events.push({
                    key: 'today',
                    highlight: {
                        color: 'orange',
                        fillMode: 'light',
                    },
                    dates: new Date(),
                },
                )

                return _events;
        },
        filtered() {
            return this.selected.filter( e => e.patient?.name?.toLowerCase().includes(this.keyword));
        },
    },
    methods: {
        onDayClick(day) {
            console.log('day -> ', day)
            this.selected = day.attributes.filter(e => e.customData).map( e => e.customData)
        },
        async changeStatus (id, status) {
            try {
                await axios.post(`/nova-vendor/calendar/appointments/${id}`, {status});
            } catch (error) {
                alert('Something went wrong');
            } finally {
                this.loadData();
            }
        },
        async loadData() {
            try {
                this.loading = true;
                const { data } = await  axios.get('/nova-vendor/calendar/appointments')
                this.records = data;
            } catch (error) {
                alert('failed to load appointments')
            } finally {
                this.loading = false
                this.selected = []
            }
        }
    },
    mounted() {
        this.loadData();
    },
}
</script>
