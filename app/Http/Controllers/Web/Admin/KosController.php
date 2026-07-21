<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index(Request $request)
    {
        $query = Kos::with('pemilik');

        if ($request->filled('status')) {
            $query->where('status_kos', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('nama_kos', 'like', '%' . $request->search . '%');
        }

        $kosList = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.kos.index', compact('kosList'));
    }

}
