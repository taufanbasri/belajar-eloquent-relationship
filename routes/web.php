<?php
//Auth::loginUsingId(1);

use App\User;
use App\Post;
use App\Role;
use App\Profile;
use App\Category;
use App\Portfolio;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * One to One Route
 */
Route::get('/create-user', function()
{
    $user = User::create([
        'name' => 'Keti',
        'email' => 'keti@mail.com',
        'password' => bcrypt('123456')
    ]);

    return $user;
});

Route::get('/create-profile', function()
{
    // Cara 1
    // $profile = Profile::create([
    //     'user_id' => 1,
    //     'phone' => '123456',
    //     'address' => 'Lampung Barat'
    // ]);

    // Cara 2
    $user = User::findOrFail(1);

    $user->profile()->create([
        'phone' => '123456',
        'address' => 'Lampung Barat'
    ]);

    return $user;
});

Route::get('/create-user-profile', function()
{
    // Cara 3, Instace object
    $user = User::findOrFail(2);

    $profile = new Profile([
        'phone' => '654321',
        'address' => 'Liwa, Lampung Barat'
    ]);

    $user->profile()->save($profile);

    return $user;
});

Route::get('/read-user', function()
{
    $user = User::findOrFail(1);

    $data = [
        'name' => $user->name,
        'phone' => $user->profile->phone,
        'address' => $user->profile->address,
    ];

    return $data;
});

Route::get('/read-profile', function()
{
    $profile = Profile::findOrFail(1);

    $data = [
        'name' => $profile->user->name,
        'email' => $profile->user->email,
        'phone' => $profile->phone,
        'address' => $profile->address,
    ];

    return $data;
});

Route::get('/update-profile', function()
{
    $user = User::findOrFail(1);

    $data = [
        'phone' => '080808',
        'address' => 'Jl. Kehidupan, No. 123'
    ];

    $user->profile->update($data);

    return $user;
});

Route::get('/delete-profile', function()
{
    $user = User::findOrFail(1);

    $user->profile->delete();

    return $user;
});

Route::get('/delete-user', function()
{
    $user = User::findOrFail(2);

    $user->delete();

    return $user;
});

/**
 * One to Many Route
 */
Route::get('/create-post', function()
{
    // $user = User::create([
    //     'name' => 'Taufan',
    //     'email' => 'taufan@mail.com',
    //     'password' => bcrypt('123456')
    // ]);

    $user = User::findOrFail(2);

    $user->posts()->create([
        'title' => 'Judul Post 2 user Member',
        'body' => 'Isi dari post 2 user Member'
    ]);

    return $user->posts;
});

Route::get('/read-post', function()
{
    $user = User::findOrFail(1);

    $posts = $user->posts;

    foreach ($posts as $post) {
        $data[] = [
            'nama' => $post->user->name,
            'title' => $post->title,
            'body' => $post->body
        ];
    }

    return $data;
});

Route::get('/update-post', function()
{
    $user = User::findOrFail(1);

    // $user->posts()->whereId(1)->update([
    //     'title' => 'Ini title setelah di update',
    //     'body' => 'Ini isi dari post setelah di update'
    // ]);

    // mengupdate seluruh nilai Post dengan nilai yang sama.
    $user->posts()->update([
        'title' => 'Ini title yang sama',
        'body' => 'Ini isi dari post yang sama'
    ]);

    return $user->posts;
});

Route::get('/delete-post', function()
{
    $user = User::findOrFail(1);

    $user->posts()->whereId(1)->delete();

    // untuk menghapus semua posts yang berelasi dengan user tertentu
    // $user->posts()->delete();

    return $user->posts;
});

/**
 * Many to Many Route
 */
 Route::get('/create-categories', function()
 {
    // $post = Post::findOrFail(1);

    // $post->categories()->create([
    //     'slug' => str_slug('Belajar PHP', '-'),
    //     'name' => 'Belajar PHP'
    // ]);

    // return $post->categories;

    $user = User::create([
        'name' => 'Keti',
        'email' => 'keti@mail.com',
        'password' => bcrypt('123456')
    ]);

    $user->posts()->create([
        'title' => 'New Title',
        'body' => 'New body of this post'
    ])->categories()->create([
        'slug' => str_slug('Belajar Menjahit', '-'),
        'name' => 'Belajar Menjahit'
    ]);

    return $user;
 });

Route::get('/read-categories', function()
{
    // $post = Post::findOrFail(1);
    //
    // return $post->categories;

    $category = Category::findOrFail(1);

    return $category->posts;
});

Route::get('/attach-categories', function()
{
    $post = Post::findOrFail(2);

    $post->categories()->attach(1);

    return $post->categories;
});

Route::get('/detach-categories', function()
{
    $post = Post::findOrFail(1);
    $post->categories()->detach([2,3]);

    return $post->categories;
});

Route::get('/sync-categories', function()
{
    $post = Post::findOrFail(1);
    // sync harus menggunakan type data array, jika attach & detach masih diberi opsi 1 data saja.
    $post->categories()->sync([2,3]);

    return $post->categories;
});

Route::get('/role/posts', function()
{
    $role = Role::findOrFail(1);

    return $role->posts;
});

/**
 * Polymorphic relationships
 */
Route::get('/comments/create', function()
{
    // $post = Post::findOrFail(1);
    // $post->comments()->create([
    //     'user_id' => 2,
    //     'content' => 'Balasan response dari user_id 1'
    // ]);
    //
    // return $post->comments;

    $portfolio = Portfolio::findOrFail(1);
    $portfolio->comments()->create([
        'user_id' => 2,
        'content' => 'Balasan portfolio response dari user_id 1'
    ]);

    return $portfolio->comments;
});

Route::get('/comments/read', function()
{
    // $post = Post::findOrFail(1);
    // $comments = $post->comments;
    //
    // return $comments;

    // $portfolio = Portfolio::findOrFail(1);
    // $comments = $portfolio->comments;
    //
    // // return $comments;
    //
    // foreach ($comments as $comment) {
    //     echo $comment->user->name . ': ' . $comment->content . ' ('. $comment->commentable->title .')<br>';
    // }

    $user = User::findOrFail(2);
    $comments = $user->comments;

    return $comments;
});

Route::get('/comments/update', function()
{
    $post = Post::findOrFail(1);

    $comment = $post->comments()->whereId(1)->first();
    $comment->update([
        'content' => 'Komentar telah di sunting/update'
    ]);

    return $comment;
});

Route::get('/comments/delete', function()
{
    $post = Post::findOrFail(1);

    $post->comments()->whereId(1)->delete();

    return $post->comments;
});

/**
 * Many to Many Polimorphic Relationship
 */
Route::get('/tags/read', function()
{
    $post = Post::findOrFail(1);

    // return $post->tags;
    foreach ($post->tags as $tag) {
        echo $tag->name.'<br>';
    }
});

Route::get('/tags/attach', function()
{
    $post = Post::findOrFail(1);

    $post->tags()->attach([5,6,7]);

    return $post->tags;
});

Route::get('/tags/detach', function()
{
    $post = Post::findOrFail(1);

    $post->tags()->detach([1,3]);

    return $post->tags;
});

Route::get('/tags/sync', function()
{
    // $post = Post::findOrFail(1);
    //
    // $post->tags()->sync([1,3,4]);
    //
    // return $post->tags;
    $portfolio = Portfolio::findOrFail(1);

    $portfolio->tags()->sync([1,3,4]);

    return $portfolio->tags;
});

/**
 * SoftDeletes process
 */
 Route::get('/posts/softdeletes', function()
 {
     $post = Post::findOrFail(1);
     $post->delete();

     return $post;
 });

 Route::get('/posts/trash', function()
 {
     // all posts and trashed too.
     // $posts = Post::withTrashed()->get();

     $posts = Post::onlyTrashed()->get();

     return $posts;
 });

 Route::get('/posts/restore', function()
 {
     $post = Post::onlyTrashed(1)->restore();
     // dd($post);

     return $post;
 });

Route::get('/posts/forcedelete', function()
{
    $post = Post::onlyTrashed([1])->forceDelete();

    return $post;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/datatables', 'DatatablesController@index');

Route::resource('books', 'BookController')->except(['create']);

Route::get('documents/{document}', 'DocumentsController@show');

Route::get('lessons', 'LessonController@index');