<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.create')->only('create','store');
        // $this->middleware('can:users.destroy')->only('destroy');
    }

    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt('12345678'),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        return redirect()->route('users.edit', $user)
            ->with('success', 'Roles asignados correctamente');
    }

    public function resetPassword($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->password = bcrypt('12345678');
            $user->save();
            DB::commit();
            return redirect()->back()->with("success", "Contraseña modificada correctamente.");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with("error", "Ha ocurrido un error, no se registraron los cambios.");
        }
    }

    // public function destroy($id)
    // {
    //     $user = User::find($id)->delete();

    //     return redirect()->route('users.index')
    //         ->with('success', 'User deleted successfully');
    // }
}
