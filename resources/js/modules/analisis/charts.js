import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);
window.Chart = Chart;

export function initAnalisisCharts(data) {
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

    if (document.getElementById('pendapatanChart')) {
        new C(document.getElementById('pendapatanChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'line',
            data: {
                labels: data.pendapatanPerBulan.map(i => {
                    const [y, m] = i.bulan.split('-');
                    return new Date(y, m - 1).toLocaleDateString('id-ID', { month: 'short' });
                }),
                datasets: [{
                    label: 'Pendapatan',
                    data: data.pendapatanPerBulan.map(i => i.total),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37,99,235,0.12)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2563eb',
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
                            callback: v => v >= 1e6 ? 'Rp ' + (v / 1e6).toFixed(1) + ' jt' : v >= 1e3 ? 'Rp ' + (v / 1e3).toFixed(0) + ' rb' : 'Rp ' + v,
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

    if (document.getElementById('statusKamarChart')) {
        new C(document.getElementById('statusKamarChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'doughnut',
            data: {
                labels: data.statusKamar.map(i => i.status_kamar === 'tersedia' ? 'Tersedia' : i.status_kamar === 'terisi' ? 'Terisi' : 'Maintenance'),
                datasets: [{
                    data: data.statusKamar.map(i => i.jumlah),
                    backgroundColor: ['#22c55e', '#3b82f6', '#eab308'],
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
                labels: data.jenisKos.map(i => i.jenis_kos.charAt(0).toUpperCase() + i.jenis_kos.slice(1)),
                datasets: [{
                    label: 'Jumlah Kos',
                    data: data.jenisKos.map(i => i.jumlah),
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

    if (document.getElementById('statusKontrakChart')) {
        new C(document.getElementById('statusKontrakChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'pie',
            data: {
                labels: data.statusKontrak.map(i => i.status_kontrak.charAt(0).toUpperCase() + i.status_kontrak.slice(1)),
                datasets: [{
                    data: data.statusKontrak.map(i => i.jumlah),
                    backgroundColor: ['#22c55e', '#3b82f6', '#64748b', '#ef4444'],
                    borderColor: '#000',
                    borderWidth: 3,
                    hoverBorderColor: '#000',
                    hoverBorderWidth: 4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: legendOpts,
                    tooltip: tooltipOpts,
                },
            },
        });
    }

    if (document.getElementById('reviewChart')) {
        new C(document.getElementById('reviewChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'bar',
            data: {
                labels: data.reviewData.map(i => i.rating + ' Bintang'),
                datasets: [{
                    label: 'Jumlah Review',
                    data: data.reviewData.map(i => i.jumlah),
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

    if (document.getElementById('tipeKamarChart')) {
        new C(document.getElementById('tipeKamarChart').getContext('2d'), {
            devicePixelRatio: 2.5,
            type: 'doughnut',
            data: {
                labels: data.tipeKamar.map(i => i.tipe_kamar),
                datasets: [{
                    data: data.tipeKamar.map(i => i.jumlah),
                    backgroundColor: ['#6366f1', '#a855f7', '#ec4899', '#22c55e', '#eab308'],
                    borderColor: '#000',
                    borderWidth: 3,
                    hoverBorderColor: '#000',
                    hoverBorderWidth: 4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '55%',
                plugins: {
                    legend: legendOpts,
                    tooltip: tooltipOpts,
                },
            },
        });
    }
}
