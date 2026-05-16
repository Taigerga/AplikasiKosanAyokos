import { showSuccess, showError } from '../../utils/notifications';

export function initLoginForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const submitBtn = form.querySelector('[type="submit"]');

        try {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Login...';
            }

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            const result = await response.json();

            if (response.ok && result.success) {
                showSuccess('Login berhasil!');
                window.location.href = result.redirect || '/redirect';
            } else {
                const msg = result.message || result.error || 'Username atau password salah.';
                showError(msg);
            }
        } catch (error) {
            showError('Terjadi kesalahan jaringan. Silakan coba lagi.');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Login';
            }
        }
    });
}
