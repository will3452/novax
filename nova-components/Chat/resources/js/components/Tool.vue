<template>
    <div>
        <div v-if="isAdmin">
            <select id="" v-model="currentPatient" @change="loadMessages">
                <option :value="p.id" v-for="p in myPatients" :key="p.id">
                    {{p.name}}
                </option>
            </select>
        </div>
        <div class="text-right">
            <button class="btn btn-secondary p-2 mt-4" @click="loadMessages">reload</button>
        </div>
        <div class="chat-pane" v-chat-scroll>
            <div class="chat" :class="{'you': me == m.sender_id, 'admin': me == m.receiver_id}" v-for="m in loadedMessages" :key="m.id">{{m.message}}
                <div class="time">{{Date.parse(m.created_at).toString('M/dd/yy hh:mm')}}</div>
            </div>
        </div>
        <p class="text-xs">{{message.length}}/{{maxMessage}}</p>
        <textarea v-model="message" name="" id="" cols="30" rows="10" class="w-full p-4"></textarea>
        <button class="bg-primary p-2 btn-send" @click="sendMessage">SEND</button>
    </div>
</template>

<script>
import axios from 'axios'
import datejs from 'datejs'
export default {
    metaInfo() {
        return {
          title: 'Chat',
        }
    },
    mounted() {
       this.loadPatients()
       this.loadMessages()
       this.loadMe()
    //    setInterval(() => {
    //      this.loadMessages()
    //      console.log('messages')
    //    }, 10000);
    },
    watch : {
        message (newVal, oldVal) {
            if (newVal.length === this.maxMessage) {
                this.message = oldVal
            }
        }
    },
    computed: {
        isAdmin () {
            return this.me == 1
        },
        myPatients() {
            return this.patients.filter( e => e.id != this.me)
        },
        loadedMessages () {
            return this.messages
        }
    },
    methods: {
        loadMessages () {
            this.$toasted.show('loading messages...')
            let query = ""
            if (this.isAdmin) {
                query += '?patient='+this.currentPatient
            }

            axios.get('/nova-vendor/chat/messages' + query)
            .then(({ data }) => {
                this.messages = data
                this.$toasted.show('message loaded!')
            })
        },
        loadMe () {
            axios.get('/nova-vendor/chat/me')
            .then(({data}) => {
                this.me = data
            })
        },
        loadPatients() {
            axios.get('/nova-vendor/chat/patients')
                .then(({data}) => {
                    this.patients = data
                })
        },
        sendMessage() {
            axios.post('/nova-vendor/chat/messages', {message: this.message, receiver: this.currentPatient || 1})
                .then (({data}) => {
                    this.$toasted.show('Message sent!')
                    this.messages.push(data)
                    this.message = ''
                })
        }
    },
    data () {
        return {
            me: 0,
            message: '',
            maxMessage: 200,
            messages: [],
            patients: [],
            currentPatient: null,
        }
    }
}
</script>

<style>
    .btn-send {
        color: #fff;
    }
    .chat-pane {
        height: 400px;
        overflow: auto;
    }
    .chat {
        padding: 0.5em;
        color: #fff;
        font-size: 14px;
        margin-bottom: 1em;
    }
    .you {

        background: #0A76B7;
        border-radius: 0.5em 0.5em 0em 0.5em !important;
    }
    .admin {
        background: #5A9D58;
        border-radius: 0.5em 0.5em 0.5em 0px !important;
    }
    .time {
        color: #fff;
        font-size: 10px;
    }
</style>
