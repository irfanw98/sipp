<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->User->getAllUsers())
                ->addColumn('aksi', function ($dataUser) {
                    return '
                    <a href="" class="btn btn-warning edit_user" role="button" id="' . $dataUser->id . '">Ubah</a>
                    <a href="" class="btn btn-danger hapus_user" role="button" id="' . $dataUser->id . '" nama_user="' . $dataUser->name . '">Hapus</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
            'email'    => $request->email
        ]);

        return redirect('/users')->with('message', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('admin.users.edit', [
            'user' => $this->User->getUserById($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        if (empty($request->password)){
            $dataUser = $request->except('password');
        } else {
            $dataUser = [
                'name'     => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role'     => $request->role,
                'email'    => $request->email
            ];
        }
        $this->User->getUserById($id)->update($dataUser);

        return redirect('/users')->with('message', 'Pengguna berhasil diubah.');
    }

    public function destroy($id)
    {
        if($this->User->getUserById($id)->id !== 1)
        {
            User::destroy($id);

            return response()->json(['success' => 'Pengguna berhasil dihapus.']);
        }
            return response()->json(['errors' => 'Pengguna gagal dihapus.']);
    }
}