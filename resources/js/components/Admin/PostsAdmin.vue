<template>
    <div>
        <div class="card">
            <div class="card-header">Vos articles</div>
            <div class="card-body">
                <p>
                    <a class="btn btn-primary" :href="route('post.add')">Ajouter un article</a>
                </p>
                <div v-if="success" class="alert alert-success">
                    {{ success }}
                </div>
                <div v-else-if="error" class="alert alert-danger">
                    {{ error }}
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Dernière modification</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(post, index) in posts.data">
                        <th scope="row"><a :href="route('post.show', {post: post.id})">{{ post.title }}</a></th>
                        <td>{{ post.updated_at | formatDate(true) }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" :href="route('post.show', {post: post.id})">Voir</a>
                                    <a class="dropdown-item text-info" :href="route('post.edit', {post: post.id})">Modifier</a>
                                    <a class="dropdown-item text-danger" data-toggle="modal" :data-target="`#modal-${post.id}`" href="#">Supprimer</a>
                                </div>

                            </div>
                        </td>

                        <div class="modal fade" :id="`modal-${post.id}`" tabindex="-1" role="dialog" :aria-labelledby="`modal-${post.id}`" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression d'un article</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer l'article : "{{ post.title }}" ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-danger" @click="deletePost(post.id, index)" data-dismiss="modal">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <pagination :data="posts" @pagination-change-page="getResults" align="center"></pagination>
    </div>
</template>

<script>
    export default {
        name: "PostsAdmin",
        props: {
            dataPosts: {
                required: true,
                type: Object
            },
            apiToken: {
                require: true,
                type: String
            }
        },
        data() {
            return {
                posts: this.dataPosts,
                success: '',
                error: ''
            }
        },
        methods: {
            deletePost(id, index) {
                axios.delete(this.route('api.post.destroy', {api_token: this.apiToken, post: id}))
                    .then(result => {
                        this.success = result.data.message;
                        this.posts.data.splice(index, 1);

                        this.resetAlert();

                        // Refresh pagination when all the post of the page are deleted
                        if(this.posts.data.length === 0 && this.posts.current_page > 1) {
                            this.getResults(this.posts.current_page - 1);
                        }

                    })
                    .catch(error => this.error = "Une erreur s'est produite. Veuillez réessayer.");
            },
            getResults(page = 1) {
                axios.get(this.route('api.allPosts.owner', {api_token: this.apiToken, page: page}))
                    .then(result => this.posts = result.data)
            },
            resetAlert() {
                setTimeout(() => {
                    this.success = '';
                    this.error = '';
                }, 800);
            }
        }
    }
</script>

<style scoped>

</style>
