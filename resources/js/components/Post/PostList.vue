<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Liste des articles</h1>
            </div>
            <!-- Card -->
            <div class="row justify-content-center">
                <div class="card col-md-3" v-for="post in posts.data">
                    <img src="https://fakeimg.pl/300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ post.title }}
                        </h5>
                        <p>Rédigé par {{ post.user.name }}</p>
                        <p>Publié le {{ post.created_at | formatDate }}</p>
                        <p class="card-text">
                            {{ post.content | summary }}.
                        </p>
                        <a :href="route('post.show', {post: post.id})" class="btn btn-primary">Voir l'article en entier</a>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <pagination class="mx-auto" :data="posts" @pagination-change-page="getResults"></pagination>




        </div>
    </div>
</template>

<script>

    export default {
        name: 'PostList',
        props: {
           dataPosts: {
               type: Object,
               required: true
           },
        },
        data() {
            return {
                posts: this.dataPosts,
                urlApi: this.route('api.allPosts')
            }
        },
        filters: {
            summary(value) {
                return `${value.substring(1, 100)}...` ;
            },
        },
        methods: {
            getResults(page = 1) {
                axios.get(`${this.urlApi}?page=${page}`)
                    .then(result => this.posts = result.data);
            }
        }


    }
</script>

<style>
    .card {
        margin: 10px;
    }
</style>



