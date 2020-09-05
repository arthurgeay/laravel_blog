<template>
    <form>
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" v-model="title" required>
        </div>
        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea class="form-control" id="content" v-model="content" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</template>

<script>
    export default {
        name: "PostForm",
        data() {
            return {
                title: '',
                content: ''
            }
        }
    }
</script>
