<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Return view of all posts
     */
    public function index()
    {
        $posts = $this->getAllPosts();

        return view('posts.index', [
            'posts' => json_encode($posts),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * Endpoint API for Paginate result of all post
     */
    public function getAllPosts()
    {
        $posts = Post::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return $posts;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Show a post
     */
    public function show(Post $post)
    {
        $post->load(['user']);

        $comments = Comment::where('post_id', $post->id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('posts.show', [
            'post' => $post,
            'comments' => json_encode($comments)
        ]);
    }

    /**
     * Show post form
     */
    public function create()
    {
        $apiToken = Auth::user()->api_token;

        return view('posts.create', [
            'apiToken' => $apiToken
        ]);
    }

    /**
     * Store a new post
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->user_id = Auth::user()->getAuthIdentifier();
        $post->save();

        return response()->json(['message' => 'Article ajouté'], 200);
    }

    /**
     * Edit a post
     */
    public function edit(Post $post)
    {
        $apiToken = Auth::user()->api_token;

        return view('posts.edit', [
            'post' => $post,
            'apiToken' => $apiToken
        ]);
    }

    /**
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * Update post in database
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();

        return response()->json(['message' => 'Article mis à jour'], 200);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * Delete a post
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Article supprimé'], 200);
    }
}
