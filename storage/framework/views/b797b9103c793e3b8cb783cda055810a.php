<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Sewa Baru</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #9C27B0; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; }
        .button { display: inline-block; background: #9C27B0; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        .footer { margin-top: 20px; text-align: center; color: #666; font-size: 12px; }
        .applicant-info { background: white; padding: 15px; border-left: 4px solid #9C27B0; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Pengajuan Sewa Baru</h1>
        </div>
        
        <div class="content">
            <p>Halo <strong><?php echo e($pemilik->nama); ?></strong>,</p>
            
            <p>Anda memiliki pengajuan sewa baru untuk kos <strong><?php echo e($kontrak->kos->nama_kos); ?></strong>.</p>
            
            <div class="applicant-info">
                <p><strong>Data Calon Penghuni:</strong></p>
                <ul>
                    <li>Nama: <?php echo e($kontrak->penghuni->nama); ?></li>
                    <li>Email: <?php echo e($kontrak->penghuni->email); ?></li>
                    <li>No. HP: <?php echo e($kontrak->penghuni->no_hp); ?></li>
                    <li>Jenis Kelamin: <?php echo e($kontrak->penghuni->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); ?></li>
                </ul>
            </div>
            
            <div style="background: white; padding: 15px; border-left: 4px solid #2196F3; margin: 20px 0;">
                <p><strong>Detail Pengajuan:</strong></p>
                <ul>
                    <li>Kos: <?php echo e($kontrak->kos->nama_kos); ?></li>
                    <li>Kamar: <?php echo e($kontrak->kamar->nomor_kamar); ?></li>
                    <li>Tipe Kamar: <?php echo e($kontrak->kamar->tipe_kamar); ?></li>
                    <li>Durasi Sewa: <?php echo e($kontrak->durasi_sewa); ?> <?php echo e($kontrak->unit_label_lower); ?></li>
                    <li>Harga Sewa: Rp <?php echo e(number_format($kontrak->harga_sewa, 0, ',', '.')); ?>/<?php echo e($kontrak->unit_label_lower); ?></li>
                    <li>Tanggal Daftar: <?php echo e(date('d F Y', strtotime($kontrak->tanggal_daftar))); ?></li>
                </ul>
            </div>
            
            <p>Silakan tinjau pengajuan ini dan berikan keputusan.</p>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="<?php echo e(url('/pemilik/kontrak/' . $kontrak->id_kontrak . '/review')); ?>" class="button">
                    Tinjau Pengajuan
                </a>
            </p>
            
            <p>Salam,<br>
            <strong>Tim Admin AyoKos</strong></p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; <?php echo e(date('Y')); ?> AyoKos. All rights reserved.</p>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/emails/pemilik/pengajuan_baru.blade.php ENDPATH**/ ?>