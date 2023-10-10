<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::where('email', $request->user()->email)->orderByDesc('created_at')->get();

        return view('comment.profile-listing', ['comments' => $comments]);
    }
}
