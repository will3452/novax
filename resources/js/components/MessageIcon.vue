<template>
    <a class="btn btn-square btn-ghost" href="/chat?">
        <div class="badge badge-xs" v-if="number">
        </div>
            <span class="material-icons">
                chat
            </span>
    </a>
</template>


<script>
    export default {
        props:['user'],
        data() {
            return {
                number: 0,
            }
        },

        mounted() {
            this.currentUser = JSON.parse(this.user);
            Talk.ready.then(()=>{
                var me = new Talk.User({
                    id: this.currentUser.id,
                    name: this.currentUser.name,
                    email: this.currentUser.email,
                    photoUrl: this.currentUser.photo,
                    welcomeMessage: "Hey there! How are you? :-)",
                    role: "default"
                });

                window.talkSession = new Talk.Session({
                    appId: 't3NuQKnX',
                    me:me,
                });
                window.talkSession.unreads.on('change',  (unreadConversations) => {
                    this.number = unreadConversations.length;
                });

            });

        }

    }
</script>
