<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Show all posts related to user
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $userId = $request->user()->id;
        $posts = Post::where('user_id', $userId)->orderByDesc('created_at')->get();

        return view('post.profile-listing', ['posts' => $posts, 'error' => $request->input('error')]);
    }

    /**
     * Store post
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $userId = $request->user()->id;

        $post = new Post;
        $post->user_id = $userId;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->created_at = $request->input('date') ?? Carbon::now();
        $post->save();

        return redirect('/posts');
    }

    /**
     * Show post by ID
     *
     * @param string $id
     * @return View
     */
    public function show(string $id) : View
    {
        try {
            $post = Post::findOrFail($id);
            $comments = Comment::where('post_id', $id)->where('is_approved', 1)->orderByDesc('created_at')->get();
            $userName = User::findOrFail($post->user_id)->name;
            $error = false;
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            $post = null;
            $comments = null;
            $userName = null;
            $error = true;
        }
        return view('post.one-post', ['post' => $post, 'comments' => $comments, 'userName' => $userName, 'error' => $error]);
    }

    /**
     * Update posts
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request) : RedirectResponse
    {
        try {
            $post = Post::findOrFail($request->input('post_id'));
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
        }

        return redirect('/posts');
    }

    /**
     * Delete post
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request) : RedirectResponse
    {
        try {
            $postId = $request->input('post_id');
            $post = Post::findOrFail($postId);
            $post->delete();
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
        }

        return redirect('/posts');
    }
}
