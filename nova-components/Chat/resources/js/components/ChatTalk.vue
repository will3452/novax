<template>
    <div id="talkjs-container" class="w-full" style="height:500px">
        <i>Loading chat...</i>
    </div>
</template>


<script>
import Talk from 'talkjs';
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

            axios.get('/nova-vendor/chat/get-user')
                .then((res)=>{
                    this.currentUser = res.data;
                    this.otherUser = res.data;
                    let photoUrlOther = this.otherUser.profile === null ? '/user.png' : '/' + this.otherUser.profile.picture.replace('public', 'storage');
                    if(this.otherUser.logo != null) {
                        photoUrlOther = "/" +this.otherUser.logo.replace('public', 'storage');
                    }

                    let photoUrlMe = this.currentUser.profile === null ? '/user.png' : '/' + this.currentUser.profile.picture.replace('public', 'storage');
                    if(this.currentUser.logo != null) {
                        photoUrlMe = "/" +this.currentUser.logo.replace('public', 'storage');
                    }

                    Talk.ready.then(()=>{
                        var me = new Talk.User({
                            id: this.currentUser.id,
                            name: this.currentUser.name,
                            email: this.currentUser.email,
                            photoUrl: photoUrlMe,
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
                            photoUrl: photoUrlOther,
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
                })
        }
    }
</script>
