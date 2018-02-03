<?php
use App\User;
use App\Post;
use App\Profile;
use App\Category;

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
    $user = User::create([
        'name' => 'Taufan',
        'email' => 'taufan@mail.com',
        'password' => bcrypt('123456')
    ]);

    // $user = User::findOrFail(1);

    $user->posts()->create([
        'title' => 'Judul Post ke-2',
        'body' => 'Isi dari post ke-2'
    ]);

    return $user;
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
