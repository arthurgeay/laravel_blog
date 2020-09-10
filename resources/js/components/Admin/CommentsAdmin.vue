<template>
    <div>
        <div class="card">
            <div class="card-header">Les commentaires signalés</div>
            <div v-if="success" class="alert alert-success">
                {{ success }}
            </div>
            <div v-if="error" class="alert alert-danger">
                {{ error }}
            </div>
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
                    <tr v-for="(comment, index) in comments.data">
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
                                    <a class="dropdown-item text-info" href="#" data-toggle="modal" :data-target="`#modal-ignore-${comment.id}`">Ignorer le commentaire</a>
                                    <a class="dropdown-item text-danger" href="#" data-toggle="modal" :data-target="`#modal-${comment.id}`">Supprimer</a>
                                </div>

                            </div>
                        </td>
                        <div class="modal fade" :id="`modal-${comment.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression d'un commentaire</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez vous supprimer définitivement le commentaire qui a pour contenu : "{{ comment.content }}" ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="deleteComment(comment.id, index)">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" :id="`modal-ignore-${comment.id}`" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLaebl">Suppression d'un commentaire</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez vous ignore le commentaire signalé qui a pour contenu : "{{ comment.content }}" ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="resetComment(comment.id, index)">Ignorer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination :data="comments" @pagination-change-page="getReportComments" align="center"></pagination>
    </div>
</template>

<script>
    export default {
        name: "CommentsAdmin",
        props: {
            dataComments: {
                type: Object,
                required: true
            },
            apiToken: {
                type: String,
                required: true
            },
        },
        data() {
            return {
                comments: this.dataComments,
                success: null,
                error: null,
            }
        },
        watch: {
            dataComments: function() {
                this.comments = this.dataComments;
            }
        },
        methods: {
            deleteComment(id, index)
            {
                axios.delete(this.route('api.comment.destroy', { api_token: this.apiToken, comment: id }))
                    .then(result => {
                        this.comments.data.splice(index, 1);
                        this.success = result.data.message;
                        this.reset();

                        // Refresh pagination when all comments of the page are deleted or ignored
                        if(this.comments.data.length === 0 && this.comments.current_page > 1) {
                            this.getReportComments(this.comments.current_page - 1);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        this.error = "Une erreur s'est produite. Veuillez réessayer.";
                    })
            },
            reset() {
                setTimeout(() => {
                    this.success = null;
                    this.error = null;
                }, 4000);
            },
            resetComment(id, index) {
                axios.get(this.route('api.comment.report.reset', { api_token: this.apiToken, comment: id}))
                    .then(result => {
                        this.comments.data.splice(index, 1);
                        this.success = result.data.message;
                        this.reset();

                        // Refresh pagination when all comments of the page are deleted or ignored
                        if(this.comments.data.length === 0 && this.comments.current_page > 1) {
                            this.getReportComments(this.comments.current_page - 1);
                        }
                    })
                    .catch(error => this.error = "Une erreur s'est produite. Veuillez réessayer")
            },
            getReportComments(page = 1) {
                axios.get(this.route('api.comment.report.index', { api_token: this.apiToken, page: page}))
                    .then(result => this.comments = result.data)
            },
        }
    }
</script>

<style scoped>

</style>
