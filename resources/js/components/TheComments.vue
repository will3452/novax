<template>
    <div>
        <div class="d-flex align-items-center">
            <h5>Comments</h5>
            <button @click="_showComments" class="btn btn-link" v-if="! showComments">
                <i class="fa fa-eye"></i>
            </button>
            <button @click="_hideComments" class="btn btn-link" v-if="showComments">
                <i class="fa fa-eye-slash"></i>
            </button>
        </div>

        <div v-if="showComments" v-for="comment in comments" :key="comment.id">
            <div class="media">
                <div class="media-body">
                    <h5 class="mt-0">{{comment.user.name}} <span style="font-size:8px;">{{ moment(comment.created_at).fromNow() }}</span> </h5>
                    <p> {{ comment.content }}</p>
                </div>
            </div>
        </div>

        <div class="alert alert-secondary" v-if="comments.length == 0 && showComments">
            No comment found.
        </div>

        <form action="" @submit.prevent="submit">
            <small>{{ content.length }} / {{ limit }}</small>
            <div class="row">
                <div class="col-md-8">
                    <textarea name="content" class="form-control" placeholder="Leave comment here" v-model="content"></textarea>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary mt-2">
                        <i class="fa fa-check-square-o"></i>
                        Submit Comment
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
import moment from 'moment';
export default {
    name: 'comment-form',
    props: ['postId', 'userId'],
    data () {
        return {
            showComments: false,
            content: '',
            limit:120,
            comments: [],
        };
    },
    mounted() {

    },
    methods: {
    moment,
    _showComments() {
        this.loadComments();
        this.showComments = true;
    },
    _hideComments () {
        this.showComments = false;
    },
    async submit () {
            try {
                if (this.content.length == 0) {
                    throw new Error('Please enter your comment.');
                }
                let payload = {content: this.content, commentable_type: '\\App\\Models\\Post', commentable_id: this.postId}
                let response = await axios.post('/ajax/comments', payload)
                this._showComments()
            } catch (error) {
                alert('Something went wrong!');
            } finally {
                this.content = '';
            }
        },
        async loadComments () {
            let { data } = await axios.get('/ajax/comments?type=\\App\\Models\\Post&id=' + this.postId);
            this.comments = data;
        },
    },
     watch: {
        content () {
            if (this.content.length > this.limit) {
                this.content = this.content.substring(0, this.limit);
            }
        }
     }
}
</script>
