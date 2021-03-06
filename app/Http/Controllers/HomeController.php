<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = $this->getAllPostForAuthUser();
        $apiToken = Auth::user()->api_token;

        return view('home', [
            'posts' => json_encode($posts),
            'apiToken' => $apiToken
        ]);
    }

    public function getAllPostForAuthUser()
    {
        return Post::where('user_id', Auth::user()->getAuthIdentifier())
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    }
}
