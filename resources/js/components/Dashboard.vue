<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Vos articles</div>
                    <div class="card-body">
                        <p>
                            <a class="btn btn-primary" :href="`./posts/add`">Ajouter un article</a>
                        </p>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Titre</th>
                                <th scope="col">Dernière modification</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="post in posts.data">
                                <th scope="row"><a :href="`./posts/${post.id}`">{{ post.title }}</a></th>
                                <td>{{ post.updated_at}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" :href="`./posts/${post.id}`">Voir</a>
                                            <a class="dropdown-item text-info" :href="`./posts/${post.id}/edit`">Modifier</a>
                                            <a class="dropdown-item text-danger" data-toggle="modal" :data-target="`#modal-${post.id}`" href="#">Supprimer</a>
                                        </div>

                                    </div>
                                </td>

                                <div class="modal fade" :id="`modal-${post.id}`" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <button type="button" class="btn btn-danger">Supprimer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        props: {
            posts: {
                required: true
            }
        }
    }
</script>

<style scoped>
</style>
