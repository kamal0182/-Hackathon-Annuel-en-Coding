<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use App\Models\Jury;
use App\Models\JuryMemmber;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createJury(Request $request)
    {
        // return $request->hackathon_id ;
        $hackathone = Hackathon::find($request->hackathon_id);
        $jury = new Jury();
        $jury->name = $request->name ;
         $jury->hackathon->associate($hackathone);
        $jury->save();
        return $jury;
    }
    public function createMemberJury(Request $request)
    {
        $jury  = Jury::find($request->jury_id);
        $membrejury =  new JuryMemmber();
        $membrejury->name = $request->name  ;
        $membrejury->code  = $request->code ;
        $membrejury->jury->associate($jury);
        return $membrejury ;
    }
    public function findByid( $builder ,$id){
        $obj = $builder::find($id);
        return $obj  ;
    }
}
