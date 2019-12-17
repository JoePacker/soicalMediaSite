<template>
    <div class="comment">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-7">
                        <a :href="route('profile.show', {profile: comment.user.profile})">{{ comment.user.name }}</a>
                        <span>{{ comment.created_at }}</span>
                    </div>
                    <div class="col-5">
                        <div class="float-right">
                            <div v-if="isEditing">
                                <button class="btn btn-primary" @click="updateComment">Update</button>
                                <button class="btn btn-danger" @click="cancelComment">Cancel</button>
                            </div>
                            <div v-else>
                                <button
                                    v-if="can('edit_any_comment') || (can('edit_own_comment') && user.id === comment.user_id)"
                                    class="btn btn-primary" @click="isEditing = true">Edit
                                </button>
                                <button
                                    v-if="can('delete_any_comment') || (can('delete_own_comment') && user.id === comment.user_id)"
                                    class="btn btn-danger" @click="deleteComment">Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <error v-for="(error, index) in errors" :key="index" :message="error"></error>

                <textarea v-if="isEditing" v-model="body" class="form-control" rows="3"></textarea>
                <p v-else>{{ comment.body }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            comment: {
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
                isEditing: false,
                body: this.comment.body
            }
        },

        methods: {
            updateComment() {
                axios.put(route('comments.update', {comment: this.comment}), {
                    body: this.body,
                    api_token: document.querySelector('meta[name="api-token"]').getAttribute('content')
                })
                    .then(response => {
                        this.comment.body = this.body;

                        this.$emit('comment-updated', {
                            comment: this.comment
                        });

                        this.isEditing = false;
                        this.errors = [];
                    })
                    .catch(error => {
                        this.errors = Object.values(error.response.data.errors).flat();
                    });
            },
            cancelComment() {
                this.isEditing = false;
                this.body = this.comment.body;
                this.errors = [];
            },
            deleteComment() {
                axios.delete(route('comments.destroy', {comment: this.comment}), {
                    data: {api_token: document.querySelector('meta[name="api-token"]').getAttribute('content')}
                })
                    .then(response => {
                        this.$emit('comment-deleted', {
                            comment: this.comment
                        });
                    })
                    .catch(error => {
                        this.errors = [error.response.data.message];
                    });
            }
        }
    }
</script>
