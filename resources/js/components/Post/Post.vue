<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">{{ post.title}}</h1>
                <p class=""><span class="badge badge-primary"> Auteur : {{ post.user.name }}</span> - Publié le {{ post.created_at | formatDate }}</p>
                <img src="https://fakeimg.pl/250x100" class="img-fluid w-100" alt="...">
                <p>{{ post.content }}</p>

                <comment-form :success="success" :errors="errors" @add-comment="addComment"></comment-form>
                <hr>
                <h2>Commentaires</h2>
                <comment v-for="comment in comments.data"
                         :comment="comment" :key="comment.id"
                         :success-report="successReport"
                         @report-comment="reportComment"
                ></comment>

                <pagination :data="comments" @pagination-change-page="getComments" align="center"></pagination>

            </div>
        </div>
    </div>

</template>

<script>
    import Comment from '../Comment/Comment.vue';
    import CommentForm from '../Comment/CommentForm.vue';

    export default {
        name: "Post",
        props: {
            post: {
                type: Object,
                required: true
            },
            dataComments: {
                type: Object,
                required: true
            }
        },
        components: {
            Comment,
            CommentForm
        },
        data() {
            return {
                comments: this.dataComments,
                apiCommentStoreUrl: this.route('api.comment.store', { post: this.post.id }),
                apiCommentGetUrl: this.route('api.comment.index', { post: this.post.id }),
                success: null,
                errors: {
                    errorsName: null,
                    errorsContent: null
                },
                successReport: null
            }
        },
        methods: {
            addComment(payload) {
                axios.post(this.apiCommentStoreUrl, payload)
                    .then(result => {
                        this.comments.data.unshift(result.data.comment);
                        this.success = result.data.message;
                        this.reset();
                    })
                    .catch(error => {
                        this.errors.errorsName = error.response.data.errors.name ?? null;
                        this.errors.errorsContent = error.response.data.errors.content ?? null;
                    })
            },
            reset() {
                this.errors.errorsName = null;
                this.errors.errorsContent = null;

                setTimeout(() => {
                    this.success = null;
                    this.successReport = null;
                }, 4000);
            },
            getComments(page = 1) {
                axios.get(`${this.apiCommentGetUrl}?page=${page}`)
                    .then(result => this.comments = result.data)
            },
            reportComment(payload) {
                axios.get(payload.urlApi)
                    .then(result => {
                        this.successReport = {
                            message: result.data.message,
                            commentId: payload.commentId
                        };
                        this.reset(this.successReport);
                    })
            }
        }
    }
</script>

<style>
    img + p {
        margin-top: 15px;
    }

    h1 + p {
        font-size: 1.4em;
    }
</style>
