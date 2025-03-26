<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function create(Request $request)
    {
        $theme = Theme::create(
            [
                'name' => $request->name ,
                 'description' => $request->description ,
                 'cover' => $request->cover ,
                 'hackathon_id' => null
            ]);
        return $theme ;

    }
}
