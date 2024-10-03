<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .ConversationListHeader__conversation-list-header {
            display: none !important;
        }
    </style>
</head>
<body>
    <!-- container element in which TalkJS will display a chat UI -->
<div id='talkjs-container' class="w-screen h-screen">
    <i>Loading chat...</i>
  </div>
    <!-- minified snippet to load TalkJS without delaying your page -->
<script>
    (function(t,a,l,k,j,s){
    s=a.createElement('script');s.async=1;s.src='https://cdn.talkjs.com/talk.js';a.head.appendChild(s)
    ;k=t.Promise;t.Talk={v:3,ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l
    .push([f])},catch:function(){return k&&new k()},c:l}};})(window,document,[]);
</script>

<script>
    Talk.ready.then(function () {
    const me = new Talk.User({
        id: '{{$user->email}}',
        name: '{{$user->name}}',
        email: '{{$user->email}}',
        photoUrl: 'https://ui-avatars.com/api/?background=random&name={{$user->name}}',
        welcomeMessage: 'Hi!',
    });

    const session = new Talk.Session({
        appId: 't3NuQKnX',
        me: me,
    });

const inbox = session.createInbox();
  inbox.mount(document.getElementById('talkjs-container'));
});

</script>
</body>
</html>
