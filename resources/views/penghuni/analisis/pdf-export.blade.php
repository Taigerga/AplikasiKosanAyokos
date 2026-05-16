<script>
    async function loadPdfLibraries() {
        if (window.jspdf) {
            if (window.initPdfExport) window.initPdfExport();
            return;
        }
        try {
            const jspdf = await import('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js');
            await import('https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js');
            await import('https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js');
            window.jspdf = jspdf;
            if (window.initPdfExport) window.initPdfExport();
        } catch (e) {
            console.error('Failed to load PDF libraries:', e);
            document.getElementById('loadingOverlay')?.classList.add('hidden');
            alert('Gagal memuat library PDF. Periksa koneksi internet.');
        }
    }
</script>
