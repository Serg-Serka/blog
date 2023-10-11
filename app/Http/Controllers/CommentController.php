<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(Request $request) : View
    {
        $comments = Comment::where('email', $request->user()->email)->orderByDesc('created_at')->get();

        return view('comment.profile-listing', ['comments' => $comments]);
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        Log::info($request);

        $comment->name = $request->input('name');
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post_id');


        if ($request->user()) {
            $comment->email = $request->user()->email;
            $comment->is_approved = true;
        } else {
            $comment->email = $request->input('email');
            $comment->is_approved = false;
        }

//        Log::info($comment);
        $comment->save();


        return redirect('/posts/' . $request->input('post_id'));

    }
}
