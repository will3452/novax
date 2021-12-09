<template>
    <div>
        <heading class="mb-6">Chat</heading>
        <chat-talk/>
    </div>
</template>

<script>
import ChatTalk from './ChatTalk.vue';

export default {
    metaInfo() {
        return {
          title: 'Chat',
        }
    },
    components: {
        ChatTalk,
    },
    mounted() {

    },
}
</script>

<style>
/* Scoped Styles */
</style>
