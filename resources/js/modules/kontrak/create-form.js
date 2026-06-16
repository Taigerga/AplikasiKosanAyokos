export function initKontrakCreateForm() {
    const form = document.querySelector('form[data-kontrak-create]');
    if (!form) return;

    const tipeSewa = form.dataset.tipeSewa || 'bulanan';
    let kamarData = {};
    try {
        kamarData = JSON.parse(form.dataset.kamar || '{}');
    } catch (e) {
        kamarData = {};
    }

    const DURATION_CONFIG = {
        harian:   { label: 'Hari',   unit: 'day',   max: 30, step: 1 },
        mingguan: { label: 'Minggu', unit: 'week',  max: 52, step: 1 },
        bulanan:  { label: 'Bulan',  unit: 'month', max: 12, step: 1 },
        tahunan:  { label: 'Tahun',  unit: 'year',  max: 5,  step: 1 },
    };
    const config = DURATION_CONFIG[tipeSewa] || DURATION_CONFIG.bulanan;

    const kamarSelect = document.getElementById('id_kamar');
    const durasiSelect = document.getElementById('durasi_sewa');
    const tanggalMulaiInput = document.getElementById('tanggal_mulai');
    const hargaPerBulanElement = document.getElementById('harga-per-bulan');
    const totalBiayaElement = document.getElementById('total-biaya');
    const detailKamarSummary = document.getElementById('detail-kamar-summary');
    const kamarDetailBox = document.getElementById('kamar-detail');
    const previewContainer = document.getElementById('preview-selesai-container');
    const previewMulai = document.getElementById('preview-tanggal-mulai');
    const previewSelesai = document.getElementById('preview-tanggal-selesai');
    const detailNomor = document.getElementById('detail-nomor');
    const detailTipe = document.getElementById('detail-tipe');
    const detailLuas = document.getElementById('detail-luas');
    const detailKapasitas = document.getElementById('detail-kapasitas');
    const ktpInput = document.getElementById('foto_ktp');
    const ktpPreview = document.getElementById('ktp-preview');

    if (!kamarSelect || !durasiSelect) return;

    function formatRupiah(angka) {
        if (!angka || isNaN(angka) || angka === 0) return 'Rp 0';
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

    function formatDate(date) {
        const d = new Date(date);
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
    }

    function addDateUnit(date, value, unit) {
        const d = new Date(date);
        switch (unit) {
            case 'day':   d.setDate(d.getDate() + value); break;
            case 'week':  d.setDate(d.getDate() + value * 7); break;
            case 'month': d.setMonth(d.getMonth() + value); break;
            case 'year':  d.setFullYear(d.getFullYear() + value); break;
        }
        return d;
    }

    function generateDurasiOptions() {
        durasiSelect.innerHTML = '<option value="">-- Pilih Durasi --</option>';
        for (let i = 1; i <= config.max; i += config.step) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i + ' ' + config.label + (i > 1 && tipeSewa !== 'harian' ? '' : '');
            durasiSelect.appendChild(option);
        }
        durasiSelect.value = '1';
    }

    function calculateTanggalSelesai(tanggalMulai, durasi) {
        if (!tanggalMulai || !durasi) return null;
        const start = new Date(tanggalMulai);
        return addDateUnit(start, parseInt(durasi), config.unit);
    }

    function updateAll() {
        const selectedKamarId = kamarSelect.value;
        const durasi = parseInt(durasiSelect.value) || 0;
        const tanggalMulai = tanggalMulaiInput.value;

        if (!selectedKamarId) {
            hargaPerBulanElement.textContent = 'Rp 0';
            totalBiayaElement.textContent = 'Rp 0';
            detailKamarSummary.innerHTML = '<i class="fas fa-info-circle mr-2"></i>Pilih kamar dan durasi untuk melihat detail';
            kamarDetailBox.classList.add('hidden');
            previewContainer.classList.add('hidden');
            return;
        }

        const kamar = kamarData[selectedKamarId];
        if (!kamar) return;

        const total = kamar.harga * (durasi || 1);

        hargaPerBulanElement.textContent = formatRupiah(kamar.harga);
        totalBiayaElement.textContent = formatRupiah(total);

        let summary = 'Kamar ' + kamar.nomor + ' - ' + kamar.tipe;
        if (kamar.luas) summary += ' • ' + kamar.luas;
        if (durasi > 0) summary += ' • ' + durasi + ' ' + config.label.toLowerCase();
        detailKamarSummary.textContent = summary;

        detailNomor.textContent = kamar.nomor;
        detailTipe.textContent = kamar.tipe;
        detailLuas.textContent = kamar.luas || '-';
        detailKapasitas.textContent = kamar.kapasitas + ' orang';
        kamarDetailBox.classList.remove('hidden');

        if (tanggalMulai && durasi > 0) {
            const tanggalSelesai = calculateTanggalSelesai(tanggalMulai, durasi);
            previewMulai.textContent = formatDate(tanggalMulai);
            previewSelesai.textContent = formatDate(tanggalSelesai);
            previewContainer.classList.remove('hidden');
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    ktpInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('File KTP terlalu besar. Maksimal 2MB.');
                this.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function (e) {
                ktpPreview.querySelector('img').src = e.target.result;
                ktpPreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            ktpPreview.classList.add('hidden');
        }
    });

    const dropZone = document.querySelector('label[for="foto_ktp"]');
    if (dropZone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
            }, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, function () {
                dropZone.parentElement.classList.add('border-sky-500', 'bg-sky-500/10');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function () {
                dropZone.parentElement.classList.remove('border-sky-500', 'bg-sky-500/10');
            }, false);
        });

        dropZone.addEventListener('drop', function (e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                ktpInput.files = files;
                ktpInput.dispatchEvent(new Event('change'));
            }
        }, false);
    }

    kamarSelect.addEventListener('change', updateAll);
    durasiSelect.addEventListener('change', updateAll);
    tanggalMulaiInput.addEventListener('change', updateAll);

    generateDurasiOptions();
    if (kamarSelect.value) {
        updateAll();
    }
}
