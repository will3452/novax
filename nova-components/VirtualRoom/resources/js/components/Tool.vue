<template>
    <div>
        <heading class="mb-6">Virtual Room</heading>
        {{ user }}
        <div>
            <input type="text" v-model="payload.name" class="form-control form-input form-input-bordered" placeholder="Enter Room Name">
            <input type="password"  v-model="payload.code" class="form-control form-input form-input-bordered"  placeholder="Enter Room Code">
            <button @click="joinRoom" class=" btn btn-default btn-primary hover:bg-primary-dark">PROCEED</button>
        </div>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
          title: 'VirtualRoom',
        }
    },
    mounted() {
    },
    data() {
        return {
            payload: {},
        }
    },
    methods: {
        async joinRoom() {
           try {
                let response = await window.axios.post('/join-room', this.payload);
                this.$store.state.room = response.data;
                this.$router.push('/view-lecture');
           } catch (error) {
                this.$toasted.error('Room not found or incorrect code. please contact your instructor.')
           }
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
