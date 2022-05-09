<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostModel;
use Illuminate\Support\Facades\Auth;

class EnsurePostBelongsToUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $postID = $request->post_id;
        $targetPost = PostModel::getPostByID($postID);
        $currentUserID = Auth::user()->user_id;

        // error_log("\n\n[+] EnsurePostBelongsToUser: PostID = '$postID'");
        // error_log("\n[+] EnsurePostBelongsToUser: Target Post Author ID = '$targetPost->author_id'");
        // error_log("\n[+] EnsurePostBelongsToUser: Current User ID = '$currentUserID'");

        if ($currentUserID !== $targetPost->author_id) {
            error_log("\n[-] User does not own the post!!");
            return back()->with('error', 'You are not the post owner!');
        }

        error_log("\n[+] User owns post. Continuing.");
        return $next($request);
    }
}
