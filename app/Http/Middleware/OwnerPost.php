<?php

namespace App\Http\Middleware;

use App\Comment;
use App\Post;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class OwnerPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->segments()[1];

        if($request->segments()[0] == 'api') {
            $id = $request->segments()[2];
        }

        /* Get post or comment based on route */
        $post = $request->segments()[0] != 'api' || $request->segments()[1] == 'posts' ? Post::where('id', $id)->first() : null;
        $comment = $request->segments()[0] == 'api' && $request->segments()[1] == 'comments' ? Comment::with('post')->where('id', $id)->first() : null;

        if($post && $post->user_id !== Auth::user()->getAuthIdentifier()) {
            return abort('403', "Vous devez être l'auteur de l'article pour effectuer cette opération");
        }

        if($comment && $comment->post->user_id !== Auth::user()->getAuthIdentifier()) {
            return abort('403', "Vous devez être l'auteur de l'article pour effectuer cette opération");
        }

        return $next($request);
    }
}
