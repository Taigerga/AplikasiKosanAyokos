export function initAnalisisCharts(data) {
    if (typeof window.Chart === 'undefined') return;
    const C = window.Chart;

    C.defaults.color = '#94a3b8';
    C.defaults.borderColor = '#334155';

    if (document.getElementById('pendapatanChart')) {
        new C(document.getElementById('pendapatanChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: data.pendapatanPerBulan.map(i => {
                    const [y, m] = i.bulan.split('-');
                    return new Date(y, m - 1).toLocaleDateString('id-ID', { month: 'short' });
                }),
                datasets: [{
                    label: 'Pendapatan',
                    data: data.pendapatanPerBulan.map(i => i.total),
                    borderColor: 'rgb(59,130,246)', backgroundColor: 'rgba(59,130,246,0.1)',
                    fill: true, tension: 0.4, borderWidth: 2,
                    pointBackgroundColor: 'rgb(59,130,246)', pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 4,
                }],
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { callback: v => v >= 1e6 ? 'Rp ' + (v / 1e6).toFixed(1) + ' jt' : v >= 1e3 ? 'Rp ' + (v / 1e3).toFixed(0) + ' rb' : 'Rp ' + v } }, x: { grid: { color: 'rgba(255,255,255,0.05)' } } },
                plugins: { legend: { labels: { color: '#e2e8f0', font: { size: 12 } } }, tooltip: { backgroundColor: 'rgba(30,41,59,0.9)', titleColor: '#e2e8f0', bodyColor: '#cbd5e1', borderColor: '#334155', borderWidth: 1, callbacks: { label: ctx => 'Pendapatan: Rp ' + ctx.parsed.y.toLocaleString('id-ID') } } },
            },
        });
    }

    if (document.getElementById('statusKamarChart')) {
        new C(document.getElementById('statusKamarChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: data.statusKamar.map(i => i.status_kamar === 'tersedia' ? 'Tersedia' : i.status_kamar === 'terisi' ? 'Terisi' : 'Maintenance'),
                datasets: [{ data: data.statusKamar.map(i => i.jumlah), backgroundColor: ['rgba(34,197,94,0.8)', 'rgba(59,130,246,0.8)', 'rgba(234,179,8,0.8)'] }],
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0', padding: 12, font: { size: 11 } } } } },
        });
    }

    if (document.getElementById('jenisKosChart')) {
        new C(document.getElementById('jenisKosChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.jenisKos.map(i => i.jenis_kos.charAt(0).toUpperCase() + i.jenis_kos.slice(1)),
                datasets: [{ label: 'Jumlah Kos', data: data.jenisKos.map(i => i.jumlah), backgroundColor: ['rgba(59,130,246,0.7)', 'rgba(236,72,153,0.7)', 'rgba(168,85,247,0.7)'], borderRadius: 6 }],
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { stepSize: 1 } }, x: { grid: { display: false } } }, plugins: { legend: { display: false } } },
        });
    }

    if (document.getElementById('statusKontrakChart')) {
        new C(document.getElementById('statusKontrakChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: data.statusKontrak.map(i => i.status_kontrak.charAt(0).toUpperCase() + i.status_kontrak.slice(1)),
                datasets: [{ data: data.statusKontrak.map(i => i.jumlah), backgroundColor: ['rgba(34,197,94,0.8)', 'rgba(59,130,246,0.8)', 'rgba(100,116,139,0.8)', 'rgba(239,68,68,0.8)'] }],
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0', padding: 10, font: { size: 11 } } } } },
        });
    }

    if (document.getElementById('reviewChart')) {
        new C(document.getElementById('reviewChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.reviewData.map(i => i.rating + ' Bintang'),
                datasets: [{ label: 'Jumlah Review', data: data.reviewData.map(i => i.jumlah), backgroundColor: ['rgba(239,68,68,0.7)', 'rgba(251,146,60,0.7)', 'rgba(234,179,8,0.7)', 'rgba(34,197,94,0.7)', 'rgba(59,130,246,0.7)'], borderRadius: 6 }],
            },
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, scales: { x: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { stepSize: 1 } }, y: { grid: { display: false } } }, plugins: { legend: { display: false } } },
        });
    }

    if (document.getElementById('tipeKamarChart')) {
        new C(document.getElementById('tipeKamarChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: data.tipeKamar.map(i => i.tipe_kamar),
                datasets: [{ data: data.tipeKamar.map(i => i.jumlah), backgroundColor: ['rgba(99,102,241,0.8)', 'rgba(168,85,247,0.8)', 'rgba(236,72,153,0.8)', 'rgba(34,197,94,0.8)', 'rgba(234,179,8,0.8)'] }],
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0', padding: 10, font: { size: 11 } } } } },
        });
    }
}
