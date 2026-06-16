<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #f44336 0%, #e91e63 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .payment-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .status-pending {
            border-left: 4px solid #ff9800;
        }
        .status-approved {
            border-left: 4px solid #4caf50;
        }
        .status-rejected {
            border-left: 4px solid #f44336;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #f44336;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .pemilik-badge {
            background: #f44336;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏠 AyoKos</h1>
        <h2><span class="pemilik-badge">PEMILIK</span> Notifikasi Pembayaran</h2>
    </div>
    
    <div class="content">
        <p>Hai <strong><?php echo e($userName ?? 'Pemilik'); ?></strong> (Pemilik),</p>
        
        <p><?php echo $emailMessage; ?></p>
        
        <div class="payment-info <?php echo e($type == 'pending_pemilik' ? 'status-pending' : ($type == 'approved_pemilik' ? 'status-approved' : 'status-rejected')); ?>">
            <h3>Detail Pembayaran:</h3>
            <p><strong>Kos:</strong> <?php echo e($kosName); ?> <?php if($roomNumber): ?> (Kamar <?php echo e($roomNumber); ?>) <?php endif; ?></p>
            <p><strong>Penghuni:</strong> <?php echo e($penghuniName); ?></p>
            <p><strong>Jumlah:</strong> <span class="amount">Rp <?php echo e(number_format($amount, 0, ',', '.')); ?></span></p>
            <p><strong>Periode:</strong> <?php echo e($period); ?></p>
            <p><strong>Tanggal Bayar:</strong> <?php echo e($paymentDate); ?></p>
            <p><strong>Metode:</strong> <?php echo e(ucfirst($metodePembayaran)); ?></p>
            
            <?php if($type == 'approved_pemilik'): ?>
                <p><strong>Status:</strong> ✅ Lunas</p>
                <p><strong>Tanggal Disetujui:</strong> <?php echo e($approvedDate ?? '-'); ?></p>
            <?php elseif($type == 'rejected_pemilik'): ?>
                <p><strong>Status:</strong> ❌ Ditolak</p>
            <?php else: ?>
                <p><strong>Status:</strong> ⏳ Menunggu Verifikasi</p>
            <?php endif; ?>
        </div>
        
        <?php if($type == 'pending_pemilik'): ?>
            <p>Silakan login ke dashboard pemilik untuk melakukan verifikasi pembayaran.</p>
            <a href="<?php echo e(url('/pemilik/login')); ?>" class="btn">Verifikasi Pembayaran</a>
        <?php elseif($type == 'approved_pemilik'): ?>
            <p>Pembayaran telah berhasil dikonfirmasi dan ditambahkan ke pendapatan Anda.</p>
        <?php else: ?>
            <p>Anda telah menolak pembayaran ini. Penghuni perlu mengupload ulang bukti pembayaran.</p>
        <?php endif; ?>
    </div>
    
    <div class="footer">
        <p>© 2026 AyoKos - Platform Sewa Kos Terpercaya</p>
        <p>Email ini dikirim secara otomatis, jangan membalas email ini.</p>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/emails/pemilik/pembayaran_notification.blade.php ENDPATH**/ ?>