<template>
    <div class="comments-section">
        <h2>Comments</h2>

        <p v-if="!comments.length">There are no comments to display</p>

        <div class="card" v-for="comment in comments" :key="comment.id">
<!--            <div class="card-header">-->
<!--                <a :href="route('profile.show', {profile: comment.user.profile})">{{ comment.user.name }}</a>-->
<!--                <span>{{ comment.created_at }}</span>-->
<!--            </div>-->

            <div class="card-body">
                <p>{{ comment.body }}</p>
            </div>
        </div>

        <p>Add a comment</p>
        <textarea v-model="comment" placeholder="What would you like to say?"></textarea>
        <button class="btn btn-primary" @click="addComment">Submit</button>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: true
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
                console.log('add comment!');

                axios.post(route('comments.store', {post: this.post}), {comment: this.comment})
                    .then(response => {
                        this.comments.push(response.data);
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },

        mounted() {
            console.log(this.post);

            axios.get(route('comments.index', {post: this.post}))
                .then(response => {
                    this.comments = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
</script>
