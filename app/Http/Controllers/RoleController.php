<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function showAllRoles()
    {
        // return "ascasc";
        $roles = Role::all();
        if(!$roles) return response()->json(['message'=>'no roles']);
        return $roles ;
    }
    public function create(Request $request)
    {
        // return "ascasc";

        try{
            // return $request->name ;
            $role = Role::create([
                'name'=> $request->name,
                'description' => $request->description
            ]);
            // throw new Exception( "aascasc");
        }catch(Exception $e){
            return "error $e";
        }
        return $role ;
    }
    public function update(Request $request , $id)
    {
        $role = Role::find($id);
        $role->name = $request->name ;
        $role->description  = $request->description ;
        $role->save ;
        return response()->json([
            'message'=>'updated succesfully'
        ]);
    }
    public function delete($id)
    {
        $role = $this->findById($id);
        $role->delete();
        return response()->json([
            'message'=>'deleted succesfully'
        ]);
    }
    public function findById($id)
    {
        $role = Role::find($id);
        return $role ;
    }
}
