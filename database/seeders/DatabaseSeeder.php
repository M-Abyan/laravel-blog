<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'email' => 'someone@someone.com',
                'name' => 'Someone',
                'username' => 'somone',
                'password' => Hash::make('12345678')
            ],
            [
                'email' => 'arslan@arslan.com',
                'name' => 'Arslan',
                'username' => 'arslan',
                'password' => Hash::make('12345678')
            ],
            [
                'email' => 'gimli@gimli.com',
                'name' => 'Gimli',
                'username' => 'gimli',
                'password' => Hash::make('12345678')
            ],
        ]);
        Tag::insert([
            [
                'name' => 'Javascript',
            ],
            [
                'name' => 'PHP',
            ],
            [
                'name' => 'HTML',
            ],
            [
                'name' => 'CSS',
            ],
        ]);
    }
}
