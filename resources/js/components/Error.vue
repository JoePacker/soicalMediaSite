<template>
    <div class="error">
        <div class="alert alert-danger" role="alert">
            <span>{{ message }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            message: {
                type: String,
                required: true
            }
        }
    }
</script>
