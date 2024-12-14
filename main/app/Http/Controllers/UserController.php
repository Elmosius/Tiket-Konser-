<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('admin.users.index',[
            'users'=>$data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create',[
            'roles'=>Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = validator($request->all(),[
            'username'=>'required|string|unique:user',
            'email'=>'required|string|unique:user',
            'password'=>'required|string',
            'password_confirmation'=>'required|string',
            'nama'=>'required|string',
            'telepon'=>'required|string|max:11',
            'tanggal_lahir'=>'required|date',
            'jenis_kelamin'=>'required|max:1',
            'role'=>'required|max:10',
        ],[
            'username.required'=> 'Nama harus diisi',
            'username.unique'=> 'Nama sudah pernah didaftarkan',
            'password.required'=> 'Password harus diisi',
            'password_confirmation.required'=> 'Konfirmasi Password harus diisi',
            'email.required'=> 'Email harus diisi',
            'email.unique'=> 'Email sudag pernah diisi',
            'nama.required'=> 'Nama harus diisi',
            'telepon.required'=> 'Telepon harus diisi',
            'tanggal_lahir.required'=> 'Tanggal Lahir harus diisi',
            'jenis_kelamin.required'=>'Jenis Kelamin harus diisi',
            'role.required'=> 'Role harus diisi',
        ])->validate();

        if($validateData['password'] != $validateData['password_confirmation']){
            return redirect()->back()->withInput()->withErrors('Password tidak sama');
        }

        $id = IdGenerator::generate(['table' => 'user','field'=>'id', 'length' => 10, 'prefix' =>'USR-']);

        $user=new User($validateData);
        $user->id=$id;
        $user->save();

        return redirect(route('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'users'=>$user,
            'roles'=>Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validateData = validator($request->all(),[
            'username'=>['required','string',Rule::unique('user')->ignore($user->id),],
            'email'=>['required','string',Rule::unique('user')->ignore($user->id),],
            'password'=>'required|string',
            'password_confirmation'=>'nullable|string',
            'nama'=>'required|string',
            'telepon'=>'required|string|max:11',
            'tanggal_lahir'=>'required|date',
            'jenis_kelamin'=>'required|max:1',
            'role'=>'required|max:10',
        ],[
            'username.required'=> 'Username harus diisi',
            'username.unique'=> 'Username sudah pernah didaftarkan',
            'password.required'=> 'Password harus diisi',
            'password_confirmation.required'=> 'Konfirmasi Password harus diisi',
            'email.required'=> 'Email harus diisi',
            'email.unique'=> 'Email sudag pernah diisi',
            'nama.required'=> 'Nama harus diisi',
            'telepon.required'=> 'Telepon harus diisi',
            'tanggal_lahir.required'=> 'Tanggal Lahir harus diisi',
            'jenis_kelamin.required'=>'Jenis Kelamin harus diisi',
            'role.required'=> 'Role harus diisi',
        ])->validate();

        if($user->password != $request->password){
            if(!empty($validateData['password_confirmation'])){
                if($validateData['password'] != $validateData['password_confirmation']){
                    return redirect()->back()->withInput()->withErrors('Password tidak sama');
                }else{
                    $user->password=$validateData['password'];
                }
            }else{
                return redirect()->back()->withInput()->withErrors('Konfirmasi belum diisi');
            }
        }

        $user->username=$validateData['username'];
        $user->email=$validateData['email'];
        $user->nama=$validateData['nama'];
        $user->telepon=$validateData['telepon'];
        $user->tanggal_lahir=$validateData['tanggal_lahir'];
        $user->jenis_kelamin=$validateData['jenis_kelamin'];
        $user->role=$validateData['role'];
        $user->save();

        return redirect(route('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users');
    }
}