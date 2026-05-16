export function serializeForm(form) {
    const data = {};
    const formData = new FormData(form);
    formData.forEach((value, key) => {
        if (key.endsWith('[]')) {
            const k = key.slice(0, -2);
            if (!data[k]) data[k] = [];
            data[k].push(value);
        } else {
            data[key] = value;
        }
    });
    return data;
}

export function resetForm(form) {
    if (!form) return;
    form.reset();
    const fileInputs = form.querySelectorAll('input[type="file"]');
    fileInputs.forEach((input) => {
        const preview = input.closest('.upload-wrapper')?.querySelector('.file-preview');
        if (preview) preview.innerHTML = '';
    });
}

export function disableSubmit(form, disable = true) {
    if (!form) return;
    const btn = form.querySelector('[type="submit"]');
    if (btn) {
        btn.disabled = disable;
        btn.innerHTML = disable
            ? '<span class="spinner"></span> Memproses...'
            : btn.dataset.originalText || btn.textContent;
    }
}

export function previewImage(input, previewEl) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        if (previewEl) {
            previewEl.innerHTML = `<img src="${e.target.result}" class="max-w-full h-48 object-cover rounded-lg" />`;
        }
    };
    reader.readAsDataURL(input.files[0]);
}

export function validateRequired(form, fields) {
    const errors = [];
    fields.forEach((field) => {
        const input = form.querySelector(`[name="${field}"]`);
        if (input && !input.value.trim()) {
            errors.push(field);
            input.classList.add('border-red-500');
        } else if (input) {
            input.classList.remove('border-red-500');
        }
    });
    return errors;
}
