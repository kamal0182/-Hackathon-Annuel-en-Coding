<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function showAllRules()
    {
        // return "Ascascasc";
        $rules =  Rule::all();
        // return  $rules ;
        if(!empty($rules)){
            return $rules ;
        }
        return response()->json([
            'message'=> 'there"s no rules'
        ]);
    }
    public function create(Request $request)
    {
        foreach($request->name as $name){

        $validated = $name->validate([
            'name' => 'required'
        ]) ;
            $rule = Rule::create([
                'name' => $name
            ]);
        }
        return response()->json([
            'message' => 'creted succesfully'
        ]);
    }
    public function update(Request $request , $id)
    {
        $rule = $this->findById($id);
        $rule->name =  $request->name ;
        $rule->save();
        return $rule ;
    }
    public function findById($id)
    {
        $rule = Rule::find($id);
        if($rule){
            return $rule ;
        }
    }
    public function delete($id)
    {
        $rule = $this->findById($id);
        $rule->delete();
        return response()->json([
            'message' => 'deleted succesfully'
        ]);
    }
}
