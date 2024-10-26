
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
<div class="fixed-position" id="app-bot">
    <a  @click.prevent="showChatHandler">
        <img src="/bot.png" class="bouncing-pointer" v-if="! showChat" alt="">
    </a>
    <div v-if="showChat" class="custom-box" ref="container">
        <button @click.prevent="showChatHandler" class="btn btn-danger mb-2">Close Chat</button>
        <div v-for="message in messages" :key="message.id">
            <div v-if="message.from == 'bot'" class="green-button" style="border-radius:0px 20px 20px 20px;" v-html="message.message">
            </div>
            <div v-if="message.from == 'you'" class="blue-button" style="border-radius:20px 20px 0px 20px;" v-html="message.message">
            </div>
            <div class="flex-wrap-container" v-if="message.from == 'bot' && ! hides.includes(message.message)">
                <button @click="sendMessage(q, message.message)" v-if="q" :key="`${message}-${q}`" v-for="q in message.questions" class="green-border-box">
                    @{{q}} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="green-text-box">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                      </svg>
                </button>
                <button v-if="message.questions.length == 0" @click="getMessages(false)" class="green-border-box">
                     New Conversation <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="green-text-box">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                      </svg>
                </button>
            </div>
        </div>
        <img v-if="loading" style="width:50px;" src="/typing-dots.gif" alt="">
    </div>
</div>
