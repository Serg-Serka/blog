<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\JsonPlaceholderService;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
        $users = $this->jsonPlaceholderService->getUsers();

        foreach ($users as $user) {
             User::factory()->create([
                 'name' => $user['name'],
                 'email' => $user['email'],
                 'password' => $user['address']['zipcode'], // password does not come from API, so use zipcode
             ]);
        }

        $admin = new User;

        $admin->name = 'Serg';
        $admin->email = 'serg@ser.com';
        $admin->password = Hash::make('password');
        $admin->is_admin = 1;

        $admin->save();
    }
}
