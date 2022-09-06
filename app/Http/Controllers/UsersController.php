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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'nama' => ['required', 'string'],
                'password' => ['required'],
                'role_id' => ['sometimes','required'],
            ],
            [
                'email.required' => 'Silahkan isi email',
                'email.unique' => 'Email sudah digunakan!',
                'nama.required' => 'Silahkan isi nama',
                'password.required' => 'Silahkan isi password',
                'role_id.required' => 'Silahkan pilih role',
            ]

        );

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->assignRole($request->role_id);
        return redirect('admin/users')->with('message', 'Data Add Successfully');
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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'nama' => ['required', 'string'],
                'password' => ['required'],
                'role_id' => ['sometimes', 'required'],
            ],
            [
                'email.required' => 'Silahkan isi email',
                'email.unique' => 'Email sudah digunakan!',
                'nama.required' => 'Silahkan isi nama',
                'password.required' => 'Silahkan isi password',
                'role_id.required' => 'Silahkan pilih role',
            ]

        );
        $user = User::find($id);

        $saved = $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($saved) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->role_id);
            return redirect('admin/users')->with('message', 'Data Update Successfully');
        } else {
            return redirect('admin/users')->with('message', 'Data Update Successfully');
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
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/users')->with('message', 'Data Delete Successfully');
    }
}
