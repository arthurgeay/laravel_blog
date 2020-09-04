<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Psy\Util\Json;

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
    public function show($id)
    {
        $post = Post::where('id', $id)
            ->with('user')
            ->first();

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
