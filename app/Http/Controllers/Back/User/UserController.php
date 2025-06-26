<?php

namespace App\Http\Controllers\Back\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Section;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(!auth()->user()->role->canRead(Section::find(11))) {
			abort(403);
		}
		
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
		if(!auth()->user()->role->canWrite(Section::find(11))) {
			abort(403);
		}
		
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
		if(!auth()->user()->role->canWrite(Section::find(11))) {
			abort(403);
		}
		
        $validated = $request->validate([
			'name' => 'required|string',
			'email' => 'required|string|email|unique:users',
			'role_id' => 'required|exists:roles,id',
			'password' => 'required|string|min:6'
		], [
			'name.required' => 'El nombre es obligatorio.',
			'email.required' => 'El correo electrónico es obligatorio.',
			'email.email' => 'El correo electrónico no es válido.',
			'email.unique' => 'Este correo ya está registrado.',
			'role_id.required' => 'Debe seleccionar un rol.',
			'role_id.exists' => 'El rol seleccionado no es válido.',
			'password.required' => 'La contraseña es obligatoria.',
			'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
		]);

        $user = new User($validated);
        $user->password = bcrypt($validated['password']);
        $user->active = $request->has('active');
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
		if(!auth()->user()->role->canWrite(Section::find(11))) {
			abort(403);
		}
		
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
        if(!auth()->user()->role->canWrite(Section::find(11))) {
			abort(403);
		}

		$validated = $request->validate([
			'name' => 'required|string',
			'email' => [
				'required',
				'string',
				'email',
				Rule::unique('users', 'email')->ignore($id),
			],
			'role_id' => 'required|exists:roles,id',
		], [
			'name.required' => 'El nombre es obligatorio.',
			'email.required' => 'El correo electrónico es obligatorio.',
			'email.email' => 'El correo electrónico no es válido.',
			'email.unique' => 'Este correo ya está registrado por otro usuario.',
			'role_id.required' => 'Debe seleccionar un rol.',
			'role_id.exists' => 'El rol seleccionado no es válido.',
		]);

        $user = User::findOrFail($id);
        $user->update($validated);

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
        if(!auth()->user()->role->canWrite(Section::find(11))) {
			abort(403);
		}
		
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
        if(!auth()->user()->role->canWrite(Section::find(11))) {
			abort(403);
		}
		
        $user = User::findOrFail($request->id);
        $user->active = !$user->active;

        $user->save();

        return response()->json([
            "state" => $user->active
        ]);
    }
}

