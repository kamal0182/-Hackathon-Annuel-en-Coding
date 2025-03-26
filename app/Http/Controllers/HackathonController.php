<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use App\Models\Rule;
use App\Models\Theme;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class HackathonController extends Controller
{
    public function create(Request $request)
    {
        // return "Ascascascasc";
        $oraganisateur = auth()->user();
        try {
                $hackathon = new  Hackathon ;
                $hackathon->title =  $request->title  ;
                $hackathon->lieu =  $request->lieu ;
                $hackathon->date = $request->date;
                $hackathon->total_team_member = $request->total_team;
                $hackathon->organisateur()->associate($oraganisateur);
                $hackathon->save();
                foreach($request->themes as $theme)
                {
                    $theme = Theme::where('name','=' , $theme)->first();
                    $theme->hackathon()->associate($hackathon);
                    $theme->save();
                }
                foreach($request->rules as $rule)
                {
                    $rule = Rule::where('name', '=', $rule)->first();
                    $rule->hackathon()->attach($hackathon->id);
                    $rule->save() ;
                }
            }catch(Exception $e)
            {
                return "error $e";
            }
            // return  "ascasc";
            return response()->json([
            'hackathon' => [
                $hackathon
             ] ,
             'rules' => [
                $hackathon->rules
             ],
              'themes' => [
                $hackathon->themes
              ]

        ]) ;
    }
    public   function update(Request $request ,$id)
    {
        $hackathon = $this->findHackathon($id);
        $hackathon->title =  $request->title  ;
        $hackathon->lieu =  $request->lieu ;
        $hackathon->date = $request->date;
        $hackathon->date = $request->date;
        $hackathon->save();
        return response()->json([
            'message'=> 'updated succesfully'
        ]);
    }
    public   function generalUpdate(Request $request ,$id)
    {
        $hackathon = $this->findHackathon($id);
        $hackathon->title =  $request->title  ;
        $hackathon->lieu =  $request->lieu ;
        $hackathon->date = $request->date ;
        $hackathon->date = $request->date ;
        $hackathon->total_team_member = $request->total_team ;
        $hackathon->save() ;
        return response()->json([
            'message'=> 'updated succesfully'
        ]) ;
    }
    public function findHackathon($id)
    {
        $hackathon = Hackathon::find($id);
        return $hackathon ;
    }
    public function delete($id)
    {

        $hackathon = $this->findHackathon($id);
        $hackathon->delete();
        return response()->json([
            'message'=> 'deleted succesfully'
        ]);
    }
    public function search($id)
    {
        $hackathon = $this->findHackathon($id);
        $rules =  $this->rules($hackathon->rules) ;
        $themes = $this->themes($hackathon->themes);
        $teams = $this->teams($hackathon->teams);
        // return $teams;
        $themes = "there's no themes";
        if(empty($rules)) $rules = "there's no rules";
        return response()->json([
            'hackathon' => [
                $hackathon
             ] ,
             'rules' => [
                $rules
             ],
              'themes' => [
                $themes
              ] ,
              'teams' => $teams
        ]) ;
    }
    public function teams($teams)
    {
        if(empty($teams)) return "there's no teams";
         return $teams ;

    }
    public function themes($themes)
    {
        if(empty($themes)) return "there's no themes";
         return $themes ;

    }
    public function rules($rules)
    {
        if(empty($rules)) return "there's no rules";
         return $rules ;
    }
}
