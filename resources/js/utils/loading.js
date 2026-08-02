const SPINNER_HTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

export function setLoading(el, loading) {
    if (!el) return;
    if (loading) {
        el.dataset.originalHtml = el.innerHTML;
        el.dataset.originalDisabled = el.disabled ? 'true' : '';
        el.disabled = true;
        el.innerHTML = SPINNER_HTML + ' Memproses...';
    } else if (el.dataset.originalHtml !== undefined) {
        el.disabled = el.dataset.originalDisabled === 'true';
        el.innerHTML = el.dataset.originalHtml;
        delete el.dataset.originalHtml;
        delete el.dataset.originalDisabled;
    }
}

export function showPageLoading() {
    let overlay = document.getElementById('page-loading-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'page-loading-overlay';
        overlay.className = 'fixed inset-0 z-50 flex items-center justify-center bg-white/70';
        overlay.innerHTML = '<div class="flex flex-col items-center gap-3"><svg class="animate-spin h-10 w-10 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="text-sm font-semibold">Memuat...</span></div>';
        document.body.appendChild(overlay);
    }
    overlay.classList.remove('hidden');
}

export function hidePageLoading() {
    const overlay = document.getElementById('page-loading-overlay');
    if (overlay) {
        overlay.classList.add('hidden');
    }
}

export function getSpinnerHtml(size = 'h-4 w-4') {
    return SPINNER_HTML.replace('h-4 w-4', size);
}
