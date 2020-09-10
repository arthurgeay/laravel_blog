<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Articles</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a @click="getReportComments" class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Commentaires</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <posts-admin :data-posts="dataPosts" :api-token="apiToken"></posts-admin>
                    </div>
                    <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                        <comments-admin :data-comments.sync="comments" :api-token="apiToken"></comments-admin>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PostsAdmin from './PostsAdmin.vue';
    import CommentsAdmin from "./CommentsAdmin.vue";

    export default {
        name: "Dashboard",
        components: {
            PostsAdmin,
            CommentsAdmin
        },
        props: {
            dataPosts: {
                required: true,
                type: Object
            },
            apiToken: {
                require: true,
                type: String
            }
        },
        data() {
            return {
                urlGetCommentsApi: this.route('api.comment.report.index', { api_token: this.apiToken}),
                comments: {}
            }
        },
        methods: {
            getReportComments() {
                axios.get(this.urlGetCommentsApi)
                    .then(result => this.comments = result.data)
            }
        },

    }
</script>

<style scoped>
</style>
