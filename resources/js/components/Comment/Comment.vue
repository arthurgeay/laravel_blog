<template>
    <div :class="{'ml-5': parentComment}">
        <div class="card">
            <div v-if="successReport && successReport.commentId === comment.id" class="alert alert-warning">
                {{ successReport.message }}
            </div>
            <div class="card-body">
                <h4 v-if="parentComment" class="text text-primary">En réponse à {{ parentComment.name }}</h4>
                <h5 class="card-title">{{ comment.name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ comment.created_at }}</h6>
                <p class="card-text">{{ comment.content }}</p>
                <button class="btn btn-primary" @click="onReply">Répondre</button>
                <button class="btn btn-secondary" @click="emitReport(comment)">Signaler le commentaire</button>
            </div>
        </div>

        <comment-form v-if="reply"
                      :success="successChildComment"
                      :errors="errorsChildComment"
                      :parent-comment="comment"
                      @add-comment="emitAddChildComment"
                      class="ml-4"></comment-form>

        <comment v-for="children in comment.children"
                     :key="children.id"
                     :comment="children"
                     :success-report="successReport"
                     :parent-comment="comment"
                     :success-child-comment="successChildComment"
                     :errors-child-comment="errorsChildComment"
                     @report-comment="emitReport(children)"
                     @add-child-comment="emitAddChildComment"
                    ></comment>
    </div>



</template>

<script>
    import CommentForm from "./CommentForm";
    export default {
        name: "Comment",
        components: {CommentForm},
        props: {
            comment: {
                type: Object,
                required: true
            },
            successReport: {
                type: Object
            },
            successChildComment: {
                type: String
            },
            errorsChildComment: {
                type: Object
            },
            parentComment: {
                type: Object
            }
        },
        data() {
            return {
                reply: false
            }
        },
        methods: {
            emitReport(comment) {
                this.$emit('report-comment', {
                    urlApi: this.route('api.comment.report', {comment: comment.id}),
                    commentId: comment.id
                });
            },
            onReply() {
                this.reply = !this.reply;
            },
            emitAddChildComment(payload) {
                this.$emit('add-child-comment', payload);
            }
        },
    }
</script>

<style scoped>

</style>
