<template>
    <div class="comments-section">
        <h2>Comments</h2>

        <div v-if="can('create_comment')" class="add-comment-form">
            <p>Add a comment</p>
            <textarea v-model="comment" placeholder="What would you like to say?"></textarea>
            <button class="btn btn-primary" @click="addComment">Submit</button>
        </div>

        <div v-if="errors" class="alert alert-danger" role="alert">
            <p v-for="error in errors">{{ error }}</p>
        </div>

        <p v-if="!comments.length">There are no comments to display</p>

        <div class="card" v-for="comment in comments" :key="comment.id">
            <div class="card-header">
                <a :href="route('profile.show', {profile: comment.user.profile})">{{ comment.user.name }}</a>
                <span>{{ comment.created_at }}</span>
                <button v-if="can('edit_any_comment') || (can('edit_own_comment') && user.id === comment.user_id)"
                        class="btn btn-info" @click="editComment(comment)">Edit
                </button>
                <button v-if="can('delete_any_comment') || (can('delete_own_comment') && user.id === comment.user_id)"
                        class="btn btn-danger" @click="deleteComment(comment)">Delete
                </button>
            </div>

            <div class="card-body">
                <p>{{ comment.body }}</p>
            </div>
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
            user: {
                type: Object
            }
        },

        data() {
            return {
                errors: null,
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
                        this.comments.unshift(response.data);
                        this.comment = '';
                    })
                    .catch(error => {
                        this.errors = Object.values(error.response.data.errors).flat();
                    });
            },
            editComment(comment) {
                console.log('edit comment ' + comment.id);
            },
            deleteComment(comment) {
                axios.delete(route('comments.destroy', {comment: comment}), {
                    data: {api_token: document.querySelector('meta[name="api-token"]').getAttribute('content')}
                })
                    .then(response => {
                        this.comments = this.comments.filter(c => c.id !== comment.id);
                    })
                    .catch(error => {
                        this.errors = [error.response.data.message];
                    });
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
