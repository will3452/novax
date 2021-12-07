<template>
    <div>
        <heading class="mb-6">Write new post</heading>
        <label for="">Title</label>
        <input v-model="title" type="text" placeholder="Aa" class="shadow block w-full p-2 rounded mb-2">
        <label for="">Body</label>
        <textarea v-model="body" placeholder="Aa" class="shadow p-2 rounded block w-full mb-2"></textarea>
        <div class="text-right mt-2">
            <button class="btn btn-default btn-primary" @click="submitPost">
                Post
            </button>
        </div>
        <div>
            <div v-for="post in posts" class="card p-2 my-2">
                <div class="card-header font-bold flex justify-between">
                    {{post.title}}
                    <div>
                        <button class="btn btn-danger rounded" @click="deletePost(post.id)">
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                        </button>
                    </div>
                </div>
                <div class="card-body text-lg">
                    {{post.body}}
                </div>
            </div>
            <div v-if="isLoading">Loading ...</div>
            <div v-if="!posts.length && !isLoading">
                Empty post.
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    metaInfo() {
        return {
          title: 'Write post',
        }
    },
    data() {
        return {
            posts:[],
            isLoading:true,
            title:'',
            body:'',
        }
    },
    methods:{
        reset(){
            this.title = '';
            this.body = '';
        },
        submitPost() {
            axios.post('/nova-vendor/newsfeed/posts', {
                title:this.title,
                body:this.body
            }).then(res=>{
                if(res.status === 200) {
                    alert('post success!');
                    this.posts = res.data.posts;
                    this.reset();
                }
            }).catch(err=>{
                alert('something error!');
            })
        },
        deletePost(id){
            axios.delete('/nova-vendor/newsfeed/posts/' + id)
                .then(res=>{
                    if(res.status === 200) {
                    alert('post deleted!');
                        this.posts = res.data.posts;
                    this.reset();
                }
                })
        }
    },
    mounted() {
        axios.get('/nova-vendor/newsfeed/posts')
            .then(res=>{
                this.posts = res.data.posts;
                this.isLoading = false;
            })
            .catch(err=>{
                this.isLoading = false;
            })
    },
}
</script>

<style>
/* Scoped Styles */
</style>
