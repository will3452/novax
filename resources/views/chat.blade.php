@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <img src="/bot.png" style="width:25px; " alt=""> {{ __('Chatbot') }}
                    </div>
                </div>

                <div class="card-body">
                    <div >
                        <div v-for="message in messages" :key="message.id">
                            <div v-if="message.from == 'bot'" class="mb-2 bg-primary text-white p-2" style="border-radius:0px 20px 20px 20px;" v-html="message.message">
                            </div>
                            <div v-if="message.from == 'you'" class="mb-2 bg-secondary text-white p-2" style="border-radius:20px 20px 0px 20px;" v-html="message.message">
                            </div>
                        </div>
                        <img v-if="loading" style="width:50px;" src="/typing-dots.gif" alt="">
                    </div>
                    <div class="d-flex justify-content-between">
                        <textarea v-model="text" id="" class="form-control" placeholder="Enter custom message here"></textarea>
                        <button class="btn" @click="sendMessage">Send</button>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-success" @click="getMessages('SHOW_CATEGORIES')">Show me categories</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: '#app',
        methods: {
            async getMessages(question = false) {
                try {
                    this.loading = true
                    let response = null;
                    if (! question) {
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
            async sendMessage() {
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
            },
        },
        async mounted() {
            this.getMessages()
        },
        data: {
            loading: false,
            text: '',
            messages: [
            ],
        }
    })
</script>
@endsection
