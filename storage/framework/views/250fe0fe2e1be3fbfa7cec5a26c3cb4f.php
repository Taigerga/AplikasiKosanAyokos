<!DOCTYPE html>
<html>
<head>
    <title>Kontrak Ditolak</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f44336; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; }
        .button { display: inline-block; background: #f44336; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        .footer { margin-top: 20px; text-align: center; color: #666; font-size: 12px; }
        .reason-box { background: #ffebee; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>❌ Kontrak Sewa Ditolak</h1>
        </div>
        
        <div class="content">
            <p>Halo <strong><?php echo e($penghuni->nama); ?></strong>,</p>
            
            <p>Kami informasikan bahwa pengajuan sewa kamar Anda untuk <strong><?php echo e($kontrak->kos->nama_kos); ?></strong> telah <strong>DITOLAK</strong>.</p>
            
            <?php if($kontrak->alasan_ditolak): ?>
            <div class="reason-box">
                <p><strong>Alasan Penolakan:</strong></p>
                <p><?php echo e($kontrak->alasan_ditolak); ?></p>
            </div>
            <?php endif; ?>
            
            <div style="background: white; padding: 15px; border-left: 4px solid #f44336; margin: 20px 0;">
                <p><strong>Detail Pengajuan:</strong></p>
                <ul>
                    <li>Kos: <?php echo e($kontrak->kos->nama_kos); ?></li>
                    <li>Kamar: <?php echo e($kontrak->kamar->nomor_kamar); ?></li>
                    <li>Tipe: <?php echo e($kontrak->kamar->tipe_kamar); ?></li>
                    <li>Harga Sewa: Rp <?php echo e(number_format($kontrak->harga_sewa, 0, ',', '.')); ?>/<?php echo e($kontrak->unit_label_lower); ?></li>
                </ul>
            </div>
            
            <p>Anda dapat mencoba mengajukan sewa untuk kamar lain atau kos yang berbeda.</p>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="<?php echo e(url('/penghuni/kos')); ?>" class="button">
                    Cari Kos Lain
                </a>
            </p>
            
            <p>Terima kasih telah menggunakan layanan kami.</p>
            
            <p>Salam,<br>
            <strong>Tim Admin AyoKos</strong></p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; <?php echo e(date('Y')); ?> AyoKos. All rights reserved.</p>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\emails\penghuni\kontrak_ditolak.blade.php ENDPATH**/ ?>