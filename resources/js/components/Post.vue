<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">{{ post.title}}</h1>
                <p class=""><span class="badge badge-primary"> Auteur : {{ post.user.name }}</span> - Publié le {{ post.created_at | formatDate }}</p>
                <img src="https://fakeimg.pl/250x100" class="img-fluid w-100" alt="...">
                <p>{{ post.content }}</p>

                <h2>Commentaires</h2>
                <comment v-for="comment in post.comments" :comment="comment" :key="comment.id"></comment>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Post",
        props: {
            post: {
                type: Object,
                required: true
            }
        },
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
