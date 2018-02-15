<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\LessonFilters;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(LessonFilters $filters)
    {
        return Lesson::filter($filters)->get();
    }
}
