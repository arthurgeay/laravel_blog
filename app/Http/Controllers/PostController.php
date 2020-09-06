<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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
            'url_api' => route('api.allPosts')
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
        $post->load('user');

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show post form
     */
    public function create()
    {
        $apiToken = Auth::user()->api_token;
        $apiUrl = route('api.post.store', ['api_token' => $apiToken]);

        return view('posts.create', [
            'apiUrl' => $apiUrl
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
        $apiUrl = route('api.post.update', ['api_token' => $apiToken, 'post' => $post]);

        return view('posts.edit', [
            'post' => $post,
            'apiUrl' => $apiUrl
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();

        return response()->json(['message' => 'Article mis à jour'], 200);
    }
}
