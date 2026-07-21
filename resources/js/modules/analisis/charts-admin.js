export function initAdminCharts(data) {
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

    function formatRp(value) {
        return 'Rp ' + value.toLocaleString('id-ID');
    }

    // 1. Pendapatan Chart (Line)
    const pendCtx = document.getElementById('pendapatanChart');
    if (pendCtx && data.pendapatanPerBulan) {
        const months = data.pendapatanPerBulan.map(d => {
            const date = new Date(d.tahun, d.bulan - 1);
            return date.toLocaleString('id-ID', { month: 'short' }) + ' ' + d.tahun;
        });
        const values = data.pendapatanPerBulan.map(d => Number(d.total));

        new C(pendCtx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Pendapatan Platform',
                    data: values,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.15)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#f59e0b',
                    pointBorderColor: '#000',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        ...tooltipOpts,
                        callbacks: {
                            label: (ctx) => formatRp(ctx.parsed.y),
                        }
                    },
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: (v) => formatRp(v),
                            font: { weight: 'bold', size: 11 }
                        },
                        grid: { color: 'rgba(0,0,0,0.08)' }
                    },
                    x: {
                        ticks: { font: { weight: 'bold', size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // 2. Status Kos (Doughnut)
    const kosCtx = document.getElementById('statusKosChart');
    if (kosCtx && data.statusKos) {
        const labels = data.statusKos.map(d => d.status_kos);
        const values = data.statusKos.map(d => Number(d.jumlah));
        const colors = ['#10b981', '#ef4444', '#f59e0b'];

        new C(kosCtx, {
            type: 'doughnut',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors,
                    borderColor: '#000',
                    borderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: tooltipOpts,
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { weight: 'bold', size: 12 },
                            padding: 16,
                            usePointStyle: true,
                        }
                    }
                }
            }
        });
    }

    // 3. Aduan per Status (Bar)
    const aduanCtx = document.getElementById('aduanChart');
    if (aduanCtx && data.aduanPerStatus) {
        const labels = data.aduanPerStatus.map(d => d.status_aduan);
        const values = data.aduanPerStatus.map(d => Number(d.jumlah));
        const statusColors = {
            diajukan: '#f59e0b',
            ditinjau: '#3b82f6',
            diproses: '#f97316',
            menunggu_info: '#a855f7',
            selesai: '#10b981',
            ditolak: '#ef4444',
            ditutup: '#6b7280',
        };

        new C(aduanCtx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: labels.map(l => statusColors[l] || '#9ca3af'),
                    borderColor: '#000',
                    borderWidth: 2,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: tooltipOpts,
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { weight: 'bold', size: 11 } },
                        grid: { color: 'rgba(0,0,0,0.08)' }
                    },
                    x: {
                        ticks: { font: { weight: 'bold', size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // 4. User Growth (Line - stacked per role)
    const growthCtx = document.getElementById('userGrowthChart');
    if (growthCtx && data.userGrowth) {
        const monthLabels = [...new Set(data.userGrowth.map(d => {
            const date = new Date(d.tahun, d.bulan - 1);
            return date.toLocaleString('id-ID', { month: 'short' }) + ' ' + d.tahun;
        }))];

        const roles = ['admin', 'pemilik', 'penghuni'];
        const roleColors = { admin: '#f43f5e', pemilik: '#10b981', penghuni: '#3b82f6' };
        const datasets = roles.map(role => {
            const values = monthLabels.map((_, i) => {
                const item = data.userGrowth.find(d => {
                    const date = new Date(d.tahun, d.bulan - 1);
                    const label = date.toLocaleString('id-ID', { month: 'short' }) + ' ' + d.tahun;
                    return label === monthLabels[i] && d.role === role;
                });
                return item ? Number(item.jumlah) : 0;
            });
            return {
                label: role.charAt(0).toUpperCase() + role.slice(1),
                data: values,
                borderColor: roleColors[role],
                backgroundColor: roleColors[role] + '33',
                borderWidth: 2,
                fill: false,
                tension: 0.3,
                pointRadius: 4,
                pointHoverRadius: 6,
            };
        });

        new C(growthCtx, {
            type: 'line',
            data: { labels: monthLabels, datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: tooltipOpts,
                    legend: {
                        position: 'bottom',
                        labels: { font: { weight: 'bold', size: 12 }, usePointStyle: true, padding: 16 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { weight: 'bold', size: 11 } },
                        grid: { color: 'rgba(0,0,0,0.08)' }
                    },
                    x: {
                        ticks: { font: { weight: 'bold', size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // 5. Sebaran Role (Pie)
    const roleCtx = document.getElementById('sebaranRoleChart');
    if (roleCtx && data.sebaranRole) {
        const labels = Object.keys(data.sebaranRole);
        const values = Object.values(data.sebaranRole);
        const colors = ['#f43f5e', '#10b981', '#3b82f6'];

        new C(roleCtx, {
            type: 'pie',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors,
                    borderColor: '#000',
                    borderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: tooltipOpts,
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { weight: 'bold', size: 12 },
                            padding: 16,
                            usePointStyle: true,
                        }
                    }
                }
            }
        });
    }

    // 6. Top Pemilik (Horizontal Bar)
    const pemilikCtx = document.getElementById('topPemilikChart');
    if (pemilikCtx && data.topPemilik) {
        const labels = data.topPemilik.map(d => d.nama);
        const values = data.topPemilik.map(d => Number(d.total_pendapatan));

        new C(pemilikCtx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: '#f59e0b',
                    borderColor: '#000',
                    borderWidth: 2,
                    borderRadius: 4,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        ...tooltipOpts,
                        callbacks: {
                            label: (ctx) => formatRp(ctx.parsed.x),
                        }
                    },
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            callback: (v) => formatRp(v),
                            font: { weight: 'bold', size: 10 }
                        },
                        grid: { color: 'rgba(0,0,0,0.08)' }
                    },
                    y: {
                        ticks: { font: { weight: 'bold', size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    }
}
