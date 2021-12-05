<template>
    <div id="talkjs-container" style="width: 90%; margin: 30px; height: 500px">
        <i>Loading chat...</i>
    </div>
</template>


<script>

    export default {
        name: 'Inbox',
        props: ['user', 'other'],
        data() {
            return {
                currentUser:{},
                otherUser:{},
            }
        },
        mounted(){
            this.currentUser = JSON.parse(this.user);
            this.otherUser = JSON.parse(this.other);
            console.log(this.currentUser);
            Talk.ready.then(()=>{
                var me = new Talk.User({
                    id: this.currentUser.id,
                    name: this.currentUser.name,
                    email: this.currentUser.email,
                    photoUrl: this.currentUser.profile === null ? '/user.png' : '/' + this.currentUser.profile.picture.replace('public', 'storage'),
                    welcomeMessage: "Hey there! How are you? :-)",
                    role: "default"
                });

                window.talkSession = new Talk.Session({
                    appId: 't3NuQKnX',
                    me: me,
                });

                var other = new Talk.User({
                    id: this.otherUser.id,
                    name: this.otherUser.name,
                    email: this.otherUser.email,
                    photoUrl: this.otherUser.profile === null ? '/user.png' : '/' + this.otherUser.profile.picture.replace('public', 'storage'),
                    welcomeMessage: 'Hey there! How are you? :-)',
                    role: 'default',
                    });

                    var conversation = talkSession.getOrCreateConversation(
                        Talk.oneOnOneId(me, other)
                        );

                    conversation.setParticipant(me);
                    conversation.setParticipant(other);
                    var inbox = talkSession.createInbox({ selected: conversation });
                    inbox.mount(document.getElementById('talkjs-container'));
            })
        }
    }
</script>
