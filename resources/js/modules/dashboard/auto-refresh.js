export function initAutoRefresh() {
    const container = document.getElementById('auto-refresh-indicator');
    if (!container) return;

    const badge = container.querySelector('[data-refresh-time]');
    const btn = container.querySelector('[data-refresh-btn]');
    let interval;

    function updateTime() {
        if (!badge) return;
        const now = new Date();
        badge.textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    }

    function doRefresh() {
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        }
        window.location.reload();
    }

    if (btn) {
        btn.addEventListener('click', doRefresh);
    }

    updateTime();

    interval = setInterval(() => {
        const metaRefresh = container.dataset.refreshInterval;
        const seconds = parseInt(metaRefresh, 10) || 60;
        updateTime();
    }, 1000);

    return () => clearInterval(interval);
}
