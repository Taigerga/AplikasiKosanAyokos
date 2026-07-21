<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateStatusAkunRequest;
use App\Models\User;
use App\Models\Admin;
use App\Models\Penghuni;
use App\Models\Pemilik;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'admin');

        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        $stats = [
            'total' => User::where('role', 'admin')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'no_hp' => 'required|string|max:20',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'status_admin' => 'aktif',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::where('role', 'admin')->with('admin')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role', 'admin')->findOrFail($id);

        $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'no_hp' => 'required|string|max:20',
        ]);

        $data = ['username' => $request->username];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        if ($user->admin) {
            $user->admin->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::where('role', 'admin')->findOrFail($id);

        if (User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus admin terakhir.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin berhasil dihapus.');
    }

    public function dataPemilik(Request $request)
    {
        $query = Pemilik::with('user');

        if ($request->filled('status')) {
            $query->where('status_pemilik', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $dataPemilik = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.data-pemilik.index', compact('dataPemilik'));
    }

    public function showPemilik($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('admin.data-pemilik.show', compact('pemilik'));
    }

    public function updateStatusPemilik(UpdateStatusAkunRequest $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        $pemilik->update([
            'status_pemilik' => $request->status,
        ]);

        $pemilik->user->update([
            'status_updated_at' => now(),
            'status_updated_by' => auth()->id(),
            'status_alasan' => $request->alasan,
        ]);

        Notification::create([
            'id_user' => $pemilik->user_id,
            'type' => 'status_akun',
            'title' => 'Status Akun Diperbarui',
            'body' => "Status akun Anda diubah menjadi {$request->status}." . ($request->alasan ? " Alasan: {$request->alasan}" : ''),
            'link' => url('/pemilik/profile'),
            'is_read' => false,
        ]);

        return redirect()->route('admin.data-pemilik.show', $id)
            ->with('success', 'Status pemilik berhasil diperbarui.');
    }

    public function dataPenghuni(Request $request)
    {
        $query = Penghuni::with('user');

        if ($request->filled('status')) {
            $query->where('status_penghuni', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $dataPenghuni = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.data-penghuni.index', compact('dataPenghuni'));
    }

    public function showPenghuni($id)
    {
        $penghuni = Penghuni::with('user')->findOrFail($id);
        return view('admin.data-penghuni.show', compact('penghuni'));
    }

    public function updateStatusPenghuni(UpdateStatusAkunRequest $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);

        $penghuni->update([
            'status_penghuni' => $request->status,
        ]);

        $penghuni->user->update([
            'status_updated_at' => now(),
            'status_updated_by' => auth()->id(),
            'status_alasan' => $request->alasan,
        ]);

        Notification::create([
            'id_user' => $penghuni->user_id,
            'type' => 'status_akun',
            'title' => 'Status Akun Diperbarui',
            'body' => "Status akun Anda diubah menjadi {$request->status}." . ($request->alasan ? " Alasan: {$request->alasan}" : ''),
            'link' => url('/penghuni/profile'),
            'is_read' => false,
        ]);

        return redirect()->route('admin.data-penghuni.show', $id)
            ->with('success', 'Status penghuni berhasil diperbarui.');
    }
}
