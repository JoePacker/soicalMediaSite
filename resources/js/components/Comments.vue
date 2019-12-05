<template>
    <div class="comments-section">
        <div class="card" v-for="comment in comments" :key="comment.id">
            <div class="card-header">
                <a :href="route('profile.show', {profile: comment.user.profile})">{{ comment.user.name }}</a>
                <span>{{ comment.created_at }}</span>

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
            }
        },

        data: function () {
            return {
                comments: []
            }
        },

        mounted() {
            console.log(this.post);

            axios.get('/api/posts/' + this.post.id + '/comments')
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
