<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class HackathonController extends Controller
{
    public function create(Request $request)
    {
        $oraganisateur = auth()->user();
        try {
                $hackathon = new  Hackathon ;
                $hackathon->title =  $request->title  ;
                $hackathon->lieu =  $request->lieu ;
                $hackathon->date = $request->date;
                $hackathon->organisateur()->associate($oraganisateur);
                $hackathon->save();
        }catch(Exception $e)
        {
            return "error $e";
        }
        return $hackathon ;
    }
    // public   function update
}
