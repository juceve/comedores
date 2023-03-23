<?php

namespace App\Http\Controllers;

use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.edit')->only('edit','update');
        $this->middleware('can:roles.create')->only('create','store');
        $this->middleware('can:roles.destroy')->only('destroy');
    }
    public function index()
    {
        $roles = Role::where('name','!=','SuperAdmin')->get();
        return view('roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create',compact('permissions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->permissions()->sync($request->permissions);
        // dd($role);
        return redirect()->route('roles.edit',$role)->with('success','El rol se registró correctamente');
        
    }

  
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role','permissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.edit',$role)->with('success','El rol se actualizó correctamente');
    }

  
    public function destroy(Role $role)
    {
        $role->delete();       

        return redirect()->route('roles.index')->with('success','El rol se eliminó correctamente');
    }
}
