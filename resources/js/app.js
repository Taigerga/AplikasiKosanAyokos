import './bootstrap';
import './init';
import { initModal } from './utils/modal';
import { showSuccess, showError, showToast } from './utils/notifications';

window.initModal = initModal;
window.showSuccess = showSuccess;
window.showError = showError;
window.showToast = showToast;

document.addEventListener('DOMContentLoaded', () => {
    const modals = document.querySelectorAll('[data-modal]');
    modals.forEach((el) => {
        const modal = initModal(el.id || el.dataset.modal);
        const trigger = document.querySelector(`[data-modal-trigger="${el.id}"]`);
        if (trigger && modal) {
            trigger.addEventListener('click', () => modal.show());
        }
    });

    const fileInputs = document.querySelectorAll('input[type="file"][data-preview]');
    fileInputs.forEach((input) => {
        input.addEventListener('change', (e) => {
            const preview = document.querySelector(e.target.dataset.preview);
            if (preview && e.target.files?.[0]) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    preview.innerHTML = `<img src="${ev.target.result}" class="max-w-full h-48 object-cover rounded-lg" />`;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });

    document.querySelectorAll('[data-auto-dismiss]').forEach((el) => {
        const delay = parseInt(el.dataset.autoDismiss) || 5000;
        setTimeout(() => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        }, delay);
    });

    document.querySelectorAll('.alert-close').forEach((btn) => {
        btn.addEventListener('click', () => {
            const alert = btn.closest('[role="alert"], .alert');
            if (alert) alert.remove();
        });
    });
});
