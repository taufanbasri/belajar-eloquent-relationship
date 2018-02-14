<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function show(Document $document)
    {
        return view('documents.show')->withDocument($document);
    }
}
