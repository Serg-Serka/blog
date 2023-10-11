<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\JsonPlaceholderService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{

    protected JsonPlaceholderService $jsonPlaceholderService;

    public function __construct(JsonPlaceholderService $jsonPlaceholderService)
    {
        $this->jsonPlaceholderService = $jsonPlaceholderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $userId = $request->user()->id;
        $posts = Post::where('user_id', $userId)->orderByDesc('created_at')->get();


        return view('post.profile-listing', ['posts' => $posts, 'error' => $request->input('error')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $userId = $request->user()->id;

        $post = new Post;

        $post->user_id = $userId;
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $post->save();

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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
     * Remove the specified resource from storage.
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
