<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">{{ post.title}}</h1>
                <p class=""><span class="badge badge-primary"> Auteur : {{ post.user.name }}</span> - Publié le {{ post.created_at | formatDate }}</p>
                <img src="https://fakeimg.pl/250x100" class="img-fluid w-100" alt="...">
                <p>{{ post.content }}</p>

                <comment-form :success="successComment" :errors="errorsComment" @add-comment="addComment"></comment-form>
                <hr>
                <h2>Commentaires</h2>
                <comment v-for="comment in comments.data"
                         :comment="comment" :key="comment.id"
                         :success-child-comment="successComment"
                         :errors-child-comment="errorsComment"
                         @add-child-comment="addComment"
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
                successComment: null,
                errorsComment: {
                    errorsName: null,
                    errorsContent: null
                }
            }
        },
        methods: {
            addComment(payload) {
                axios.post(this.apiCommentStoreUrl, payload)
                    .then(result => {
                        this.addCommentInDom(result);

                        this.successComment = result.data.message;
                        this.reset();
                    })
                    .catch(error => {
                        this.errorsComment.errorsName = error.response ? error.response.data.errors.name : null;
                        this.errorsComment.errorsContent = error.response ? error.response.data.errors.name : null;
                    })
            },
            reset() {
                this.errorsComment.errorsName = null;
                this.errorsComment.errorsContent = null;

                setTimeout(() => {
                    this.successComment = null;
                }, 4000);
            },
            getComments(page = 1) {
                axios.get(`${this.apiCommentGetUrl}?page=${page}`)
                    .then(result => this.comments = result.data)
            },
            addCommentInDom(result) {
                // Add new comment
                if(!result.data.comment.parent_id) {
                    this.comments.data.unshift(result.data.comment);
                    return;
                }

                // Add child comment
                this.findIdAndPush(this.comments.data, result.data.comment.parent_id, result.data.comment);
            },
            findIdAndPush(data, id, comment) {
                for(let i = 0; i < data.length; i++) {
                    if(data[i].id === id) {
                        data[i].children.push(comment);
                    }

                    let children = data[i].children;
                    if(children.length > 0) {
                        this.findIdAndPush(children, id, comment);
                    }
                }
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
