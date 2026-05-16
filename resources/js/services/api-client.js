import axios from 'axios';

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

const API_PREFIX = '/api';

function normalizeUrl(url) {
    if (url.startsWith('http://') || url.startsWith('https://')) {
        url = new URL(url).pathname;
    }
    const clean = url.replace(/^\//, '');
    return clean.startsWith('api/') ? `/${clean}` : `${API_PREFIX}/${clean}`;
}

const apiClient = axios.create({
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
    },
    withCredentials: true,
});

let csrfPromise = null;

function ensureCsrfCookie() {
    if (csrfPromise) return csrfPromise;
    const xsrfToken = getCookie('XSRF-TOKEN');
    if (xsrfToken) return Promise.resolve();
    csrfPromise = axios.get('/sanctum/csrf-cookie').then(() => {
        csrfPromise = null;
    }).catch(() => {
        csrfPromise = null;
    });
    return csrfPromise;
}

apiClient.interceptors.request.use(async (config) => {
    const token = document.querySelector('meta[name="api-token"]')?.getAttribute('content');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    const xsrfToken = getCookie('XSRF-TOKEN');
    if (xsrfToken) {
        config.headers['X-XSRF-TOKEN'] = xsrfToken;
    }

    return config;
});

apiClient.interceptors.response.use(
    (response) => response,
    async (error) => {
        const status = error.response?.status;
        const originalRequest = error.config;

        if (status === 419 && !originalRequest._retry) {
            originalRequest._retry = true;
            try {
                await ensureCsrfCookie();
                const xsrfToken = getCookie('XSRF-TOKEN');
                if (xsrfToken) {
                    originalRequest.headers['X-XSRF-TOKEN'] = xsrfToken;
                }
                return apiClient(originalRequest);
            } catch {
                window.location.reload();
            }
        }

        if (status === 429) {
            const retryAfter = error.response?.headers?.['retry-after'];
            const msg = retryAfter
                ? `Terlalu banyak permintaan. Coba lagi dalam ${retryAfter} detik.`
                : 'Terlalu banyak permintaan. Silakan coba lagi nanti.';
            console.error(msg);
        }

        if (!error.response) {
            console.error('Network error:', error.message);
        }

        return Promise.reject(error);
    }
);

export function apiGet(url, params = {}) {
    return apiClient.get(normalizeUrl(url), { params });
}

export async function apiPost(url, data = {}) {
    await ensureCsrfCookie();
    return apiClient.post(normalizeUrl(url), data);
}

export async function apiPut(url, data = {}) {
    await ensureCsrfCookie();
    return apiClient.put(normalizeUrl(url), data);
}

export async function apiDelete(url) {
    await ensureCsrfCookie();
    return apiClient.delete(normalizeUrl(url));
}

export async function apiUpload(url, formData) {
    await ensureCsrfCookie();
    return apiClient.post(normalizeUrl(url), formData, {
        headers: { 'Content-Type': 'multipart/form-data' },
    });
}

export default apiClient;
