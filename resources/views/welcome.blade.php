@extends('layouts.app')
@section('content')
    <x-bot />
    <div style="background:url('/pexels-fr3nks-305568.jpg'); background-size:cover; background-repeat: no-repeat;padding:2em 0px;">
        <div class="container row mx-auto align-items-center">
            <div class="p-4 col-md-6">
                <h1 class="text-primary display-1" style="font-weight: 900; text-shadow:0px 0px 10px #fff;">{{nova_get_setting('name', 'JOYCE DENTAL SPA CLINIC')}}</h1>
                <h2 style=" text-shadow:0px 0px 10px #fff;" class="display-3">Your Smile Says It All</h2>
                <a class="btn btn-warning mt-4 btn-lg" href="/home">Book an Appointment!</a>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Clinic Calendar
                    </div>
                    <div class="card-body">
                        <v-calendar  :attributes="attributes" :min-date='new Date()'  is-expanded></v-calendar>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <h1 class="">About us</h1>
        <p class="">
            {{nova_get_setting('about', '---')}}
        </p>
        <hr>
        <h1 class="">Our Services</h1>
        <div class="row g-2">
            @forelse (\App\Models\Service::get() as $item)
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="/storage/{{$item->image}}" alt="Card image cap">
                    <div class="card-body">
                        <h5>
                            {{$item->name}}
                        </h5>
                        <p>{{\Str::limit($item->description, 100)}}</p>
                        <a href="/home?service={{$item->name}}" class="btn btn-primary">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <div class="alert alert-secondary">No Service Available</div>
            @endforelse
        </div>
    </div>
    <script>
        new Vue({
            el: '#app',
            data () {
                return {
                    noSlots: [],
                    message:'hello world',
                    showChat: false,
                    messages: [],
                    hides: [],
                    text: '',
                    loading: false,
                }
            },
            computed: {
                disabledDates() {
                    return this.noSlots.map( e => ({dates: e, bar: 'red'}))
                },
                attributes () {
                    return [...this.disabledDates, ]
                }
            },
            async mounted() {
                let response = await fetch('/api/fully-booked');
                let data = await response.json()
                this.noSlots = data;

                this.getMessages();
            },
            methods: {

            showChatHandler() {
                this.showChat = ! this.showChat;
            },
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
            }
        })
    </script>

@endsection
