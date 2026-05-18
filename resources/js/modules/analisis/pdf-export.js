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

            function addPage() { page++; pdf.addPage(); addFooter(page - 1); }

            function captureChart(id, title) {
                const canvas = document.getElementById(id);
                if (!canvas) return;
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
            }

            captureChart('pendapatanChart', 'Pendapatan per Bulan');
            captureChart('statusKamarChart', 'Status Kamar');
            captureChart('jenisKosChart', 'Jenis Kos');
            captureChart('statusKontrakChart', 'Status Kontrak');
            captureChart('reviewChart', 'Distribusi Rating');
            captureChart('tipeKamarChart', 'Tipe Kamar');

            addFooter(page);
            pdf.save('Laporan-Analisis-Kos-' + new Date().toISOString().split('T')[0] + '.pdf');
        } catch (e) {
            console.error('PDF export error:', e);
            alert('Gagal mengekspor PDF: ' + e.message);
        } finally {
            if (loading) loading.classList.add('hidden');
        }
    });
}
