<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        $posts = Post::where('user_id', $userId)->get();

        return view('post.profile-listing', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) : RedirectResponse
    {
        $userId = $request->user()->id;

        $post = new Post;

        $post->user_id = $userId;
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $this->store($post);

        return redirect('/posts');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Post $post): void
    {
        $post->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->where('is_approved', 1)->get();
        $userName = User::find($post->user_id)->name;

        return view('post.one-post', ['post' => $post, 'comments' => $comments, 'userName' => $userName]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request) : RedirectResponse
    {
        // todo: findOrFail or smth
        $post = Post::find($request->input('post_id'));

        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $this->store($post);

        return redirect('/posts');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $post = Post::find($request->input('post_id'));

        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $this->store($post);

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) : RedirectResponse
    {
        $postId = $request->input('post_id');
        $post = Post::find($postId);
        $post->delete();

        return redirect('/posts');

    }
}
