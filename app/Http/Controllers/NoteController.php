<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create(Request $request)
    {
        $note = new Note();
        $note->comment = $request->comment ;
        $note->note = $request->note ;
    }
}
