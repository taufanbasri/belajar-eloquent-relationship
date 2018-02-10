<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Yajra\DataTables\Html\Builder;
use DataTables;

class DatatablesController extends Controller
{
    public function index(Request $request, Builder $builder)
    {
        if ($request->ajax()) {
            $posts = Post::with('user');

            return Datatables::of($posts)->toJson();
        }

        $html = $builder->columns([
            ['data' => 'user.name', 'name' => 'user.name', 'title' => 'User'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
            ['data' => 'body', 'name' => 'body', 'title' => 'Body'],
        ]);

        return view('datatables', compact('html'));
    }
}
