<?php

namespace App\Http\Controllers\API;

use App\Models\Notification;
use App\Services\Notification\KontrakNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends ApiController
{
    public function __construct(
        protected KontrakNotificationService $notificationService
    ) {}

    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::where('id_user', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $unreadCount = Notification::where('id_user', $user->id)
            ->where('is_read', false)
            ->count();

        return $this->success([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    public function unreadCount()
    {
        $count = Notification::where('id_user', Auth::id())
            ->where('is_read', false)
            ->count();

        return $this->success(['unread_count' => $count]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id_notifikasi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $notification->markAsRead();

        return $this->success(null, 'Notifikasi ditandai sudah dibaca');
    }

    public function markAllAsRead()
    {
        Notification::where('id_user', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return $this->success(null, 'Semua notifikasi ditandai sudah dibaca');
    }

    // === Existing email-trigger methods (keep for backward compat) ===

    public function sendMenungguPersetujuan($kontrakId)
    {
        $result = $this->notificationService->sendMenungguPersetujuan($kontrakId);
        return $result
            ? $this->success(null, 'Notifikasi menunggu persetujuan dikirim')
            : $this->error('Gagal mengirim notifikasi');
    }

    public function sendPersetujuanDiterima($kontrakId)
    {
        $result = $this->notificationService->sendPersetujuanDiterima($kontrakId);
        return $result
            ? $this->success(null, 'Notifikasi persetujuan diterima dikirim')
            : $this->error('Gagal mengirim notifikasi');
    }

    public function sendPersetujuanDitolak($kontrakId)
    {
        $result = $this->notificationService->sendPersetujuanDitolak($kontrakId);
        return $result
            ? $this->success(null, 'Notifikasi persetujuan ditolak dikirim')
            : $this->error('Gagal mengirim notifikasi');
    }

    public function sendPengajuanBaru($kontrakId)
    {
        $result = $this->notificationService->sendPengajuanBaru($kontrakId);
        return $result
            ? $this->success(null, 'Notifikasi pengajuan baru dikirim')
            : $this->error('Gagal mengirim notifikasi');
    }
}
