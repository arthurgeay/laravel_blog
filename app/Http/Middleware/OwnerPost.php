<?php

namespace App\Http\Middleware;

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
        $postId = $request->segments()[1];

        if($request->segments()[0] == 'api') {
            $postId = $request->segments()[2];
        }

        $post = Post::where('id', $postId)->first();


        if($post->user_id !== Auth::user()->getAuthIdentifier()) {
            return redirect('/');
        }

        return $next($request);
    }
}
