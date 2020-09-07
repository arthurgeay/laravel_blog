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
                <comment v-for="comment in post.comments" :comment="comment" :key="comment.id"></comment>
            </div>
        </div>
    </div>

</template>

<script>
    import Comment from './Comment.vue';
    import CommentForm from './CommentForm.vue';

    export default {
        name: "Post",
        props: {
            dataPost: {
                type: Object,
                required: true
            },
        },
        components: {
            Comment,
            CommentForm
        },
        data() {
            return {
                post: this.dataPost,
                apiUrl: this.route('api.comment.store', { post: this.dataPost.id }),
                success: null,
                errors: {
                    errorsName: null,
                    errorsContent: null
                }
            }
        },
        methods: {
            addComment(payload) {
                axios.post(this.apiUrl, payload)
                    .then(result => {
                        this.post.comments.push(result.data.comment);
                        this.success = result.data.message;
                        this.reset();
                    })
                    .catch(error => {
                        this.errors.errorsName = error.response.data.errors.name ?? null;
                        this.errors.errorsContent = error.response.data.errors.content ?? null;
                    })
            },
            reset() {
                setTimeout(() => {
                    this.success = null;
                }, 4000);
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
