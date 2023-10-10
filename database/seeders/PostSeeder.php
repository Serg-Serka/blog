<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;
use App\Services\JsonPlaceholderService;

class PostSeeder extends Seeder
{
    protected JsonPlaceholderService $jsonPlaceholderService;

    public function __construct(JsonPlaceholderService $jsonPlaceholderService)
    {
        $this->jsonPlaceholderService = $jsonPlaceholderService;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = $this->jsonPlaceholderService->getPosts();

        foreach ($posts as $post) {
            try {
                $user = User::where('id', $post['userId'])->firstOrFail();

                Post::factory()->create([
                    'body' => $post['body'],
                    'title' => $post['title'],
                    'user_id' => $user->id
                ]);
            } catch (ModelNotFoundException) {
//                Post::factory()->create([
//                    'body' => $post['body'],
//                    'title' => $post['title'],
//                    'user_id' => 1
//                ]);
                continue;
            }
        }
    }
}
