<?php
use App\User;
use App\Profile;

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

    // akan menghapus profile yang berelasi karena dibuat onDelete('cascade')
});
