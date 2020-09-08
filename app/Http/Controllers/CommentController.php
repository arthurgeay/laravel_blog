<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;
use Illuminate\Http\Request;

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

        $comment->save();

        return response()->json(['message' => 'Commentaire ajouté', 'comment' => $comment], 200);
    }
}
