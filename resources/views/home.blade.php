@extends('layouts.app')

@section('content')
<div class="container">
    <!-- container element in which TalkJS will display a chat UI -->
    <div id="talkjs-container" style="width: 90%; margin: 30px; height: 500px">
      <i>Loading chat...</i>
    </div>
</div>
<!-- minified snippet to load TalkJS without delaying your page -->
<script>
    async function initTalk() {
        await Talk.ready;
        const me = new Talk.User({
            id: 'tourism-user-{{auth()->id()}}',
            name: '{{auth()->user()->name}}',
            email: '{{auth()->user()->email}}',
            photoUrl: '/user.png',
        });
        const session = new Talk.Session({
        appId: 'tZZgyI83',
        me: me,
        });
        let otherUserFromDb = @json(\App\Models\User::first()); 
        console.log(otherUserFromDb); 
        const other = new Talk.User({
            id: `tourism-user-${otherUserFromDb.id}`,
            name: 'System Administrator',
            email: otherUserFromDb.email,
            photoUrl: '/logo.png',
            welcomeMessage: 'Hey, how can I help?',
        });

        const conversation = session.getOrCreateConversation(
        Talk.oneOnOneId(me, other)
        );
        conversation.setParticipant(me);
        conversation.setParticipant(other);

        const inbox = session.createInbox();
        inbox.select(conversation);
        inbox.mount(document.getElementById('talkjs-container'));
    }
    window.onload = initTalk
</script>
@endsection
