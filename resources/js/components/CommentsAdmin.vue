<template>
    <div>
        <div class="card">
            <div class="card-header">Les commentaires signalés</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Titre de l'article</th>
                        <th scope="col">Auteur du commentaire</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">titre</th>
                        <td>pseudo</td>
                        <td>Commentaire</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Voir l'article</a>
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
        name: "CommentsAdmin"
    }
</script>

<style scoped>

</style>
