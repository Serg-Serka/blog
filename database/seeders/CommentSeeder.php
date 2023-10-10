<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\JsonPlaceholderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentSeeder extends Seeder
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
        $comments = $this->jsonPlaceholderService->getComments();

        foreach ($comments as $comment) {

            try {
                $user = User::where('email', $comment['email'])->firstOrFail();

                Comment::factory()->create([
                    'body' => $comment['body'],
                    'name' => $comment['name'],
                    'user_id' => $user->id,
                    'post_id' => $comment['postId']
                ]);
            } catch (ModelNotFoundException) {
                continue;
            }
        }
    }
}
