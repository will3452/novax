<template>
    <div>
        <card class="p-4">
            <div class="flex border-b border-40 -mx-6 px-6">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Name</h4>
                </div>
                <div class="w-3/4 py-4 break-words">
                    <p class="text-90">
                        {{ currentRoom.name }}
                    </p>
                </div>
            </div>
            <div class="flex border-b border-40 -mx-6 px-6">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Description</h4>
                </div>
                <div class="w-3/4 py-4 break-words">
                    <p class="text-90" v-html="currentRoom.description">
                    </p>
                </div>
            </div>
            <div class="flex border-b border-40 -mx-6 px-6">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Instructor</h4>
                </div>
                <div class="w-3/4 py-4 break-words">
                    <p class="text-90" v-html="currentRoom.user.name">
                    </p>
                </div>
            </div>
            <div class="flex border-b border-40 -mx-6 px-6">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Lectures</h4>
                </div>
                <div class="w-3/4 py-4 break-words">
                    <ul>
                        <li v-for="lecture in currentRoom.lectures" :key="lecture.id" class="flex justify-between items-center">
                            <div>{{ lecture.title }}</div> <button class="btn btn-default btn-primary hover:bg-primary-dark" @click="viewLecture(lecture)">View</button>
                        </li>
                    </ul>
                </div>
            </div>
        </card>
    </div>
</template>

<script>
export default {
    created() {
        this.currentRoom = this.$store.state.room;
        if (Object.keys(this.currentRoom).length == 0) {
            this.$toasted.error('Room not found.');
            this.$router.push('/virtual-room');
        }
    },
    methods: {
        viewLecture(lecture) {
            this.$store.state.lecture = lecture;
            this.$router.push('/lecture');
        }
    },
    data() {
        return {
            currentRoom: {},
        }
    }
}
</script>
