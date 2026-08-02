import { jsPDF } from 'jspdf';
import html2canvas from 'html2canvas';
window.jspdf = { jsPDF };
window.html2canvas = html2canvas;

export function initPdfExport() {
    const btn = document.getElementById('exportPdfBtn') || document.getElementById('exportPdfPenghuni');
    if (!btn) return;

    btn.addEventListener('click', async function () {
        const loading = document.getElementById('loadingOverlay');
        if (loading) loading.classList.remove('hidden');

        try {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
            const pageW = 190, margin = 10;

            let page = 1;

            function addFooter(pageNum) {
                pdf.setFontSize(8);
                pdf.setTextColor(0, 0, 0);
                pdf.text(`Halaman ${pageNum}`, pageW / 2 + margin, 290, { align: 'center' });
            }

            function captureChart(id, title) {
                const canvas = document.getElementById(id);
                if (!canvas) return true;
                const dpr = 2.5;
                const cssW = canvas.width / dpr;
                const cssH = canvas.height / dpr;
                const imgData = canvas.toDataURL('image/png');
                if (page > 1) pdf.addPage();
                pdf.setFontSize(14);
                pdf.setTextColor(0, 0, 0);
                pdf.text(title, margin, 20);
                const imgW = pageW;
                const imgH = (cssH / cssW) * imgW;
                const maxH = 240;
                const finalH = imgH > maxH ? maxH : imgH;
                try { pdf.addImage(imgData, 'PNG', margin, 30, imgW, finalH); } catch { /* skip */ }
                page++;
                return true;
            }

            // Pemilik charts
            captureChart('pendapatanChart', 'Pendapatan per Bulan');
            captureChart('statusKamarChart', 'Status Kamar');
            captureChart('jenisKosChart', 'Jenis Kos');
            captureChart('statusKontrakChart', 'Status Kontrak');
            captureChart('reviewChart', 'Distribusi Rating');
            captureChart('tipeKamarChart', 'Tipe Kamar');

            // Admin charts (only captured if present on the page)
            if (document.getElementById('statusKosChart')) {
                if (page > 1) pdf.addPage();
                captureChart('pendapatanChart', 'Pendapatan Platform');
                captureChart('statusKosChart', 'Status Kos');
                captureChart('aduanChart', 'Aduan per Status');
                captureChart('userGrowthChart', 'Pertumbuhan User');
                captureChart('sebaranRoleChart', 'Sebaran Role User');
                captureChart('topPemilikChart', 'Top Pemilik by Revenue');
            }

            // Penghuni charts
            if (document.getElementById('pengeluaranChart')) {
                if (page > 1) pdf.addPage();
                captureChart('pengeluaranChart', 'Riwayat Pengeluaran');
                captureChart('statusPembayaranChart', 'Status Pembayaran');
                captureChart('jenisKosChart', 'Preferensi Jenis Kos');
                captureChart('ratingChart', 'Distribusi Rating');
            }

            addFooter(page);
            pdf.save('Laporan-Analisis-' + new Date().toISOString().split('T')[0] + '.pdf');
        } catch (e) {
            console.error('PDF export error:', e);
            alert('Gagal mengekspor PDF: ' + e.message);
        } finally {
            if (loading) loading.classList.add('hidden');
        }
    });
}
