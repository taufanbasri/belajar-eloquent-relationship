<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use DataTables;
use Yajra\DataTables\Html\Builder;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {
        if ($request->ajax()) {
            $books = Book::all();

            return Datatables::of($books)
                    ->addColumn('action', function ($book) {
                        return view('datatable._action', [
                            'id' => $book->id,
                        ]);
                    })
                    ->toJson();
        }

        $html = $builder->columns([
            ['data' => 'title', 'name' => 'title', 'title' => 'Judul'],
            ['data' => 'author', 'name' => 'author', 'title' => 'Pengarang'],
            ['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false]
        ]);

        return view('books.index', compact('html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
        ]);

        Book::create($request->all());

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return $book;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
        ]);

        $book->update($request->all());

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        
        return response()->json([
            'success' => true
        ]);
    }
}
