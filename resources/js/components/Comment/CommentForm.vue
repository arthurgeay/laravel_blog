<template>
    <form>
        <h2>Ajouter un commentaire</h2>

        <div v-if="success" class="alert alert-success">
            {{ success }}
        </div>

        <div class="form-group">
            <label for="name">Pseudo</label>
            <input type="text" class="form-control" :class="{'is-invalid': errors.errorsName }" id="name" v-model="name" required>
            <div class="invalid-feedback" v-if="errors.errorsName">
                <p v-for="error in errors.errorsName">{{ error }}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea class="form-control" :class="{'is-invalid': errors.errorsContent }"  id="content" required v-model="content"></textarea>
            <div class="invalid-feedback" v-if="errors.errorsContent">
                <p v-for="error in errors.errorsContent">{{ error }}</p>
            </div>
        </div>
        <button type="submit" class="btn btn-success" @click.prevent="emitAddComment">Ajouter</button>
    </form>
</template>

<script>
    export default {
        name: "CommentForm",
        props: {
            success: {
                type: String
            },
            errors: {
                type: Object
            }
        },
        data() {
            return {
                name: '',
                content: ''
            }
        },
        methods: {
            emitAddComment() {
                this.$emit('add-comment', {
                    name: this.name,
                    content: this.content
                });
                this.resetFields();
            },
            resetFields() {
                this.name = '';
                this.content = '';
            }
        }
    }
</script>

<style scoped>

</style>
