<template>
    <div class="flex relative">
        <div v-if="selectedDate" class="mx-2 fixed w-6/12 z-50 top-20 right-20">
                <card class="p-4 bg-white border">
                    <button @click="selectedDate = null" class="block absolute rotate-45 bg-red-500 flex items-center justify-center rounded-full shadow-lg border w-10 h-10 font-bold text-white text-xl -right-4 -top-4">
                        +
                    </button>
                    <div class="flex items-center justify-between">
                        <h1 class="text-lg font-bold">Bookings <small class="text-sm">({{numberOfBooksToday}})</small></h1>
                        <div class="text-sm">
                            {{selectedDate}}
                        </div>
                    </div>
                    <ul class="w-full">
                        <book-item v-for="book in selectedBooks" :key="book.title" :book="book">
                             <p class="flex justify-between items-center">
                                <span>
                                    Reference #
                                </span>
                                <span class="p-2 text-sm rounded">
                                    {{book.reference_number}}
                                </span>
                            </p>
                            <p class="flex justify-between items-center">
                                <span>
                                    Customer Name
                                </span>
                                <span class="p-2 text-sm rounded">
                                    {{book.customer_name}}
                                </span>
                            </p>
                        </book-item>
                        <div v-if="!selectedBooks.length" class="w-100 p-2 rounded justify-center items-center text-center bg-gray-200 text-gray-500 font-bold">
                            No Booking to show
                        </div>
                    </ul>
                </card>
            </div>
        <div class="mx-2">
            <card class="p-4 w-full">
                <v-calendar v-if="!isLoading"
                :data-source="bookings"
                @click-day="clickDayHandler"
                ></v-calendar>
            </card>
        </div>
    </div>
</template>


<script>
import Calendar from 'v-year-calendar';
import BookItem from './BookItem.vue';
export default {
    metaInfo() {
        return {
            title:'Booking Title'
        }
    },
    mounted() {
        Nova.request().get('/nova-vendor/booking-calendar/get-approved-bookings')
            .then(res=>{
                this.isLoading = false;
                this.bookings = res.data;
                this.bookings.map(e=>{
                    e.startDate = new Date(e.startDate);
                    e.endDate = new Date(e.endDate);

                    return e;
                })
                console.log(this.bookings);
            })
    },
    data() {
        return {
            isLoading: true,
            selectedBooks: [],
            selectedDate:null,
            bookings: []
        }
    },
    methods:{
        clickDayHandler(e){
            this.selectedDate = e.date.toLocaleString().split(',')[0];
            this.selectedBooks = e.events;
        }
    },
    computed: {
        numberOfBooksToday(){
            return this.selectedBooks.length
        },
    },
    components: {
        'v-calendar':Calendar,
        BookItem,
    }
}
</script>
