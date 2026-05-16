export class Modal {
    constructor(element) {
        this.modal = element;
        this.overlay = element.querySelector('.modal-overlay') || element;
        this.closeBtn = element.querySelector('.modal-close, [data-modal-close]');
        this.onCloseCallbacks = [];

        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => this.hide());
        }
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.overlay) this.hide();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') this.hide();
        });
    }

    show() {
        this.modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    hide() {
        this.modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        this.onCloseCallbacks.forEach((cb) => cb());
    }

    onClose(callback) {
        this.onCloseCallbacks.push(callback);
    }

    setContent(html) {
        const content = this.modal.querySelector('.modal-content');
        if (content) content.innerHTML = html;
    }

    setFormAction(action) {
        const form = this.modal.querySelector('form');
        if (form) form.action = action;
    }
}

export function initModal(elementId) {
    const el = document.getElementById(elementId);
    if (!el) return null;
    return new Modal(el);
}

export function confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
    return new Promise((resolve) => {
        if (confirm(message)) {
            resolve(true);
        } else {
            resolve(false);
        }
    });
}
