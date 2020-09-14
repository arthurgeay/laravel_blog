<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * @param $postId
     * @return \Illuminate\Http\JsonResponse
     * Return paginated comments of a post
     */
    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $comments;
    }

    /**
     * @param CommentRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * Store a new comment
     */
    public function store(CommentRequest $request, Post $post)
    {
        $comment = new Comment();
        $comment->name = $request->get('name');
        $comment->content = $request->get('content');
        $comment->post_id = $post->id;
        $comment->parent_id = $request->get('parent_id');

        $comment->save();
        $comment->setRelation('children', collect());

        return response()->json(['message' => 'Commentaire ajouté', 'comment' => $comment], 200);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * Report a comment
     */
    public function report(Comment $comment)
    {
        if(!$comment->reports) {
            $comment->reports = 1;
        } else {
            $comment->reports++;
        }

        $comment->save();

        return response()->json([
            'message' => 'Commentaire signalé'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * Return all reported comments on posts by author
     */
    public function getReportsComments()
    {
        $userId = Auth::user()->getAuthIdentifier();

        $comments = DB::table('comments')
            ->select('comments.*', 'posts.title')
            ->join('posts', 'posts.id', '=', 'comments.post_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('reports', '<>', 'NULL')
            ->where('users.id', '=', $userId)
            ->orderBy('reports', 'desc')
            ->paginate(10);

        return $comments;
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * Delete a comment
     */
    public function destroy(Comment $comment) {
        $comment->delete();

        return response()->json(['message' => 'Commentaire supprimé'], 200);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * Reset number of reports to a comment
     */
    public function resetCommentReport(Comment $comment) {
        $comment->reports = null;
        $comment->save();

        return response()->json(['message' => 'Commentaire ignoré et remise à zéro des signalements']);
    }
}
