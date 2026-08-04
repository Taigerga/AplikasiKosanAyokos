
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Utama: gunakan map-picker lengkap dari bundle app.js bila tersedia
        if (window.initKosMap) {
            window.initKosMap();
            return;
        }

        // Fallback: inisialisasi peta minimal bila bundle app.js gagal dimuat
        const mapEl = document.getElementById('map');
        var latInput = document.getElementById('latitude');
        var lngInput = document.getElementById('longitude');
        if (!mapEl || typeof L === 'undefined') return;

        var defaults = { lat: -6.208763, lng: 106.845599 };
        var getCoords = function () {
            var lat = parseFloat(latInput && latInput.value), lng = parseFloat(lngInput && lngInput.value);
            return {
                lat: isNaN(lat) ? defaults.lat : lat,
                lng: isNaN(lng) ? defaults.lng : lng
            };
        };
        var setCoords = function (lat, lng) {
            if (latInput) { latInput.value = lat.toFixed(6); }
            if (lngInput) { lngInput.value = lng.toFixed(6); }
        };

        var c = getCoords();
        var map = L.map('map', { center: [c.lat, c.lng], zoom: 13, attributionControl: false });
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        var icon = L.divIcon({
            html: '<div class="relative"><div class="w-10 h-10 bg-sky-400 border-2 border-black flex items-center justify-center shadow-[3px_3px_0px_#000]"><i class="fas fa-home text-black text-sm"></i></div><div class="w-3 h-3 bg-sky-400 border-2 border-black absolute -bottom-1 left-1/2 transform -translate-x-1/2 rotate-45"></div></div>',
            className: 'custom-marker',
            iconSize: [40, 40],
            iconAnchor: [20, 40]
        });

        var marker;
        var placeMarker = function (lat, lng) {
            if (marker) { map.removeLayer(marker); }
            marker = L.marker([lat, lng], { icon: icon, draggable: true }).addTo(map);
            marker.on('dragend', function () { var p = marker.getLatLng(); setCoords(p.lat, p.lng); });
            map.setView([lat, lng], 15);
        };
        placeMarker(c.lat, c.lng);

        map.on('click', function (e) {
            placeMarker(e.latlng.lat, e.latlng.lng);
            setCoords(e.latlng.lat, e.latlng.lng);
        });

        var searchBtn = document.getElementById('search-btn');
        var addressInput = document.getElementById('address-search');
        if (searchBtn && addressInput) {
            var doSearch = function () {
                var q = addressInput.value.trim();
                if (!q) return;
                searchBtn.disabled = true;
                fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(q) + '&countrycodes=id&limit=1')
                    .then(function (r) { return r.json(); })
                    .then(function (d) {
                        if (d && d[0]) {
                            var lt = parseFloat(d[0].lat), ln = parseFloat(d[0].lon);
                            placeMarker(lt, ln);
                            setCoords(lt, ln);
                        }
                    })
                    .catch(function () { })
                    .finally(function () { searchBtn.disabled = false; });
            };
            searchBtn.addEventListener('click', doSearch);
            addressInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') { e.preventDefault(); doSearch(); }
            });
        }
    });
</script><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\pemilik\kos\_map-scripts.blade.php ENDPATH**/ ?>