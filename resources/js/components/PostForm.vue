<template>
    <form>
        <div class="alert alert-success" v-if="successMessage">
            {{ successMessage }}
        </div>

        <div class="alert alert-danger" v-if="error">
            {{ error }}
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
        <a :href="route('dashboard')" class="btn btn-secondary">Retour au dashboard</a>
    </form>
</template>

<script>
    export default {
        name: "PostForm",
        props: {
            apiToken: {
                type: String,
                required: true
            },
            post: {
                type: Object,
                required: false
            }
        },
        data() {
            return {
                title: '',
                content: '',
                errorsTitle: null,
                errorsContent: null,
                error: null,
                successMessage: ''
            }
        },
        methods: {
            sendForm() {
                let method = this.post ? 'put' : 'post';
                const urlApi = method === 'post' ? this.route('api.post.store', { api_token: this.apiToken}) : this.route('api.post.update', { api_token: this.apiToken, post: this.post.id});
                axios({
                    method: method,
                    url: urlApi,
                    data: {
                        title: this.title,
                        content: this.content
                    }
                })
                .then(result => {
                    this.successMessage = result.data.message ?? '';
                    this.resetFields();
                })
                .catch(error => {
                    if(error.response.data.errors) {
                        this.errorsTitle = error.response.data.errors.title ? [error.response.data.errors.title[0]] : null;
                        this.errorsContent = error.response.data.errors.content ? [error.response.data.errors.content[0]] : null;
                        return;
                    }

                    this.error = error.response.data.message ? error.response.data.message : null;
                });
            },
            resetFields() {
                if(!this.post) {
                    this.title = '';
                    this.content = '';
                }

                this.errorsTitle = null;
                this.errorsContent = null;
                this.error = null;

                setTimeout(() => {
                   this.successMessage = '';
                }, 4000);
            },
            setFields() {
                if(this.post) {
                    this.title = this.post.title;
                    this.content = this.post.content;
                }
            }
        },
        mounted() {
            this.setFields();
        }
    }
</script>
