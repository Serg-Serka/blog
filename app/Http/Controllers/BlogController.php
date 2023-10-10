<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JsonPlaceholderService;
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
        $posts = $this->jsonPlaceholderService->getPosts();

        return view('post.listing', ['posts' => $posts]);
    }
}
