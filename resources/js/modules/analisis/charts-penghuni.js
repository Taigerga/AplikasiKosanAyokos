export function initPenghuniCharts(data) {
    if (typeof window.Chart === 'undefined') return;
    const C = window.Chart;

    C.defaults.color = '#000';
    C.defaults.borderColor = '#000';
    C.defaults.font = { weight: 'bold' };

    const tooltipOpts = {
        backgroundColor: '#fff',
        titleColor: '#000',
        bodyColor: '#000',
        borderColor: '#000',
        borderWidth: 2,
        padding: 10,
        titleFont: { weight: 'bold', size: 13 },
        bodyFont: { weight: 'bold', size: 12 },
    };

    const legendOpts = {
        position: 'bottom',
        labels: {
            color: '#000',
            padding: 14,
            font: { size: 12, weight: 'bold' },
            usePointStyle: true,
        },
    };

    if (document.getElementById('pengeluaranChart')) {
        new C(document.getElementById('pengeluaranChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'line',
            data: {
                labels: data.pembayaranPerBulan.map(i => {
                    const [y, m] = i.bulan.split('-');
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    return months[parseInt(m) - 1];
                }),
                datasets: [{
                    label: 'Pengeluaran',
                    data: data.pembayaranPerBulan.map(i => i.total),
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220,38,38,0.12)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#dc2626',
                    pointBorderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        border: { color: '#000', width: 2 },
                        grid: { color: '#d1d5db' },
                        ticks: {
                            color: '#000',
                            font: { weight: 'bold' },
                            callback: v => 'Rp ' + v.toLocaleString('id-ID'),
                        },
                    },
                    x: {
                        border: { color: '#000', width: 2 },
                        grid: { color: '#d1d5db' },
                        ticks: { color: '#000', font: { weight: 'bold' } },
                    },
                },
                plugins: {
                    legend: { display: false },
                    tooltip: tooltipOpts,
                },
            },
        });
    }

    if (document.getElementById('statusPembayaranChart')) {
        new C(document.getElementById('statusPembayaranChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'doughnut',
            data: {
                labels: data.statusPembayaran.map(i => i.status_pembayaran.charAt(0).toUpperCase() + i.status_pembayaran.slice(1)),
                datasets: [{
                    data: data.statusPembayaran.map(i => i.jumlah),
                    backgroundColor: ['#22c55e', '#3b82f6', '#eab308', '#64748b'],
                    borderColor: '#000',
                    borderWidth: 3,
                    hoverBorderColor: '#000',
                    hoverBorderWidth: 4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: legendOpts,
                    tooltip: tooltipOpts,
                },
            },
        });
    }

    if (document.getElementById('jenisKosChart')) {
        new C(document.getElementById('jenisKosChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'bar',
            data: {
                labels: data.jenisKosDisewa.map(i => i.jenis_kos.charAt(0).toUpperCase() + i.jenis_kos.slice(1)),
                datasets: [{
                    label: 'Jumlah',
                    data: data.jenisKosDisewa.map(i => i.jumlah_sewa),
                    backgroundColor: ['#3b82f6', '#ec4899', '#a855f7'],
                    borderColor: '#000',
                    borderWidth: 2,
                    borderRadius: 0,
                    barPercentage: 0.6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        border: { color: '#000', width: 2 },
                        grid: { color: '#d1d5db' },
                        ticks: { stepSize: 1, color: '#000', font: { weight: 'bold' } },
                    },
                    x: {
                        border: { color: '#000', width: 2 },
                        grid: { display: false },
                        ticks: { color: '#000', font: { weight: 'bold' } },
                    },
                },
                plugins: { legend: { display: false }, tooltip: tooltipOpts },
            },
        });
    }

    if (document.getElementById('ratingChart')) {
        new C(document.getElementById('ratingChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'bar',
            data: {
                labels: data.reviewStats.map(i => i.rating_bulat + ' Bintang'),
                datasets: [{
                    label: 'Jumlah',
                    data: data.reviewStats.map(i => i.jumlah),
                    backgroundColor: ['#ef4444', '#fb923c', '#eab308', '#22c55e', '#3b82f6'],
                    borderColor: '#000',
                    borderWidth: 2,
                    borderRadius: 0,
                    barPercentage: 0.7,
                }],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        border: { color: '#000', width: 2 },
                        grid: { color: '#d1d5db' },
                        ticks: { stepSize: 1, color: '#000', font: { weight: 'bold' } },
                    },
                    y: {
                        border: { color: '#000', width: 2 },
                        grid: { display: false },
                        ticks: { color: '#000', font: { weight: 'bold' } },
                    },
                },
                plugins: { legend: { display: false }, tooltip: tooltipOpts },
            },
        });
    }
}
