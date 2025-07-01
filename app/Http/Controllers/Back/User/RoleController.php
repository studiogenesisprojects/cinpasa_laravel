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
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.configuracion'));
    }
    
    public function index(){
		$this->authorize('read', $this->section);

        $roles = Role::all();
        return view('back.configuration.roles.index', ['roles' => $roles]);
    }

    public function create(){
		$this->authorize('write', $this->section);
        
        return view('back.configuration.roles.create', ['sections' => Section::all()]);
    }

    public function update(Request $request, $id){
		$this->authorize('write', $this->section);
        
        $request->validate([
            "name" => "required|string",
            "sections"=>"array"
        ]);

        $role = Role::findOrFail($id);
		
		$role->update([
			'name' => $request->input('name'),
		]);
		
        //creamos permisos para las secciones enviadas
        foreach($request->sections as $section){
            $permission = $role->permissions->where('section_id', $section['section_id'])->first();
            //las secciones que tiene un length de 1 
            //solo contienen el id, no se deben añadir
            if(sizeof($section) > 1 && !$permission){
                Permission::create([
                    "read" => isset($section['read']) ? true: false,
                    "write" => isset($section['write']) ? true: false,
                    "delete" => isset($section['delete']) ? true: false,
                    "role_id" => $role->id,
                    "section_id" => $section["section_id"]
                ]);
            }elseif($permission){
                $permission->update([
                    "read" => isset($section['read']) ? true: false,
                    "write" => isset($section['write']) ? true: false,
                    "delete" => isset($section['delete']) ? true: false,
                    "role_id" => $role->id,
                    "section_id" => $section["section_id"]
                ]);
            }
        }
        return redirect()->route('roles.index')->with('success', 'El role ha sido actualizado correctamente');

    }

    public function store(Request $request){
		$this->authorize('write', $this->section);
        
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
                    "delete" => isset($section['delete']) ? true: false,
                    "role_id" => $role->id,
                    "section_id" => $section["section_id"]
                ]);
            }
        }

        return redirect()->route('roles.index')->with('success', 'El role ha sido creado correctamente');
    }

    public function edit(Request $request, $id){
		$this->authorize('write', $this->section);

        $role = Role::findOrFail($id);

        return view('back.configuration.roles.edit', [
            'role' => $role,
            'sections' => Section::all()
            ]);
    }

    public function destroy($id){
		$this->authorize('delete', $this->section);
        
        $role = Role::findOrFail($id);
        if($role->users->count() > 0){
            return response()->json(["error" => "No se puede eleminar"], 403);
        }else{
            $role->delete();
            return response()->json(["success" => "Role eleminado correctamente"]);
        }
    }
}
