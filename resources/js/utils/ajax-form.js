import { apiPost, apiPut, apiDelete, apiUpload } from '../services/api-client';
import { showSuccess, showError, handleApiError, clearValidationErrors } from './notifications';
import { setLoading } from './loading';

export function initAjaxForms() {
    document.querySelectorAll('form[data-ajax="true"]').forEach((form) => {
        form.addEventListener('submit', handleAjaxSubmit);
    });

    document.querySelectorAll('[data-ajax-action]:not(form)').forEach((el) => {
        el.addEventListener('click', handleAjaxAction);
    });
}

function resolveActionPath(action) {
    try {
        return new URL(action).pathname;
    } catch {
        return action;
    }
}

async function handleAjaxSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const confirmMsg = form.dataset.confirm;
    const confirmType = form.dataset.confirmType || 'warning';

    if (confirmMsg) {
        const confirmed = await window.showConfirmDialog
            ? window.showConfirmDialog(confirmMsg, confirmType)
            : Promise.resolve(confirm(confirmMsg));
        if (!(await confirmed)) return;
    }

    const method = (form.dataset.ajaxMethod || form.method).toUpperCase();
    const action = resolveActionPath(form.dataset.ajaxAction || form.action);
    const submitBtn = form.querySelector('[type="submit"]');
    const isUpload = form.enctype === 'multipart/form-data';
    const successMsg = form.dataset.successMsg || 'Berhasil';
    const redirectUrl = form.dataset.redirect;
    const resetAfter = form.dataset.resetAfter !== undefined;

    clearValidationErrors(form);

    const formData = new FormData(form);

    try {
        setLoading(submitBtn, true);

        let response;
        if (isUpload) {
            response = await apiUpload(action, formData);
        } else if (method === 'POST') {
            response = await apiPost(action, formData);
        } else if (method === 'PUT' || method === 'PATCH') {
            response = await apiPut(action, formData);
        } else if (method === 'DELETE') {
            response = await apiDelete(action);
        }

        const msg = response?.data?.message || successMsg;
        showSuccess(msg);

        if (resetAfter) form.reset();
        if (redirectUrl) {
            setTimeout(() => { window.location.href = redirectUrl; }, 1000);
        }
    } catch (error) {
        handleApiError(error);
    } finally {
        setLoading(submitBtn, false);
    }
}

async function handleAjaxAction(e) {
    const el = e.currentTarget;
    const action = el.dataset.ajaxAction;
    const method = (el.dataset.ajaxMethod || 'POST').toUpperCase();
    const confirmMsg = el.dataset.confirm;
    const confirmType = el.dataset.confirmType || (method === 'DELETE' ? 'danger' : 'success');
    const successMsg = el.dataset.successMsg || 'Berhasil';
    const redirectUrl = el.dataset.redirect;

    if (confirmMsg) {
        const confirmed = await window.showConfirmDialog
            ? window.showConfirmDialog(confirmMsg, confirmType)
            : Promise.resolve(confirm(confirmMsg));
        if (!(await confirmed)) return;
    }

    try {
        setLoading(el, true);

        let response;
        if (method === 'DELETE') {
            response = await apiDelete(action);
        } else {
            response = await apiPost(action);
        }

        showSuccess(response?.data?.message || successMsg);

        if (redirectUrl) {
            setTimeout(() => { window.location.href = redirectUrl; }, 1000);
        } else {
            setTimeout(() => { window.location.reload(); }, 1000);
        }
    } catch (error) {
        handleApiError(error);
    } finally {
        setLoading(el, false);
    }
}


