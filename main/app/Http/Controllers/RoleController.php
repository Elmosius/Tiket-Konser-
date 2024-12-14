<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::all();
        return view('admin.roles.index',[
            'roles'=> $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create',[
            // nanti isinya yang diperluin buat create role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:255|unique:role,nama_role',
        ],[
            'nama_role.required' => 'Nama Role tidak boleh kosong',
            'nama_role.unique' => 'Nama Role sudah pernah ditambahkan',

        ]);

        $id = IdGenerator::generate(['table'=>'role','field'=>'id','length'=>'10', 'prefix'=>'ROLE-']);

        $role = new Role();
        $role->id = $id;
        $role-> nama_role = $request['nama_role'];
        $role->save();

        return redirect()->route('roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit',[
            'roles'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validateData = validator($request->all(), [
            'nama_role' => ['required', 'string', 'max:255', Rule::unique('role', 'nama_role')->ignore($role->id, 'id')],
        ],[
            'nama_role.required'=>'Nama role belum terisi',
            'nama_role.unique'=>'Nama role sudah pernah ditambahkan '
        ])-> validate();

        $role->nama_role = $validateData['nama_role'];
        $role->save();
        return redirect(route('roles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles');
    }
}