<template>
    <form>
        <div class="alert alert-success" v-if="successMessage">
            {{ successMessage }}
        </div>
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" :class="{'is-invalid': errorsTitle}" id="title" v-model="title" required>
            <div class="invalid-feedback" v-if="errorsTitle">
                <p v-for="error in errorsTitle">{{ error }}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea class="form-control" :class="{'is-invalid': errorsContent}" id="content" v-model="content" required></textarea>
            <div class="invalid-feedback" v-if="errorsContent">
                <p v-for="error in errorsContent">{{ error }}</p>
            </div>
        </div>
        <button v-if="post" type="submit" class="btn btn-success" @click.prevent="sendForm">Modifier</button>
        <button v-else type="submit" class="btn btn-success" @click.prevent="sendForm">Créer</button>
    </form>
</template>

<script>
    export default {
        name: "PostForm",
        props: {
            apiUrl: {
                type: String,
                required: false
            },
            post: {
                type: Object
            }
        },
        data() {
            return {
                title: '',
                content: '',
                errorsTitle: '',
                errorsContent: '',
                successMessage: ''
            }
        },
        methods: {
            sendForm() {
                axios.post(this.apiUrl, {
                    title: this.title,
                    content: this.content
                })
                    .then(result => {
                        this.successMessage = result.data.message ?? '';
                        this.resetFields();
                    })
                    .catch(error => {
                        this.errorsTitle = [error.response.data.errors.title ? error.response.data.errors.title[0] : ''];
                        this.errorsContent = [error.response.data.errors.content ? error.response.data.errors.content[0] : ''];
                    });
            },
            resetFields() {
                this.title = '';
                this.content = '';

                setTimeout(() => {
                   this.successMessage = '';
                }, 4000);
            },
            setFields() {
                this.title = this.post.title ?? '';
                this.content = this.post.content ?? '';
            }
        },
        mounted() {
            this.setFields();
        }
    }
</script>
