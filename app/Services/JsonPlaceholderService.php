<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class JsonPlaceholderService
{
    /**
     * Resource url
     *
     * @var string
     */
    private string $url;

    /**
     * Service constructor
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get all users
     *
     * @return array|mixed
     */
    public function getUsers(): mixed
    {
        $response = Http::get($this->url('users'));
        return $response->json();

    }

    /**
     * Get all posts
     *
     * @return array|mixed
     */
    public function getPosts(): mixed
    {
        $response = Http::get($this->url('posts'));
        return $response->json();
    }

    /**
     * Get all comments
     *
     * @return array|mixed
     */
    public function getComments(): mixed
    {
        $response = Http::get($this->url('comments'));
        return $response->json();
    }

    /**
     * Get resource url
     *
     * @param $path
     * @return string
     */
    private function url($path): string
    {
        return "{$this->url}/$path";
    }

}
