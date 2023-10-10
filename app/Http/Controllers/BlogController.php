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

    public function index() : View
    {
//        $posts = $this->jsonPlaceholderService->getPosts();
        $posts = DB::table('posts')->paginate(15);

        return view('post.listing', ['posts' => $posts]);
    }
}
