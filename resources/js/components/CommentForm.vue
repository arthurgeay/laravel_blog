<template>
    <form>
        <h2>Ajouter un commentaire</h2>

        <div v-if="success" class="alert alert-success">
            {{ success }}
        </div>

        <div class="form-group">
            <label for="name">Pseudo</label>
            <input type="text" class="form-control" id="name" v-model="name" required>
        </div>
        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea class="form-control" id="content" required v-model="content"></textarea>
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
