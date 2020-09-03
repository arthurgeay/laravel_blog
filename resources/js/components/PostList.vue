<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Liste des articles</h1>
            </div>

            <div class="row justify-content-center">
                <div class="card col-md-3" v-for="post in posts">
                    <img src="https://fakeimg.pl/300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ post.title }}
                        </h5>
                        <p>Rédigé par {{ post.user.name }}</p>
                        <p>Publié le {{ new Date(post.created_at).toLocaleDateString() }}</p>
                        <p class="card-text">
                            {{ post.content | summary }}.
                        </p>
                        <a href="#" class="btn btn-primary">Voir l'article en entier</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: 'PostList',
        props: {
           posts: {
               type: Array,
               required: true
           }
        },
        filters: {
            summary(value) {
                return `${value.substring(1, 100)}...` ;
            }
        }


    }
</script>

<style>
    .card {
        margin: 10px;
    }
</style>



