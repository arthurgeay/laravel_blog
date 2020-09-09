<template>
    <div>
        <div class="card">
            <div class="card-header">Les commentaires signalés</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Titre de l'article</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Signalement</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="comment in dataComments">
                        <th scope="row"><a :href="route('post.show', {post: comment.post_id })">{{ comment.title }}</a></th>
                        <td>{{ comment.name }}</td>
                        <td>{{ comment.content }}</td>
                        <td>{{ comment.reports }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" :href="route('post.show', {post: comment.post_id })">Voir l'article</a>
                                    <a class="dropdown-item text-info" href="#">Ignorer le commentaire</a>
                                    <a class="dropdown-item text-danger" href="#">Supprimer</a>
                                </div>

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "CommentsAdmin",
        props: {
            dataComments: {
                type: Array,
                required: false
            }
        },
        data() {
            return {
                comments: this.dataComments
            }
        }
    }
</script>

<style scoped>

</style>
