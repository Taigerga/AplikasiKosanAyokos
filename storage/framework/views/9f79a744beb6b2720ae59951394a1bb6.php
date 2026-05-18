<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Tenggat Waktu Penghuni</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { 
            <?php if($tipeNotifikasi == 'terlambat'): ?>
                background: #f44336;
            <?php elseif($tipeNotifikasi == 'tenggat'): ?>
                background: #ff9800;
            <?php else: ?>
                background: #607D8B;
            <?php endif; ?>
            color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; 
        }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; }
        .button { 
            <?php if($tipeNotifikasi == 'terlambat'): ?>
                background: #f44336;
            <?php elseif($tipeNotifikasi == 'tenggat'): ?>
                background: #ff9800;
            <?php else: ?>
                background: #607D8B;
            <?php endif; ?>
            display: inline-block; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; 
        }
        .footer { margin-top: 20px; text-align: center; color: #666; font-size: 12px; }
        .urgent { background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .penghuni-info { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <?php if($tipeNotifikasi == '7_hari'): ?>
                <h1>📅 7 Hari Lagi Kontrak Penghuni Berakhir</h1>
            <?php elseif($tipeNotifikasi == '3_hari'): ?>
                <h1>⚠️ 3 Hari Lagi Kontrak Penghuni Berakhir</h1>
            <?php elseif($tipeNotifikasi == '1_hari'): ?>
                <h1>🚨 Besok Kontrak Penghuni Berakhir!</h1>
            <?php elseif($tipeNotifikasi == 'tenggat'): ?>
                <h1>🔴 Kontrak Penghuni Berakhir Hari Ini!</h1>
            <?php elseif($tipeNotifikasi == 'terlambat'): ?>
                <h1>⛔ Kontrak Penghuni Telah Melewati Tenggat Waktu!</h1>
            <?php endif; ?>
        </div>
        
        <div class="content">
            <p>Halo <strong><?php echo e($pemilik->nama); ?></strong>,</p>
            
            <?php if($tipeNotifikasi == 'terlambat'): ?>
                <div class="urgent">
                    <p><strong>PENTING:</strong> Kontrak sewa penghuni telah melewati tenggat waktu!</p>
                    <p>Segera tindak lanjuti untuk menghindari kerugian.</p>
                </div>
            <?php elseif($tipeNotifikasi == 'tenggat'): ?>
                <div class="urgent">
                    <p><strong>PERHATIAN:</strong> Kontrak sewa penghuni berakhir hari ini!</p>
                    <p>Segera konfirmasi perpanjangan atau persiapan kamar.</p>
                </div>
            <?php endif; ?>
            
            <p>Kontrak sewa penghuni untuk <strong><?php echo e($kontrak->kos->nama_kos); ?></strong> akan berakhir dalam:</p>
            
            <div style="background: white; padding: 15px; text-align: center; margin: 20px 0; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h2 style="color: #f44336; margin: 0;">
                    <?php if($tipeNotifikasi == 'terlambat'): ?>
                        TELAH BERAKHIR
                    <?php elseif($tipeNotifikasi == 'tenggat'): ?>
                        HARI INI
                    <?php else: ?>
                        <?php echo e($hariTersisa); ?> HARI LAGI
                    <?php endif; ?>
                </h2>
                <p style="margin: 10px 0 0 0; color: #666;">
                    Tanggal Berakhir: <?php echo e(date('d F Y', strtotime($kontrak->tanggal_selesai))); ?>

                </p>
            </div>
            
            <div class="penghuni-info">
                <p><strong>Informasi Penghuni:</strong></p>
                <ul>
                    <li>Nama: <?php echo e($penghuni->nama); ?></li>
                    <li>Email: <?php echo e($penghuni->email); ?></li>
                    <li>No. HP: <?php echo e($penghuni->no_hp); ?></li>
                    <li>Kamar: <?php echo e($kontrak->kamar->nomor_kamar); ?></li>
                </ul>
            </div>
            
            <div style="background: white; padding: 15px; border-left: 4px solid #607D8B; margin: 20px 0;">
                <p><strong>Detail Kontrak:</strong></p>
                <ul>
                    <li>Kos: <?php echo e($kontrak->kos->nama_kos); ?></li>
                    <li>Kamar: <?php echo e($kontrak->kamar->nomor_kamar); ?> (<?php echo e($kontrak->kamar->tipe_kamar); ?>)</li>
                    <li>Tanggal Mulai: <?php echo e(date('d F Y', strtotime($kontrak->tanggal_mulai))); ?></li>
                    <li>Tanggal Selesai: <?php echo e(date('d F Y', strtotime($kontrak->tanggal_selesai))); ?></li>
                    <li>Durasi: <?php echo e($kontrak->durasi_sewa); ?> <?php echo e($kontrak->unit_label_lower); ?></li>
                    <li>Harga Sewa: Rp <?php echo e(number_format($kontrak->harga_sewa, 0, ',', '.')); ?>/<?php echo e($kontrak->unit_label_lower); ?></li>
                </ul>
            </div>
            
            <?php if($tipeNotifikasi == 'terlambat'): ?>
                <p><strong>Rekomendasi Tindakan:</strong></p>
                <ul>
                    <li>Hubungi penghuni untuk konfirmasi perpanjangan</li>
                    <li>Jika tidak diperpanjang, siapkan proses pengosongan kamar</li>
                    <li>Periksa kondisi kamar dan peralatan</li>
                    <li>Persiapkan kamar untuk calon penghuni baru</li>
                </ul>
            <?php else: ?>
                <p><strong>Rekomendasi Tindakan:</strong></p>
                <ul>
                    <li>Hubungi penghuni untuk konfirmasi perpanjangan kontrak</li>
                    <li>Siapkan dokumen perpanjangan jika diperlukan</li>
                    <li>Periksa ketersediaan kamar untuk perpanjangan</li>
                </ul>
            <?php endif; ?>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="<?php echo e(url('/pemilik/kontrak/' . $kontrak->id_kontrak)); ?>" class="button">
                    Lihat Detail Kontrak
                </a>
                &nbsp;&nbsp;
                <a href="<?php echo e(url('/pemilik/kontrak/' . $kontrak->id_kontrak . '/renew')); ?>" style="background: #4CAF50;" class="button">
                    Proses Perpanjangan
                </a>
            </p>
            
            <p>Salam,<br>
            <strong>Tim Admin Kosan App</strong></p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; <?php echo e(date('Y')); ?> Kosan App. All rights reserved.</p>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\emails\pemilik\tenggat_waktu.blade.php ENDPATH**/ ?>