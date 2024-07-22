<template>
    <div class="space-y-2">
        <div class="text-2xl">
            Event Calendar
        </div>
        <vc-calendar :columns="2" :attributes="attrs" is-expanded>
            <div
                slot="day-popover"
                slot-scope="{ day, dayTitle, attributes }">
                <div class="text-xs text-gray-300 font-semibold text-center">
                    {{ dayTitle }}
                </div>
                <ul>
                <li
                    v-for="{key, customData} in attributes"
                    :key="key" class="flex gap-2 items-center">
                    <span class="inline-block w-[8px] h-[8px] rounded-full " :style="`background:${customData.backgroundColor}`"></span> {{ customData ? customData.title : ''}}
                </li>
                </ul>
            </div>
        </vc-calendar>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
          title: 'EventCalendar',
        }
    },
    mounted() {
        this.loadEvents()
    },
    methods: {
        async loadEvents () {
            try {
                let { data } = await Nova.request().get('/nova-vendor/event-calendar/events');
                this.events = data; 
                function getRandomColor() {
                    // Generate a random color in hexadecimal format
                    const letters = '0123456789ABCDEF';
                    let color = '#';
                    for (let i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
                console.log('getRandomColor', getRandomColor())
                for(let e of this.events) {
                    console.log("title -> ", e.title)
                    let backgroundColor = getRandomColor(); 
                    this.attrs.push({
                        dot: {
                            style: {
                                backgroundColor, 
                            }
                        }, 
                        popover: {
                            label: `testing`,
                        },
                        key: e.id, 
                        customData: {
                            ...e, 
                            backgroundColor, 
                        }, 
                        dates: [
                            new Date(e.start)
                        ]
                    })
                }
            } catch (error) {
                console.log('error -> ', error)
            }
        }  
    }, 
    data: () => {
        return {
            events: [], 
            attrs: [{
                    key: 'today',
                    highlight: true,
                    dates: new Date(),
                },], 
        }
    }
}
</script>

<style>
    
</style>
