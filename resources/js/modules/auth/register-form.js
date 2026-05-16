export function initRegisterForm() {
    let currentStep = 1;
    const totalSteps = 3;

    window.nextStep = function () {
        if (currentStep < totalSteps && validateStep(currentStep)) {
            switchStep(currentStep + 1);
        }
    };

    window.prevStep = function () {
        if (currentStep > 1) switchStep(currentStep - 1);
    };

    function switchStep(step) {
        document.getElementById(`step${currentStep}`)?.classList.remove('active');
        document.querySelector(`.step[data-step="${currentStep}"]`)?.classList.remove('active');
        currentStep = step;
        document.getElementById(`step${currentStep}`)?.classList.add('active');
        document.querySelector(`.step[data-step="${currentStep}"]`)?.classList.add('active');
    }

    function mark(el, valid) {
        if (!el) return;
        if (valid) el.classList.remove('is-invalid');
        else el.classList.add('is-invalid');
    }

    function validateStep(step) {
        let valid = true;
        if (step === 1) {
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');
            const hp = document.getElementById('no_hp_display');
            const tgl = document.getElementById('tanggal_lahir');
            const almt = document.getElementById('alamat');
            const gender = document.querySelector('input[name="jenis_kelamin"]:checked');

            mark(nama, nama?.value.trim());
            if (email) { const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value); mark(email, ok); if (!ok) valid = false; }
            mark(hp, hp?.value.trim());
            if (tgl) {
                const age = Math.floor((new Date() - new Date(tgl.value)) / 31557600000);
                mark(tgl, age >= 17);
                document.getElementById('tanggal_lahir_error').textContent = age >= 17 ? '' : 'Umur minimal 17 tahun';
                if (age < 17) valid = false;
            }
            mark(almt, almt?.value.trim());
            if (!gender) { valid = false; showError('Pilih jenis kelamin'); }
            if (!nama?.value.trim() || !hp?.value.trim()) valid = false;
        } else if (step === 2) {
            const user = document.getElementById('username');
            const pass = document.getElementById('password');
            const conf = document.getElementById('password_confirmation');
            mark(user, user?.value.trim());
            mark(pass, pass?.value?.length >= 8);
            mark(conf, conf?.value && pass?.value === conf?.value);
            if (!user?.value.trim() || !pass?.value?.length >= 8 || !(conf?.value && pass?.value === conf?.value)) valid = false;
        } else if (step === 3) {
            const role = document.querySelector('input[name="role"]:checked');
            if (!role) { valid = false; showError('Pilih peran anda'); }
        }
        return valid;
    }

    window.togglePassword = function (id) {
        const input = document.getElementById(id);
        const icon = input?.nextElementSibling?.querySelector('i');
        if (input && icon) {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            icon.classList.replace(show ? 'fa-eye' : 'fa-eye-slash', show ? 'fa-eye-slash' : 'fa-eye');
        }
    };

    window.selectRole = function (role) {
        document.querySelectorAll('.role-card').forEach(c => c.classList.remove('active'));
        const radio = document.getElementById('role' + role.charAt(0).toUpperCase() + role.slice(1));
        if (radio) { radio.checked = true; radio.closest('.role-card')?.classList.add('active'); }
    };

    window.previewImage = function (input) {
        const preview = document.getElementById('imagePreview');
        const label = document.getElementById('fileUploadLabel');
        if (input.files?.[0]) {
            const r = new FileReader();
            r.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; if (label) label.style.display = 'none'; };
            r.readAsDataURL(input.files[0]);
        }
    };

    const toast = document.getElementById('registerToast');
    if (toast) setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 300); }, 4000);

    const hp = document.getElementById('no_hp_display');
    if (hp) {
        window.formatPhoneNumber = function () {
            const hidden = document.getElementById('no_hp');
            let val = hp.value.replace(/\D/g, '');
            if (val.startsWith('62')) val = val.substring(2);
            else if (val.startsWith('0')) val = val.substring(1);
            hp.value = val;
            if (hidden) hidden.value = '62' + val;
        };
        hp.addEventListener('input', window.formatPhoneNumber);
        window.formatPhoneNumber();
    }

    document.getElementById('registrationForm')?.addEventListener('submit', function (e) {
        for (let i = 1; i <= totalSteps; i++) {
            if (!validateStep(i)) {
                e.preventDefault();
                document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
                document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
                switchStep(i);
                return;
            }
        }
    });

    function showError(msg) {
        const t = document.getElementById('registerToast');
        if (t) { t.textContent = msg; t.style.opacity = '1'; }
    }
}
