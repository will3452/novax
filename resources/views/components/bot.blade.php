<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>
<div class="fixed right-1 md:right-5 bottom-5"  id="app">
    <a class="block" @click.prevent="showChat = !showChat">
        <img src="/bot.png" class="animate-bounce  cursor-pointer w-[75px]" v-if="! showChat" alt="">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" v-else class="bg-white p-4 rounded-full w-[50px] border shadow-md mb-2 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
    </a>
    <div v-if="showChat" class="bg-gray-100 border shadow md:w-[450px] h-[80vh] md:h-[50vh] bottom-0 right-0 p-4 overflow-y-auto space-y-4" ref="container">
        <div v-for="message in messages" :key="message.id">
            <div v-if="message.from == 'bot'" class="mb-2 bg-green-600 text-white p-2" style="border-radius:0px 20px 20px 20px;" v-html="message.message">
            </div>
            <div v-if="message.from == 'you'" class="mb-2 bg-blue-900 text-white p-2" style="border-radius:20px 20px 0px 20px;" v-html="message.message">
            </div>
            <div class="flex flex-wrap gap-2" v-if="message.from == 'bot' && ! hides.includes(message.message)">
                <button @click="sendMessage(q, message.message)" v-if="q" :key="`${message}-${q}`" v-for="q in message.questions" class="text-green-600 border border-green-600 p-2 flex items-center">
                    @{{q}} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[20px] text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                      </svg>
                </button>
                <button v-if="message.questions.length == 0" @click="getMessages(false)" class="text-green-600 border border-green-600 p-2 flex items-center">
                     New Conversation <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[20px] text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                      </svg>
                </button>
            </div>
        </div>
        <img v-if="loading" style="width:50px;" src="/typing-dots.gif" alt="">
    </div>
</div>
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                message:'hello world',
                showChat: false,
                messages: [],
                hides: [],
                text: '',
                loading: false,
            }
        },
        mounted() {
            this.getMessages();
        },
        methods: {
            async getMessages(question = false) {
                try {
                    this.loading = true
                    let response = null;
                    if (! question) {
                        this.messages = [];
                        this.hides = [];
                        response = await fetch('/api/get-message')
                    } else {
                        response = await fetch(`/api/get-message?q=${question}`)
                    }

                    let data = await response.json()
                    this.messages.push(data);
                } catch (error) {
                    console.log('error -> ', error)
                } finally {
                    this.loading = false
                }
            },
            async sendMessage(q, message) {
                this.hides.push(message)
                this.text = q;
                if (! this.text.length) {
                    alert('please enter message.')
                    return;
                }
                this.messages.push({
                    id: Date.now(),
                    from: 'you',
                    message: this.text,
                });

                await this.getMessages(this.text)
                this.text = '';
                this.$refs['container'].scrollTop = this.$refs['container'].scrollHeight;
            },
        },
    })
</script>
