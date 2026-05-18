<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Tenggat Waktu</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { 
            <?php if($tipeNotifikasi == 'terlambat'): ?>
                background: #f44336;
            <?php elseif($tipeNotifikasi == 'tenggat'): ?>
                background: #ff9800;
            <?php else: ?>
                background: #2196F3;
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
                background: #2196F3;
            <?php endif; ?>
            display: inline-block; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; 
        }
        .footer { margin-top: 20px; text-align: center; color: #666; font-size: 12px; }
        .urgent { background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <?php if($tipeNotifikasi == '7_hari'): ?>
                <h1>⏰ 7 Hari Lagi Kontrak Berakhir</h1>
            <?php elseif($tipeNotifikasi == '3_hari'): ?>
                <h1>⚠️ 3 Hari Lagi Kontrak Berakhir</h1>
            <?php elseif($tipeNotifikasi == '1_hari'): ?>
                <h1>🚨 Besok Kontrak Berakhir!</h1>
            <?php elseif($tipeNotifikasi == 'tenggat'): ?>
                <h1>🔴 Kontrak Berakhir Hari Ini!</h1>
            <?php elseif($tipeNotifikasi == 'terlambat'): ?>
                <h1>⛔ Kontrak Telah Melewati Tenggat Waktu!</h1>
            <?php endif; ?>
        </div>
        
        <div class="content">
            <p>Halo <strong><?php echo e($penghuni->nama); ?></strong>,</p>
            
            <?php if($tipeNotifikasi == 'terlambat'): ?>
                <div class="urgent">
                    <p><strong>PENTING:</strong> Kontrak sewa Anda telah melewati tenggat waktu!</p>
                </div>
            <?php elseif($tipeNotifikasi == 'tenggat'): ?>
                <div class="urgent">
                    <p><strong>PERHATIAN:</strong> Kontrak sewa Anda berakhir hari ini!</p>
                </div>
            <?php endif; ?>
            
            <p>Kontrak sewa Anda untuk <strong><?php echo e($kontrak->kos->nama_kos); ?></strong> akan berakhir dalam:</p>
            
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
            
            <div style="background: white; padding: 15px; border-left: 4px solid #2196F3; margin: 20px 0;">
                <p><strong>Detail Kontrak:</strong></p>
                <ul>
                    <li>Kos: <?php echo e($kontrak->kos->nama_kos); ?></li>
                    <li>Kamar: <?php echo e($kontrak->kamar->nomor_kamar); ?></li>
                    <li>Tanggal Selesai: <?php echo e(date('d F Y', strtotime($kontrak->tanggal_selesai))); ?></li>
                </ul>
            </div>
            
            <p>Silakan hubungi pemilik kos untuk melakukan perpanjangan kontrak atau persiapan kepindahan.</p>
            
            <?php if($tipeNotifikasi == 'terlambat'): ?>
                <p><strong>Segera hubungi pemilik kos untuk menghindari konsekuensi lebih lanjut.</strong></p>
            <?php endif; ?>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="<?php echo e(url('/penghuni/kontrak/' . $kontrak->id_kontrak)); ?>" class="button">
                    Lihat Detail Kontrak
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
</html><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\emails\penghuni\tenggat_waktu.blade.php ENDPATH**/ ?>