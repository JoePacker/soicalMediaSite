<template>
    <div class="comments-section">
        <h2>Comments</h2>

        <div v-if="can('create_comment')" class="add-comment-form">
            <p>Add a comment</p>

            <error v-for="(error, index) in errors" :key="index" :message="error"></error>

            <textarea v-model="body" rows="3" cols="50" placeholder="What would you like to say?"></textarea>
            <button class="btn btn-primary" @click="addComment">Add</button>
        </div>

        <p v-if="!comments.length">There are no comments to display</p>

        <comment v-for="comment in comments"
                 :key="comment.id"
                 :comment="comment"
                 :user="user"
                 @comment-updated="updateComment($event)"
                 @comment-deleted="deleteComment($event)">
        </comment>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: true
            },
            user: {
                type: Object
            }
        },

        data() {
            return {
                errors: [],
                comments: [],
                body: ''
            }
        },

        methods: {
            addComment() {
                axios.post(route('comments.store', {post: this.post}), {
                    body: this.body,
                    api_token: document.querySelector('meta[name="api-token"]').getAttribute('content')
                })
                    .then(response => {
                        this.comments.unshift(response.data);
                        this.body = '';
                        this.errors = [];
                    })
                    .catch(error => {
                        this.errors = Object.values(error.response.data.errors).flat();
                    });
            },
            updateComment($event) {
                this.comments.forEach((comment, index) => {
                    if (comment.id === $event.comment.id) {
                        this.comments[index] = $event.comment;
                    }
                });
            },
            deleteComment($event) {
                this.comments = this.comments.filter(c => c.id !== $event.comment.id);
            }
        },

        mounted() {
            axios.get(route('comments.index', {post: this.post}))
                .then(response => {
                    this.comments = response.data;
                })
                .catch(error => {
                    this.errors = [error.response.data.message];
                });
        }
    }
</script>
