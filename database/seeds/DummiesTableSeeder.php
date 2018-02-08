<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Member'],
        ];

        DB::table('roles')->insert($roles);

        $users = [
            ['name' => 'Admin', 'email' => 'admin@mail.com', 'password' => bcrypt('123456'), 'role_id' => 1],
            ['name' => 'Member', 'email' => 'member@mail.com', 'password' => bcrypt('123456'), 'role_id' => 2],
        ];

        DB::table('users')->insert($users);

        $posts = [
            ['user_id' => 1, 'title' => 'Judul post 1 dimiliki Admin', 'body' => 'Contoh isi post 1 dimiliki admin'],
            ['user_id' => 1, 'title' => 'Judul post 2 dimiliki Admin', 'body' => 'Contoh isi post 2 dimiliki admin'],
            ['user_id' => 2, 'title' => 'Judul post 1 dimiliki Admin', 'body' => 'Contoh isi post 1 dimiliki admin'],
            ['user_id' => 2, 'title' => 'Judul post 2 dimiliki Admin', 'body' => 'Contoh isi post 2 dimiliki admin'],
        ];

        DB::table('posts')->insert($posts);

        $categories = [
            ['slug' => 'web-programming', 'name' => 'Web Programming'],
            ['slug' => 'desktop-programming', 'name' => 'Desktop Programming'],
        ];

        DB::table('categories')->insert($categories);

        $category_post = [
            ['post_id' => 1, 'category_id' => 1],
            ['post_id' => 1, 'category_id' => 2],
            ['post_id' => 2, 'category_id' => 1],
            ['post_id' => 2, 'category_id' => 2],
            ['post_id' => 3, 'category_id' => 1],
            ['post_id' => 3, 'category_id' => 2],
            ['post_id' => 4, 'category_id' => 1],
            ['post_id' => 4, 'category_id' => 2],
        ];

        DB::table('category_post')->insert($category_post);

        $portfolios = [
            ['user_id' => 1, 'title' => 'Judul portfolio 1 dimiliki Admin', 'body' => 'Contoh isi portfolio 1 dimiliki admin'],
            ['user_id' => 1, 'title' => 'Judul portfolio 2 dimiliki Admin', 'body' => 'Contoh isi portfolio 2 dimiliki admin'],
            ['user_id' => 2, 'title' => 'Judul portfolio 1 dimiliki Admin', 'body' => 'Contoh isi portfolio 1 dimiliki admin'],
            ['user_id' => 2, 'title' => 'Judul portfolio 2 dimiliki Admin', 'body' => 'Contoh isi portfolio 2 dimiliki admin'],
        ];

        DB::table('portfolios')->insert($portfolios);

        $comments = [
            ['user_id' => 2, 'content' => 'Komentar dong di posting ID 1', 'commentable_id' => 1, 'commentable_type' => 'App\Post'],
            ['user_id' => 1, 'content' => 'Silahkan, saya juga akan koment di post ID 1', 'commentable_id' => 1, 'commentable_type' => 'App\Post'],
            ['user_id' => 2, 'content' => 'Komentar dong di portfolio ID 1', 'commentable_id' => 1, 'commentable_type' => 'App\Portfolio'],
            ['user_id' => 1, 'content' => 'Silahkan, saya juga akan koment di portfolio ID 1', 'commentable_id' => 1, 'commentable_type' => 'App\Portfolio'],
        ];

        DB::table('comments')->insert($comments);

        $tags = [
            ['name' => 'Post'],
            ['name' => 'Portfolio'],
            ['name' => 'Laravel'],
            ['name' => 'PHP'],
            ['name' => 'IT'],
            ['name' => 'Development'],
            ['name' => 'Web'],
            ['name' => 'Framework'],
            ['name' => 'Profile']
        ];

        DB::table('tags')->insert($tags);

        $taggables = [
            ['tag_id' => 1, 'taggable_id' => 1, 'taggable_type' => 'App\Post'],
            ['tag_id' => 3, 'taggable_id' => 1, 'taggable_type' => 'App\Post'],
            ['tag_id' => 2, 'taggable_id' => 1, 'taggable_type' => 'App\Portfolio']
        ];

        DB::table('taggables')->insert($taggables);
    }
}
