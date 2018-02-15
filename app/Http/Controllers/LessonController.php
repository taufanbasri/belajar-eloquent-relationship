<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $lesson = (new Lesson)->newQuery();

        if ($request->exists('popular')){
            $lesson->orderByDesc('views');
        }

        if ($request->has('difficulty')){
            $lesson->where('difficulty', $request->difficulty);
        }

        return $lesson->get();

//        call in URL using 'lessons?popular&difficulty=advanced'
    }
}
