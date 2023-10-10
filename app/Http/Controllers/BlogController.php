<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Services\JsonPlaceholderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BlogController extends Controller
{
    protected JsonPlaceholderService $jsonPlaceholderService;

    public function __construct(JsonPlaceholderService $jsonPlaceholderService)
    {
        $this->jsonPlaceholderService = $jsonPlaceholderService;
    }

    public function index(Request $request) : View
    {
        $posts = DB::table('posts');

        if (!empty($request->input('title'))) {
            $posts->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if (!empty($request->input('body'))) {
            $posts->where('body', 'like', '%' . $request->input('body') . '%');
        }

        if (!empty($request->input('email'))) {
            $posts->where('email', $request->input('email'));
        }

        $posts = $posts->paginate(15);

        return view('post.listing', ['posts' => $posts]);
    }
}
