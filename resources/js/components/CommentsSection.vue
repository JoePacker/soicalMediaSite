<template>
    <div class="comments-section">
        <h2>Comments</h2>

        <p v-if="!comments.length">There are no comments to display</p>

        <div class="card" v-for="comment in comments" :key="comment.id">
            <div class="card-header">
                <a :href="route('profile.show', {profile: comment.user.profile})">{{ comment.user.name }}</a>
                <span>{{ comment.created_at }}</span>
            </div>

            <div class="card-body">
                <p>{{ comment.body }}</p>
            </div>
        </div>

        <div v-if="canAddComment" class="add-comment-form">
            <p>Add a comment</p>
            <textarea v-model="comment" placeholder="What would you like to say?"></textarea>
            <button class="btn btn-primary" @click="addComment">Submit</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: true
            },
            canAddComment: {
                type: Boolean
            }
        },

        data() {
            return {
                comments: [],
                comment: ''
            }
        },

        methods: {
            addComment() {
                axios.post(route('comments.store', {post: this.post}), {
                    comment: this.comment,
                    api_token: document.querySelector('meta[name="api-token"]').getAttribute('content')
                })
                    .then(response => {
                        this.comments.push(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },

        mounted() {
            axios.get(route('comments.index', {post: this.post}))
                .then(response => {
                    this.comments = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
</script>
