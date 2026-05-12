<!DOCTYPE html>
<html>
<head>
    <title>Kontrak Diterima</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #4CAF50; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; }
        .button { display: inline-block; background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        .footer { margin-top: 20px; text-align: center; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Kontrak Sewa Diterima!</h1>
        </div>
        
        <div class="content">
            <p>Halo <strong><?php echo e($penghuni->nama); ?></strong>,</p>
            
            <p>Selamat! Pengajuan sewa kamar Anda untuk <strong><?php echo e($kontrak->kos->nama_kos); ?></strong> telah <strong>DISETUJUI</strong>.</p>
            
            <div style="background: white; padding: 15px; border-left: 4px solid #4CAF50; margin: 20px 0;">
                <p><strong>Detail Kontrak:</strong></p>
                <ul>
                    <li>Kos: <?php echo e($kontrak->kos->nama_kos); ?></li>
                    <li>Kamar: <?php echo e($kontrak->kamar->nomor_kamar); ?></li>
                    <li>Tipe: <?php echo e($kontrak->kamar->tipe_kamar); ?></li>
                    <li>Tanggal Mulai: <?php echo e(date('d F Y', strtotime($kontrak->tanggal_mulai))); ?></li>
                    <li>Tanggal Selesai: <?php echo e(date('d F Y', strtotime($kontrak->tanggal_selesai))); ?></li>
                    <li>Durasi: <?php echo e($kontrak->durasi_sewa); ?> <?php echo e($kontrak->unit_label_lower); ?></li>
                    <li>Harga Sewa: Rp <?php echo e(number_format($kontrak->harga_sewa, 0, ',', '.')); ?>/<?php echo e($kontrak->unit_label_lower); ?></li>
                </ul>
            </div>
            
            <p>Silakan melakukan pembayaran pertama Anda sesuai dengan ketentuan yang berlaku.</p>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="<?php echo e(url('/penghuni/kontrak/' . $kontrak->id_kontrak)); ?>" class="button">
                    Lihat Detail Kontrak
                </a>
            </p>
            
            <p>Jika Anda memiliki pertanyaan, silakan hubungi pemilik kos.</p>
            
            <p>Salam,<br>
            <strong>Tim Admin AyoKos</strong></p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; <?php echo e(date('Y')); ?> AyoKos. All rights reserved.</p>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/emails/penghuni/kontrak_diterima.blade.php ENDPATH**/ ?>