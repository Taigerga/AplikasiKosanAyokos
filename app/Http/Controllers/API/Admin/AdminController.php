<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends ApiController
{
    public function index()
    {
        $admins = User::where('role', 'admin')->with('admin')->paginate(10);
        return $this->paginated($admins);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:50|unique:users,username',
                'password' => 'required|string|min:8',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'no_hp' => 'required|string|max:20',
            ]);

            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => 'admin',
            ]);

            $user->admin()->create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
            ]);

            return $this->created($user->load('admin'), 'Admin berhasil ditambahkan');
        } catch (\Exception $e) {
            return $this->error('Gagal menambahkan admin.', 500);
        }
    }

    public function show($id)
    {
        $admin = User::where('role', 'admin')->with('admin')->find($id);
        if (!$admin) return $this->notFound('Admin tidak ditemukan');
        return $this->success($admin);
    }

    public function update(Request $request, $id)
    {
        try {
            $admin = User::where('role', 'admin')->with('admin')->findOrFail($id);

            $request->validate([
                'username' => 'required|string|max:50|unique:users,username,' . $id,
                'password' => 'nullable|string|min:8',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'no_hp' => 'required|string|max:20',
            ]);

            $admin->update([
                'username' => $request->username,
                'password' => $request->password ? bcrypt($request->password) : $admin->password,
            ]);

            $admin->admin->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
            ]);

            return $this->success($admin->load('admin'), 'Admin berhasil diperbarui');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui admin.', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $admin = User::where('role', 'admin')->findOrFail($id);
            $admin->admin()->delete();
            $admin->delete();

            return $this->success(null, 'Admin berhasil dihapus');
        } catch (\Exception $e) {
            return $this->error('Gagal menghapus admin.', 500);
        }
    }
}
