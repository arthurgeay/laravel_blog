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
        <button type="submit" class="btn btn-success" @click.prevent="sendForm">Créer</button>
    </form>
</template>

<script>
    export default {
        name: "PostForm",
        props: {
            apiUrl: {
                type: String,
                required: true
            },
        },
        data() {
            return {
                title: '',
                content: ''
            }
        },
        methods: {
            sendForm() {
                axios.post(this.apiUrl, {
                    title: this.title,
                    content: this.content
                })
                    .then(result => console.log(result))
                    .catch(error => console.log(error.response.data.errors))
            }
        }
    }
</script>
