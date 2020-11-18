<?php

namespace App\Http\Controllers\Back\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('read', User::class);
        $users = User::all();

        return view('back.configuration.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('write', User::class);
        return view('back.configuration.users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('write', User::class);

        $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users",
            "role_id" => "required",
            "password" => "required|string"
        ]);     
       
        $user = new User($request->toArray());
        $user->role_id = $request->role_id;
        $user->active = $request->active ?  true : false;
        $user->save();
        return redirect()->route('usuarios.index')->with('success', 'El usuario ha sido creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('write', User::class);
        $user = User::findOrFail($id);

        return view('back.configuration.users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('write', User::class);
        $request->validate([
            "name" => "required|string",
            "email" => "required|string",
            "role_id" => "required",
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->route('usuarios.index')->with('success', 'El usuario ha sido actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('write', User::class);
        $user = User::findOrFail($id);

        if ($user->id == $request->user()->id)
            return response()->json(["error" => "No puedes eliminar tu propia cuenta"], 403);

        $user->delete();
        return response()->json(["success" => "Usuario eliminado correctamente"]);
    }

    /**
     * Cambiar el estado de la cuenta (activa, inactiva)
     */
    public function toggle(Request $request)
    {
        $this->authorize('write', User::class);
        $user = User::findOrFail($request->id);
        $user->active = !$user->active;

        $user->save();

        return response()->json([
            "state" => $user->active
        ]);
    }
}


