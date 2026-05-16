export function initKosMap() {
    if (typeof L === 'undefined') {
        console.error('Leaflet library not loaded!');
        return;
    }

    const mapEl = document.getElementById('map');
    if (!mapEl) return;

    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');

    const DEFAULT_COORDS = { lat: -6.208763, lng: 106.845599 };

    let map, marker, userLocationCircle;

    function getCoords() {
        let lat = DEFAULT_COORDS.lat, lng = DEFAULT_COORDS.lng;
        if (latInput?.value) { const p = parseFloat(latInput.value); if (!isNaN(p)) lat = p; }
        if (lngInput?.value) { const p = parseFloat(lngInput.value); if (!isNaN(p)) lng = p; }
        return { lat, lng };
    }

    function setCoords(lat, lng) {
        if (latInput) latInput.value = lat.toFixed(6);
        if (lngInput) lngInput.value = lng.toFixed(6);
    }

    function markerIcon() {
        return L.divIcon({
            html: '<div class="relative"><div class="w-10 h-10 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 rounded-full flex items-center justify-center shadow-lg"><i class="fas fa-home text-sky-400 text-sm"></i></div><div class="w-3 h-3 bg-sky-500 rounded-full absolute -bottom-1 left-1/2 transform -translate-x-1/2 rotate-45"></div></div>',
            className: 'custom-marker', iconSize: [40, 40], iconAnchor: [20, 40]
        });
    }

    function updateMarker(lat, lng, title) {
        if (marker) map.removeLayer(marker);
        marker = L.marker([lat, lng], { icon: markerIcon(), draggable: true }).addTo(map);
        marker.bindPopup(`<div class="text-sm p-2" style="max-width:250px"><div class="font-semibold text-slate-800 mb-1">📍 ${title}</div><div class="text-gray-600 text-xs">Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}</div></div>`).openPopup();
        marker.on('dragend', () => { const p = marker.getLatLng(); setCoords(p.lat, p.lng); reverseGeocode(p.lat, p.lng); });
        map.setView([lat, lng], 16);
    }

    function showNotif(msg, type) {
        const el = document.querySelector('.map-notification');
        if (el) el.remove();
        const colors = { info: 'bg-blue-500/20 border-blue-500/20', success: 'bg-green-500/20 border-green-500/20', error: 'bg-red-500/20 border-red-500/20', warning: 'bg-yellow-500/20 border-yellow-500/20' };
        const n = document.createElement('div');
        n.className = `map-notification fixed bottom-4 right-4 px-6 py-3 rounded-xl border ${colors[type] || colors.info} text-white z-[9999] shadow-2xl`;
        n.innerHTML = `<div class="flex items-center"><span class="font-medium">${msg}</span></div>`;
        document.body.appendChild(n);
        setTimeout(() => { n.style.opacity = '0'; n.style.transform = 'translateY(20px)'; setTimeout(() => n.remove(), 300); }, 4000);
    }

    async function geocodeAddress(query) {
        const r = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=id&limit=1&addressdetails=1`, { headers: { 'Accept': 'application/json', 'Referer': window.location.origin, 'User-Agent': 'AyoKos/1.0' } });
        if (!r.ok) throw new Error('HTTP ' + r.status);
        const d = await r.json();
        return d?.[0] ? { lat: parseFloat(d[0].lat), lng: parseFloat(d[0].lon), display_name: d[0].display_name, address: d[0].address } : null;
    }

    async function reverseGeocode(lat, lng) {
        try {
            const r = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`, { headers: { 'Accept': 'application/json', 'Referer': window.location.origin, 'User-Agent': 'AyoKos/1.0' } });
            if (!r.ok) return;
            const d = await r.json();
            if (d?.address) fillAddress(d.address, d.display_name);
        } catch (e) { /* silent */ }
    }

    function fillAddress(addr, display) {
        const map = { kecamatan: addr.suburb || addr.village || addr.city_district || '', kota: addr.city || addr.town || addr.municipality || '', provinsi: addr.state || '', kode_pos: addr.postcode || '', alamat: display || '' };
        Object.entries(map).forEach(([name, val]) => {
            const f = document.querySelector(`[name="${name}"]`);
            if (f && !f.dataset.manualEdit && val) f.value = val;
        });
    }

    async function handleAddressSearch() {
        const input = document.getElementById('address-search');
        const btn = document.getElementById('search-btn');
        if (!input || !btn || !input.value.trim()) return;
        const orig = btn.innerHTML;
        btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mencari...';
        try {
            const r = await geocodeAddress(input.value);
            if (r) { updateMarker(r.lat, r.lng, r.display_name); setCoords(r.lat, r.lng); fillAddress(r.address, r.display_name); input.value = r.display_name; showNotif('Alamat ditemukan!', 'success'); }
            else showNotif('Alamat tidak ditemukan', 'error');
        } catch { showNotif('Gagal mencari alamat', 'error'); }
        finally { btn.disabled = false; btn.innerHTML = orig; }
    }

    function handleCurrentLocation() {
        const btn = document.getElementById('current-location-btn');
        if (!btn || !navigator.geolocation) return showNotif('Geolocation tidak didukung', 'error');
        const orig = btn.innerHTML;
        btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mendeteksi...';
        navigator.geolocation.getCurrentPosition(async (pos) => {
            const { latitude: lat, longitude: lng, accuracy } = pos.coords;
            updateMarker(lat, lng, 'Lokasi Anda');
            setCoords(lat, lng);
            document.getElementById('address-search').value = 'Lokasi saat ini';
            showNotif(`Lokasi ditemukan! Akurasi: ${Math.round(accuracy)}m`, 'success');
            await reverseGeocode(lat, lng);
            btn.disabled = false; btn.innerHTML = orig;
        }, () => { showNotif('Gagal mendapatkan lokasi. Izinkan akses lokasi.', 'error'); btn.disabled = false; btn.innerHTML = orig; }, { enableHighAccuracy: true, timeout: 10000 });
    }

    function setupEventListeners() {
        document.getElementById('search-btn')?.addEventListener('click', handleAddressSearch);
        document.getElementById('address-search')?.addEventListener('keypress', e => { if (e.key === 'Enter') { e.preventDefault(); handleAddressSearch(); } });
        document.getElementById('current-location-btn')?.addEventListener('click', handleCurrentLocation);
        document.getElementById('detect-nearby-btn')?.addEventListener('click', handleDetectNearby);

        if (latInput && lngInput) {
            let t;
            latInput.addEventListener('input', () => { clearTimeout(t); t = setTimeout(() => updateMapFromCoords(), 1000); });
            lngInput.addEventListener('input', () => { clearTimeout(t); t = setTimeout(() => updateMapFromCoords(), 1000); });
        }

        ['kecamatan', 'kota', 'provinsi', 'kode_pos', 'alamat'].forEach(name => {
            const f = document.querySelector(`[name="${name}"]`);
            if (f) { f.addEventListener('input', function () { this.dataset.manualEdit = 'true'; }); f.addEventListener('blur', function () { if (!this.value.trim()) delete this.dataset.manualEdit; }); }
        });
    }

    function updateMapFromCoords() {
        const lat = parseFloat(latInput?.value), lng = parseFloat(lngInput?.value);
        if (!isNaN(lat) && !isNaN(lng)) updateMarker(lat, lng, 'Lokasi dari koordinat');
    }

    function onMapClick(e) {
        const { lat, lng } = e.latlng;
        updateMarker(lat, lng, 'Lokasi dipilih');
        setCoords(lat, lng);
        reverseGeocode(lat, lng);
    }

    async function handleDetectNearby() {
        const btn = document.getElementById('detect-nearby-btn');
        if (!btn) return;
        const orig = btn.innerHTML;
        btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mencari...';
        try {
            const pos = await new Promise((res, rej) => navigator.geolocation.getCurrentPosition(res, rej, { enableHighAccuracy: true, timeout: 10000 }));
            const { latitude: lat, longitude: lng } = pos.coords;
            const q = `[out:json][timeout:25];(node["amenity"](around:500,${lat},${lng});way["amenity"](around:500,${lat},${lng});node["shop"](around:500,${lat},${lng});way["shop"](around:500,${lat},${lng}););out body;>;out skel qt;`;
            const r = await fetch('https://overpass-api.de/api/interpreter', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: 'data=' + encodeURIComponent(q) });
            const d = await r.json();
            const seen = new Set();
            const places = d.elements.filter(e => e.tags?.name && !seen.has(e.tags.name) && seen.add(e.tags.name) && e.lat && e.lon).slice(0, 8);

            showNearbyModal(places, lat, lng);
        } catch { showNotif('Gagal mencari tempat terdekat', 'error'); }
        finally { btn.disabled = false; btn.innerHTML = orig; }
    }

    function showNearbyModal(places, userLat, userLng) {
        const old = document.getElementById('nearby-places-modal');
        if (old) old.remove();
        const modal = document.createElement('div');
        modal.id = 'nearby-places-modal';
        modal.className = 'fixed inset-0 bg-black/70 z-[10000] flex items-center justify-center p-4';
        modal.innerHTML = `<div class="bg-white border border-slate-200 rounded-2xl w-full max-w-2xl max-h-[80vh] overflow-hidden shadow-2xl">
            <div class="bg-white border-b border-slate-200 p-6"><div class="flex items-center justify-between"><div><h3 class="text-xl font-bold text-slate-800 mb-1">📍 Tempat Terdekat</h3><p class="text-sm text-slate-500">Pilih lokasi terdekat untuk kos Anda</p></div><button type="button" id="close-modal" class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center hover:bg-slate-200 transition"><i class="fas fa-times text-slate-500"></i></button></div></div>
            <div class="p-6 overflow-y-auto max-h-[60vh]">${places.length === 0 ? '<div class="text-center py-8"><p class="text-slate-500">Tidak ada tempat terdeteksi</p></div>' : '<div class="space-y-3">' + places.map((p, i) => `<div class="place-item bg-slate-50 border border-slate-200 rounded-xl p-4 hover:border-sky-500/50 transition cursor-pointer" data-lat="${p.lat}" data-lng="${p.lon}" data-name="${p.tags.name}"><div class="flex items-start"><div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 mt-1"><i class="fas fa-map-pin text-purple-500"></i></div><div class="flex-1"><h4 class="font-semibold text-slate-800">${p.tags.name}</h4><p class="text-sm text-slate-500 mt-1">${p.tags.amenity || p.tags.shop || 'tempat'}</p></div></div></div>`).join('')}</div>
            <div class="border-t border-slate-200 p-4 bg-slate-50 flex justify-between">
                <button type="button" id="use-my-exact-location" class="px-4 py-2 bg-sky-100 text-sky-600 rounded-lg hover:bg-sky-200 transition flex items-center"><i class="fas fa-crosshairs mr-2"></i>Gunakan Posisi Tepat Saya</button>
                <button type="button" id="cancel-modal" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">Tutup</button>
            </div></div>`;
        document.body.appendChild(modal);

        document.getElementById('close-modal').onclick = () => modal.remove();
        document.getElementById('cancel-modal').onclick = () => modal.remove();
        modal.onclick = e => { if (e.target === modal) modal.remove(); };

        modal.querySelectorAll('.place-item').forEach(el => {
            el.addEventListener('click', () => {
                const lat = parseFloat(el.dataset.lat), lng = parseFloat(el.dataset.lng), name = el.dataset.name;
                updateMarker(lat, lng, name); setCoords(lat, lng); reverseGeocode(lat, lng);
                document.getElementById('address-search').value = name;
                modal.remove(); showNotif(`Lokasi "${name}" dipilih`, 'success');
            });
        });
        document.getElementById('use-my-exact-location').onclick = () => {
            updateMarker(userLat, userLng, 'Posisi tepat Anda'); setCoords(userLat, userLng); reverseGeocode(userLat, userLng);
            modal.remove(); showNotif('Menggunakan posisi tepat Anda', 'success');
        };
    }

    function initPhotoPreview() {
        const input = document.getElementById('foto-utama');
        if (!input) return;
        input.addEventListener('change', function () {
            const file = this.files?.[0];
            if (!file) return;
            if (!file.type.match('image.*')) { showNotif('Hanya file gambar', 'error'); this.value = ''; return; }
            if (file.size > 2 * 1024 * 1024) { showNotif('Maksimal 2MB', 'error'); this.value = ''; return; }
            const preview = document.getElementById('new-photo-preview');
            if (!preview) return;
            const reader = new FileReader();
            reader.onload = ev => {
                preview.innerHTML = `<img src="${ev.target.result}" class="w-full h-48 object-cover rounded-xl border border-white/20"><button type="button" class="mt-2 px-4 py-2 bg-red-500/20 text-red-300 rounded-lg hover:bg-red-500/10 transition text-sm w-full fotodelete"><i class="fas fa-trash mr-2"></i>Hapus Foto</button>`;
                preview.querySelector('.fotodelete')?.addEventListener('click', () => { this.value = ''; preview.innerHTML = ''; });
            };
            reader.readAsDataURL(file);
        });
    }

    map = L.map('map', { center: [getCoords().lat, getCoords().lng], zoom: 13, zoomControl: true, attributionControl: false });
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>', subdomains: 'abcd', maxZoom: 19 }).addTo(map);
    L.control.attribution({ position: 'bottomright', prefix: '<a href="https://leafletjs.com" target="_blank" class="text-xs text-gray-400">Leaflet</a>' }).addTo(map);
    map.on('click', onMapClick);

    setupEventListeners();
    initPhotoPreview();

    const c = getCoords();
    if (c.lat !== DEFAULT_COORDS.lat || c.lng !== DEFAULT_COORDS.lng) {
        setTimeout(() => updateMarker(c.lat, c.lng, 'Lokasi yang dipilih'), 1000);
    }
}
