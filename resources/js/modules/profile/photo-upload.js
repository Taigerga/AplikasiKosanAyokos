import { apiUpload } from '../../services/api-client';
import { showSuccess, showError } from '../../utils/notifications';
import { previewImage } from '../../utils/form';

export function initProfilePhotoUpload(formId, previewId) {
    const form = document.getElementById(formId);
    if (!form) return;

    const fileInput = form.querySelector('input[type="file"]');
    const previewEl = document.getElementById(previewId);

    if (fileInput && previewEl) {
        fileInput.addEventListener('change', (e) => previewImage(e.target, previewEl));
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const submitBtn = form.querySelector('[type="submit"]');

        try {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Mengupload...';
            }

            const response = await apiUpload(form.action.replace(/^.*\/\/[^/]+/, ''), formData);

            if (response.data.success) {
                showSuccess(response.data.message || 'Foto profil berhasil diupload');
                const img = document.querySelector('[data-profile-photo]');
                if (img && response.data.url) {
                    img.src = response.data.url;
                }
                const modal = document.getElementById('uploadModal');
                if (modal) modal.classList.add('hidden');
                form.reset();
                if (previewEl) previewEl.innerHTML = '';
            }
        } catch (error) {
            showError(error.response?.data?.message || 'Gagal mengupload foto');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = submitBtn.dataset.originalText || 'Upload';
            }
        }
    });
}
