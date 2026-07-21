export function showToast(message, type = 'success') {
    const colors = {
        success: 'bg-emerald-400 text-black',
        error: 'bg-red-500 text-white',
        warning: 'bg-yellow-400 text-black',
        info: 'bg-sky-400 text-black',
    };

    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 px-6 py-3 border-2 border-black shadow-[4px_4px_0px_#000] font-black ${colors[type] || colors.info} transition-all duration-300 transform translate-x-full`;
    toast.textContent = message;
    document.body.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full');
    });

    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

export function showSuccess(message) {
    showToast(message, 'success');
}

export function showError(message) {
    showToast(message, 'error');
}

export function showWarning(message) {
    showToast(message, 'warning');
}

export function showInfo(message) {
    showToast(message, 'info');
}

export function handleApiError(error) {
    const status = error.response?.status;

    switch (status) {
        case 401: {
            const message = error.response?.data?.message || 'Sesi anda telah berakhir. Silakan login kembali.';
            showError(message);

            const currentPath = window.location.pathname;
            if (currentPath !== '/login') {
                setTimeout(() => { window.location.href = '/login'; }, 2000);
            }
            break;
        }

        case 403:
            showError('Anda tidak memiliki izin untuk melakukan tindakan ini.');
            break;

        case 404:
            showError('Data yang diminta tidak ditemukan.');
            break;

        case 419:
            showError('Sesi telah kedaluwarsa. Halaman akan dimuat ulang.');
            setTimeout(() => { window.location.reload(); }, 2000);
            break;

        case 422:
            handleValidationErrors(error);
            break;

        case 429: {
            const retryAfter = error.response?.headers?.['retry-after'];
            const serverMsg = error.response?.data?.message;
            const msg = serverMsg
                || (retryAfter ? `Terlalu banyak permintaan. Coba lagi dalam ${retryAfter} detik.` : null)
                || 'Terlalu banyak permintaan. Silakan coba lagi nanti.';
            showError(msg);
            break;
        }

        default: {
            const msg = error.response?.data?.message
                || error.response?.data?.error
                || 'Terjadi kesalahan server. Silakan coba lagi.';
            showError(msg);
            break;
        }
    }

    return error;
}

export function handleValidationErrors(error) {
    const errors = error.response?.data?.errors;

    if (errors) {
        const firstField = Object.keys(errors)[0];
        const message = Array.isArray(errors[firstField]) ? errors[firstField][0] : errors[firstField];

        const summary = Object.values(errors)
            .flat()
            .slice(0, 3)
            .join('<br>');

        showError(summary || message);

        Object.entries(errors).forEach(([field, messages]) => {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('border-red-500');
                const errorEl = document.createElement('p');
                errorEl.className = 'text-red-500 text-xs mt-1';
                errorEl.textContent = Array.isArray(messages) ? messages[0] : messages;
                input.parentNode.appendChild(errorEl);
            }
        });
    } else {
        const msg = error.response?.data?.message || 'Validasi gagal';
        showError(msg);
    }
}

export function clearValidationErrors(form) {
    if (!form) return;
    form.querySelectorAll('.border-red-500').forEach((el) => el.classList.remove('border-red-500'));
    form.querySelectorAll('.text-red-500.text-xs').forEach((el) => el.remove());
}
