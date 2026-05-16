export function initPdfExport() {
    const btn = document.getElementById('exportPdfBtn');
    if (!btn) return;

    btn.addEventListener('click', async function () {
        const loading = document.getElementById('loadingOverlay');
        if (loading) loading.classList.remove('hidden');

        try {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
            const pageW = 190, margin = 10;

            function addFooter(pageNum) {
                pdf.setFontSize(8);
                pdf.setTextColor(148, 163, 184);
                pdf.text(`Halaman ${pageNum}`, pageW / 2 + margin, 290, { align: 'center' });
            }

            let page = 1;

            function addPage() { page++; pdf.addPage(); addFooter(page - 1); }

            function captureChart(id, title) {
                const canvas = document.getElementById(id);
                if (!canvas) return;
                const imgData = canvas.toDataURL('image/png');
                if (page > 1) pdf.addPage();
                pdf.setFontSize(14);
                pdf.setTextColor(30, 41, 59);
                pdf.text(title, margin, 20);
                const imgW = pageW, imgH = (canvas.height / canvas.width) * imgW;
                const maxH = 240;
                const finalH = imgH > maxH ? maxH : imgH;
                try { pdf.addImage(imgData, 'PNG', margin, 30, imgW, finalH); } catch { /* skip failed charts */ }
                page++;
            }

            captureChart('pendapatanChart', '📈 Pendapatan per Bulan');
            captureChart('statusKamarChart', '🏠 Status Kamar');
            captureChart('jenisKosChart', '🏗️ Jenis Kos');
            captureChart('statusKontrakChart', '📋 Status Kontrak');
            captureChart('reviewChart', '⭐ Distribusi Rating');
            captureChart('tipeKamarChart', '🛏️ Tipe Kamar');

            const tables = [
                { id: 'pendapatanPerKosTable', title: '💰 Pendapatan per Kos', cols: ['Nama Kos', 'Total Pendapatan'] },
                { id: 'penghuniPerKosTable', title: '👥 Penghuni Aktif per Kos', cols: ['Nama Kos', 'Jumlah Penghuni'] },
            ];

            tables.forEach(t => {
                const el = document.getElementById(t.id);
                if (!el) return;
                const rows = [];
                el.querySelectorAll('tr').forEach(tr => {
                    const cells = [];
                    tr.querySelectorAll('td, th').forEach(td => cells.push(td.textContent.trim()));
                    if (cells.length) rows.push(cells);
                });
                if (rows.length > 1) {
                    if (page > 1) pdf.addPage(); else { page++; }
                    pdf.setFontSize(14);
                    pdf.setTextColor(30, 41, 59);
                    pdf.text(t.title, margin, 20);
                    try {
                        pdf.autoTable({ head: [t.cols], body: rows.slice(1), startY: 30, theme: 'striped', headStyles: { fillColor: [59, 130, 246], textColor: [255, 255, 255], fontStyle: 'bold' }, alternateRowStyles: { fillColor: [248, 250, 252] }, styles: { fontSize: 9, cellPadding: 3 } });
                    } catch { /* skip failed tables */ }
                    page++;
                }
            });

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
