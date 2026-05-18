import { initAjaxForms } from './utils/ajax-form';
import { initKosMap } from './modules/kos/map-picker';
import { initAnalisisCharts } from './modules/analisis/charts';
import { initPdfExport } from './modules/analisis/pdf-export';
import { initPenghuniCharts } from './modules/analisis/charts-penghuni';
import { initProfilePhotoUpload as initPhotoUpload } from './modules/profile/photo-upload';
import { initStarRating } from './modules/review/star-rating';
import { initPaymentForm } from './modules/pembayaran/payment-form';
import { initRegisterForm } from './modules/auth/register-form';
import { initLoginForm } from './modules/auth/login-form';
import { initSearchableSelects } from './modules/ui/searchable-select';
import axios from 'axios';

window.initKosMap = initKosMap;
window.initAnalisisCharts = initAnalisisCharts;
window.initPdfExport = initPdfExport;
window.initRegisterForm = initRegisterForm;
window.initLoginForm = initLoginForm;

document.addEventListener('DOMContentLoaded', () => {
    axios.get('/sanctum/csrf-cookie');

    initAjaxForms();

    if (document.getElementById('uploadPhotoForm')) {
        initPhotoUpload('uploadPhotoForm', 'photoPreview');
    }

    if (document.getElementById('starRatingContainer')) {
        initStarRating('starRatingContainer');
    }

    if (document.getElementById('paymentForm')) {
        initPaymentForm('paymentForm');
    }

    if (document.getElementById('exportPdfBtn') || document.getElementById('exportPdfPenghuni')) {
        initPdfExport();
    }

    if (document.getElementById('loginForm')) {
        initLoginForm();
    }

    initSearchableSelects();
});
