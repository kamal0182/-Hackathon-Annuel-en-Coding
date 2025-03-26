<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use App\Models\Team;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function view()
    {
        try{
            $hackathons = Hackathon::orderBy('date','desc')->get();
        }catch(Exception $e){
            return "error $e";
        }
        return $hackathons ;
    }
    public function participe(Request $request)
    {
        $team = $this->findTeamById($request->id);

        $user = auth()->user();
        $team = $this->canParticipe($team->participants,$team->hackathon->total_team_member, $user  , $team );
        return $team ;
    }
    public function show(Request $request)
    {
            $hackathon = Hackathon::find($request->id);
        return $hackathon->teams;
    }
    public function create(Request $request )
    {
        $user =  auth()->user();
        return $user->team;
        return $user->teams ;
         $user->teams;
         $user->team();
         $hackathon = Hackathon::find($request->hackathone_id);
         if(!$hackathon){
            return response()->json([
                'message' => 'hackathon not found'
            ]);
         }
        //  return $hackathon ;
        $team = new Team() ;
        $team->name = $request->name ;
        $team->captain()->associate($user);
        $team->hackathon()->associate($hackathon);
        $team->save();
        $teamnumber = $this->teamnumber($team->participants,$hackathon->total_team_member);
        return response()->json([
            'captain' => $team->captain->name  ,
             'name' => $team->name,
              'places' => $teamnumber
         ]) ;
    }
    public function canParticipe($team, $number ,$user , $teams)
    {
        $numeberofteam = count($team)  + 1 ;

        if($numeberofteam  ==  $number)
        {
            return "No places left";
        }
        return $team ;
        $user->teams->associate($teams);
        return "Ascasc";
        return "Welcome to  $teams->name";
    }
    public function teamnumber($team, $number)
    {
        $numeberofteam = count($team)  + 1 ;
        $openplace = $number -  $numeberofteam;

        if($numeberofteam >  $number)
        {
            return "no places left";
        }
        return "$openplace place still" ;
    }
    public function search($id)
    {
        $team = $this->findTeamById($id);
        return response()->json([
            'hackathon' => $team->hackathon->title ,
            'name' => $team->name ,
            'places' => $this->teamnumber($team->participants,$team->hackathon->total_team_member)
        ]);
        return $team  ;
    }
    public function findTeamById($id)
    {
        return Team::find($id);
    }
    // public function update

}
