<template>
    <div class="card">
        <div v-if="successReport && successReport.commentId === comment.id" class="alert alert-warning">
            {{ successReport.message }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ comment.name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ comment.created_at }}</h6>
            <p class="card-text">{{ comment.content }}</p>
            <button class="btn btn-secondary" @click="emitReport">Signaler le commentaire</button>
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
            },
            successReport: {
                type: Object
            }
        },
        methods: {
            emitReport() {
                this.$emit('report-comment', {
                    urlApi: this.route('api.comment.report', {comment: this.comment.id}),
                    commentId: this.comment.id
                });
            }
        }
    }
</script>

<style scoped>

</style>
