<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class JsonPlaceholderService
{
    private string $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getUsers()
    {
        $response = Http::get($this->url('users'));
        return $response->json();

    }

    public function getUserById($userId)
    {
        $response = Http::get($this->url("users/$userId"));
        return $response->json();
    }

    public function getPosts()
    {
        $response = Http::get($this->url('posts'));
        return $response->json();
    }

    public function getPostById($postId)
    {
        $response = Http::get($this->url("posts/$postId"));
        return $response->json();
    }

    public function getComments()
    {
        $response = Http::get($this->url('comments'));
        return $response->json();
    }

    public function getCommentById($commentId)
    {
        $response = Http::get($this->url("comments/$commentId"));
        return $response->json();
    }

    public function getPostsByUserId($userId)
    {
        $response = Http::get($this->url("users/$userId/posts"));
        return $response->json();
    }

//    public function getCommentsByUserId($userId)
//    {
//
//    }

    private function url($path): string
    {
        return "{$this->url}/$path";
    }

}
