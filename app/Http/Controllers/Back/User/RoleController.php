<?php

namespace App\Http\Controllers\Back\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Section;
use App\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('back.configuration.roles.index', ['roles' => $roles]);
    }

    public function create(){
        return view('back.configuration.roles.create', ['sections' => Section::all()]);
    }

    public function update(Request $request, $id){
        $request->validate([
            "name" => "required|string",
            "sections"=>"array"
        ]);
            //TODO update this 
        $role = Role::findOrFail($id);
        //creamos permisos para las secciones enviadas
        foreach($request->sections as $section){
            $permission = $role->permissions->where('section_id', $section['section_id'])->first();
            //las secciones que tiene un length de 1 
            //solo contienen el id, no se deben añadir
            if(sizeof($section) > 1 && !$permission){
                Permission::create([
                    "read" => isset($section['read']) ? true: false,
                    "write" => isset($section['write']) ? true: false,
                    "role_id" => $role->id,
                    "section_id" => $section["section_id"]
                ]);
            }elseif($permission){
                $permission->update([
                    "read" => isset($section['read']) ? true: false,
                    "write" => isset($section['write']) ? true: false,
                    "role_id" => $role->id,
                    "section_id" => $section["section_id"]
                ]);
            }
        }
        return redirect()->route('roles.index')->with('success', 'El role ha sido actualizado correctamente');

    }

    public function store(Request $request){
        $request->validate([
            "name" => "required|string|unique:roles",
            "sections"=>"array"
        ]);

        $role = Role::create([
            "name" => $request->name
        ]);
        
        //creamos permisos para las secciones enviadas
        foreach($request->sections as $section){

            //las secciones que tiene un length de 1 
            //solo contienen el id, no se deben añadir
            if(sizeof($section) > 1){
                Permission::create([
                    "read" => isset($section['read']) ? true: false,
                    "write" => isset($section['write']) ? true: false,
                    "role_id" => $role->id,
                    "section_id" => $section["id"]
                ]);
            }
        }

        return redirect()->route('roles.index')->with('success', 'El role ha sido creado correctamente');
    }

    public function edit(Request $request, $id){
        $role = Role::findOrFail($id);

        return view('back.configuration.roles.edit', [
            'role' => $role,
            'sections' => Section::all()
            ]);
    }

    public function destroy($id){
        //
        $role = Role::findOrFail($id);
        if($role->users->count() > 0){
            return response()->json(["error" => "No se puede eleminar"], 403);
        }else{
            $role->delete();
            return response()->json(["success" => "Role eleminado correctamente"]);
        }
    }
}
