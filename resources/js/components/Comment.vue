<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ comment.name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ comment.created_at }}</h6>
            <p class="card-text">{{ comment.content }}</p>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Comment",
        props: {
            comment: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
