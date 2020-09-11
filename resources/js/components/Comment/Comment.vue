<template>
    <div :class="{'ml-5': parentComment}">
        <div class="card">
            <div v-if="successReport && successReport.commentId === comment.id" class="alert alert-warning">
                {{ successReport.message }}
            </div>
            <div class="card-body">
                <h4 v-if="parentComment">En réponse à {{ parentComment.name }}</h4>
                <h5 class="card-title">{{ comment.name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ comment.created_at }}</h6>
                <p class="card-text">{{ comment.content }}</p>
                <button class="btn btn-secondary" @click="emitReport(comment)">Signaler le commentaire</button>
            </div>
        </div>

        <comment v-for="children in comment.children"
                     :key="children.id"
                     :comment="children"
                     :success-report="successReport"
                     :parent-comment="comment"
                     @report-comment="emitReport(children)"
                    ></comment>
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
            },
            parentComment: {
                type: Object
            }
        },
        methods: {
            emitReport(comment) {
                this.$emit('report-comment', {
                    urlApi: this.route('api.comment.report', {comment: comment.id}),
                    commentId: comment.id
                });
            }
        }
    }
</script>

<style scoped>

</style>
