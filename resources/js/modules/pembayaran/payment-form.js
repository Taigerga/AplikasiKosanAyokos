import { previewImage } from '../../utils/form';

export function initPaymentForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    const fileInput = form.querySelector('input[type="file"]');
    const previewEl = document.getElementById('buktiPreview');

    if (fileInput && previewEl) {
        fileInput.addEventListener('change', (e) => previewImage(e.target, previewEl));
    }

    form.addEventListener('submit', (e) => {
        const submitBtn = form.querySelector('[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.dataset.originalText = submitBtn.textContent;
            submitBtn.innerHTML = '<span class="spinner"></span> Mengirim...';
        }
    });
}
