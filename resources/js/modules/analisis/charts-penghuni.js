export function initPenghuniCharts(data) {
    if (typeof window.Chart === 'undefined') return;
    const C = window.Chart;

    C.defaults.color = '#94a3b8';
    C.defaults.borderColor = 'rgba(255,255,255,0.2)';
    C.defaults.backgroundColor = 'rgba(255,255,255,0.05)';

    if (document.getElementById('pengeluaranChart')) {
        new C(document.getElementById('pengeluaranChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: data.pembayaranPerBulan.map(i => {
                    const [y, m] = i.bulan.split('-');
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    return months[parseInt(m) - 1];
                }),
                datasets: [{
                    label: 'Pengeluaran', data: data.pembayaranPerBulan.map(i => i.total),
                    borderColor: 'rgb(239,68,68)', backgroundColor: 'rgba(239,68,68,0.1)',
                    fill: true, tension: 0.4, borderWidth: 2,
                    pointBackgroundColor: 'rgb(239,68,68)', pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 4,
                }],
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { callback: v => 'Rp ' + v.toLocaleString('id-ID') } }, x: { grid: { color: 'rgba(255,255,255,0.05)' } } },
                plugins: { legend: { labels: { color: '#e2e8f0', font: { size: 12 } } }, tooltip: { backgroundColor: 'rgba(30,41,59,0.9)', titleColor: '#e2e8f0', bodyColor: '#cbd5e1', borderColor: '#334155', borderWidth: 1, callbacks: { label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID') } } },
            },
        });
    }

    if (document.getElementById('statusPembayaranChart')) {
        new C(document.getElementById('statusPembayaranChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: data.statusPembayaran.map(i => i.status_pembayaran.charAt(0).toUpperCase() + i.status_pembayaran.slice(1)),
                datasets: [{ data: data.statusPembayaran.map(i => i.jumlah), backgroundColor: ['rgba(34,197,94,0.8)', 'rgba(59,130,246,0.8)', 'rgba(234,179,8,0.8)', 'rgba(239,68,68,0.8)'] }],
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0', padding: 12, font: { size: 11 } } } } },
        });
    }

    if (document.getElementById('jenisKosChart')) {
        new C(document.getElementById('jenisKosChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.jenisKosDisewa.map(i => i.jenis_kos.charAt(0).toUpperCase() + i.jenis_kos.slice(1)),
                datasets: [{ label: 'Jumlah', data: data.jenisKosDisewa.map(i => i.jumlah_sewa), backgroundColor: ['rgba(59,130,246,0.7)', 'rgba(236,72,153,0.7)', 'rgba(168,85,247,0.7)'], borderRadius: 6 }],
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { stepSize: 1 } }, x: { grid: { display: false } } }, plugins: { legend: { display: false } } },
        });
    }

    if (document.getElementById('ratingChart')) {
        new C(document.getElementById('ratingChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.reviewStats.map(i => i.rating_bulat + ' Bintang'),
                datasets: [{ label: 'Jumlah', data: data.reviewStats.map(i => i.jumlah), backgroundColor: ['rgba(239,68,68,0.7)', 'rgba(251,146,60,0.7)', 'rgba(234,179,8,0.7)', 'rgba(34,197,94,0.7)', 'rgba(59,130,246,0.7)'], borderRadius: 6 }],
            },
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, scales: { x: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { stepSize: 1 } }, y: { grid: { display: false } } }, plugins: { legend: { display: false } } },
        });
    }
}
