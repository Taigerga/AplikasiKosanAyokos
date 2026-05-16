<?php

namespace App\Http\Controllers\Web\Penghuni;

use App\Http\Controllers\Controller;
use App\Services\Analisis\AnalisisService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        protected AnalisisService $analisisService
    ) {}

    public function index()
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;

        if (!$penghuni) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai penghuni.');
        }

        $stats = $this->analisisService->getPenghuniDashboardStats($penghuni->id_penghuni);

        return view('penghuni.dashboard', array_merge(
            compact('user', 'penghuni'),
            $stats
        ));
    }
}
