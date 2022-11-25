<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Data Users";
        $data = User::get();
        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Tambah Users";
        $role = Role::get();
        return view('users.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => ['required', 'string','unique:users'],
                'nama' => ['required', 'string'],
                'password' => ['required'],
                'role_id' => ['sometimes','required'],
            ],
            [
                'username.required' => 'Silahkan isi username',
                'username.unique' => 'username sudah digunakan!',
                'nama.required' => 'Silahkan isi nama',
                'password.required' => 'Silahkan isi password',
                'role_id.required' => 'Silahkan pilih role',
            ]
        );
        try {
            $user = User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);
            $user->assignRole($request->role_id);
            return redirect('users')->with('message', 'Data Berhasil Disimpan!');
        } catch (\Throwable $th) {
            return redirect('users')->with('failed', 'Data Gagal Disimpan!');
        }

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
        $title ="Edit Users";
        $user = User::findOrFail($id);
        $userRole = $user->roles->first();
        $role = Role::get();
        return view('users.edit', compact('user', 'userRole', 'role'));
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
        $request->validate(
            [
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'nama' => ['required', 'string'],
                'password' => ['required'],
                'role_id' => ['sometimes', 'required'],
            ],
            [
                'username.required' => 'Silahkan isi username',
                'username.unique' => 'username sudah digunakan!',
                'nama.required' => 'Silahkan isi nama',
                'password.required' => 'Silahkan isi password',
                'role_id.required' => 'Silahkan pilih role',
            ]

        );
        try {
            $user = User::find($id);
            $saved = $user->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);
            return redirect('users')->with('message', 'Data Berhasil Diubah!');
        } catch (\Throwable $th) {
            return redirect('users')->with('failed', 'Data Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('users')->with('message', 'Data Berhasil Dihapus!');
        } catch (\Throwable $th) {
            return redirect('users')->with('failed', 'Data Gagal Dihapus!');
        }

    }
}
