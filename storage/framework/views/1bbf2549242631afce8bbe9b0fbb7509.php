<?php $__env->startSection('title', 'Peta Kos - AyoKos'); ?>

<?php $__env->startSection('content'); ?>



<!-- ==================== HERO SECTION ==================== -->
<section class="bg-yellow-400 py-16 md:py-20 border-b-4 border-black">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-black border-4 border-black shadow-[4px_4px_0px_#000] flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-map-marked-alt text-white text-3xl md:text-4xl"></i>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-black mb-6 leading-tight tracking-tight">
            Peta <span class="bg-black text-white px-3">Kos</span> Tersedia
        </h1>

        <p class="text-lg md:text-xl text-gray-800 font-black max-w-3xl mx-auto leading-relaxed mb-10">
            Temukan kos terdekat di lokasi yang Anda inginkan dengan peta interaktif. 
            Filter berdasarkan jenis, tipe sewa, dan rentang harga.
        </p>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5" data-aos="fade-up" data-aos-delay="0">
                <div class="text-3xl md:text-4xl font-black text-black mb-1"><?php echo e($kos->count()); ?></div>
                <div class="text-sm font-black text-gray-600">Total Kos</div>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5" data-aos="fade-up" data-aos-delay="100">
                <div class="text-3xl md:text-4xl font-black text-black mb-1"><?php echo e($kos->where('jenis_kos', 'putra')->count()); ?></div>
                <div class="text-sm font-black text-gray-600">Kos Putra</div>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5" data-aos="fade-up" data-aos-delay="200">
                <div class="text-3xl md:text-4xl font-black text-black mb-1"><?php echo e($kos->where('jenis_kos', 'putri')->count()); ?></div>
                <div class="text-sm font-black text-gray-600">Kos Putri</div>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5" data-aos="fade-up" data-aos-delay="300">
                <div class="text-3xl md:text-4xl font-black text-black mb-1"><?php echo e($kos->where('jenis_kos', 'campuran')->count()); ?></div>
                <div class="text-sm font-black text-gray-600">Kos Campuran</div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== MAP SECTION ==================== -->
<section class="py-12 bg-white flex-1">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            <!-- Sidebar Filter -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 lg:col-span-1" data-aos="fade-right">
                <h2 class="text-lg font-black text-black mb-6 flex items-center">
                    <i class="fas fa-filter text-pink-500 mr-3"></i>
                    Filter
                </h2>

            <form method="GET" action="<?php echo e(route('public.kos.peta')); ?>" class="space-y-5" id="filter-form">
                <div>
                    <label class="block text-sm font-black text-black mb-2">Jenis Kos</label>
                    <select name="jenis_kos" class="w-full px-4 py-3 border-2 border-black text-black font-black focus:outline-none focus:shadow-[3px_3px_0px_#000] transition bg-white">
                        <option value="">Semua Jenis</option>
                        <option value="putra" <?php echo e(request('jenis_kos') == 'putra' ? 'selected' : ''); ?>>Putra</option>
                        <option value="putri" <?php echo e(request('jenis_kos') == 'putri' ? 'selected' : ''); ?>>Putri</option>
                        <option value="campuran" <?php echo e(request('jenis_kos') == 'campuran' ? 'selected' : ''); ?>>Campuran</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-black text-black mb-2">Tipe Sewa</label>
                    <select name="tipe_sewa" class="w-full px-4 py-3 border-2 border-black text-black font-black focus:outline-none focus:shadow-[3px_3px_0px_#000] transition bg-white">
                        <option value="">Semua Tipe</option>
                        <option value="harian" <?php echo e(request('tipe_sewa') == 'harian' ? 'selected' : ''); ?>>Harian</option>
                        <option value="mingguan" <?php echo e(request('tipe_sewa') == 'mingguan' ? 'selected' : ''); ?>>Mingguan</option>
                        <option value="bulanan" <?php echo e(request('tipe_sewa') == 'bulanan' ? 'selected' : ''); ?>>Bulanan</option>
                        <option value="tahunan" <?php echo e(request('tipe_sewa') == 'tahunan' ? 'selected' : ''); ?>>Tahunan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-black text-black mb-2">Kota</label>
                    <input type="text" name="kota" value="<?php echo e(request('kota')); ?>" placeholder="Nama kota..." class="w-full px-4 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:outline-none focus:shadow-[3px_3px_0px_#000] transition">
                </div>
                <div>
                    <label class="block text-sm font-black text-black mb-2">Harga Maksimal</label>
                    <input type="number" name="max_harga" value="<?php echo e(request('max_harga')); ?>" placeholder="Rp..." class="w-full px-4 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:outline-none focus:shadow-[3px_3px_0px_#000] transition">
                </div>
                <button type="submit" class="w-full px-6 py-3 bg-black hover:bg-gray-800 text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide flex items-center justify-center">
                    <i class="fas fa-search mr-2"></i> Terapkan Filter
                </button>
                <?php if(request()->hasAny(['jenis_kos','tipe_sewa','kota','max_harga'])): ?>
                <a href="<?php echo e(route('public.kos.peta')); ?>" class="block w-full text-center px-6 py-3 bg-white hover:bg-yellow-100 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] transition-all uppercase tracking-wide">Reset Filter</a>
                <?php endif; ?>
            </form>

            <!-- Find Nearby Button -->
            <div class="border-t-2 border-gray-200 pt-5 mt-4">
                <button id="find-nearby"
                    class="w-full bg-lime-400 hover:bg-lime-500 text-black font-black py-3 border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all flex items-center justify-center gap-3 uppercase tracking-wide">
                    <i class="fas fa-location-arrow text-lg"></i>
                    <span>Cari Kos Terdekat</span>
                </button>
                <p class="text-xs font-black text-gray-500 mt-2 text-center">(Maksimal 1 km dari lokasi Anda)</p>
            </div>

            <!-- Nearby Info -->
            <div id="nearby-info"
                class="mt-4 p-4 bg-lime-100 border-2 border-black hidden">
                <h3 class="font-black text-black mb-2 flex items-center">
                    <i class="fas fa-map-marker-alt mr-2 text-lime-600"></i>
                    Kos Terdekat Ditemukan
                </h3>
                <div id="nearby-count" class="text-2xl font-black text-black">0</div>
                <p class="text-sm font-black text-gray-700 mt-1">kos dalam radius 1 km</p>
                <button id="clear-nearby"
                    class="w-full mt-3 bg-black hover:bg-gray-800 text-white font-black py-2 text-sm border-2 border-black transition-all flex items-center justify-center gap-2 uppercase tracking-wide">
                    <i class="fas fa-times"></i>
                    Hapus Filter Jarak
                </button>
            </div>

            <!-- Quick Links -->
            <div class="mt-6 pt-6 border-t-2 border-gray-200">
                <h3 class="font-black text-black mb-4 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                    Akses Cepat
                </h3>
                <div class="space-y-3">
                    <a href="<?php echo e(route('public.kos.index')); ?>"
                        class="flex items-center text-gray-700 hover:text-black font-black text-sm transition-colors">
                        <div class="w-9 h-9 bg-yellow-200 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-search text-black"></i>
                        </div>
                        <span>Cari Kos Berdasarkan List</span>
                    </a>

<?php if(auth()->guard()->check()): ?>
<?php if(auth()->user()->role === 'penghuni'): ?>
<a href="<?php echo e(route('penghuni.dashboard')); ?>"
    class="flex items-center text-gray-700 hover:text-black font-black text-sm transition-colors">
    <div class="w-9 h-9 bg-emerald-200 border-2 border-black flex items-center justify-center mr-3">
        <i class="fas fa-home text-black"></i>
    </div>
    <span>Dashboard Penghuni</span>
</a>
<?php elseif(auth()->user()->role === 'pemilik'): ?>
<a href="<?php echo e(route('pemilik.dashboard')); ?>"
    class="flex items-center text-gray-700 hover:text-black font-black text-sm transition-colors">
    <div class="w-9 h-9 bg-sky-200 border-2 border-black flex items-center justify-center mr-3">
        <i class="fas fa-user-tie text-black"></i>
    </div>
    <span>Dashboard Pemilik</span>
</a>
<?php endif; ?>
<?php else: ?>
<a href="<?php echo e(route('login')); ?>"
    class="flex items-center text-gray-700 hover:text-black font-black text-sm transition-colors">
    <div class="w-9 h-9 bg-amber-200 border-2 border-black flex items-center justify-center mr-3">
        <i class="fas fa-lock text-black"></i>
    </div>
    <span>Login untuk Fitur Lebih</span>
</a>
<?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Map Container -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 lg:col-span-3" data-aos="fade-left">
            <!-- Route Control Panel -->
            <div id="route-control-panel"
                class="mb-4 p-4 bg-lime-100 border-2 border-black hidden">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-black text-black flex items-center">
                            <i class="fas fa-route mr-2 text-lime-600"></i>
                            <span id="route-title">Rute Menuju Kos</span>
                        </h3>
                        <p id="route-distance" class="text-sm font-black text-gray-700 mt-1">Memuat rute...</p>
                    </div>
                    <div class="flex gap-2">
                        <button id="print-route"
                            class="bg-white hover:bg-yellow-100 text-black font-black px-3 py-2 text-sm border-2 border-black transition-colors flex items-center">
                            <i class="fas fa-print mr-1"></i>Cetak
                        </button>
                        <button id="close-route"
                            class="bg-white hover:bg-red-100 text-black font-black px-3 py-2 text-sm border-2 border-black transition-colors flex items-center">
                            <i class="fas fa-times mr-1"></i>Tutup
                        </button>
                    </div>
                </div>
                <div id="route-instructions" class="mt-3 text-sm text-gray-700 font-bold max-h-32 overflow-y-auto pr-2">
                    <!-- Instruksi rute akan ditampilkan di sini -->
                </div>
            </div>

            <!-- Map Element -->
            <div id="map" style="height: 600px; width: 100%;"
                class="border-2 border-black overflow-hidden"></div>

            <!-- Legend -->
            <div class="mt-4 flex flex-wrap gap-4 justify-center">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-blue-500 border-2 border-black"></div>
                    <span class="text-sm font-black text-gray-600">Kos Putra</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-pink-500 border-2 border-black"></div>
                    <span class="text-sm font-black text-gray-600">Kos Putri</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-purple-500 border-2 border-black"></div>
                    <span class="text-sm font-black text-gray-600">Kos Campuran</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-emerald-500 border-2 border-black"></div>
                    <span class="text-sm font-black text-gray-600">Lokasi Anda</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-yellow-500 border-2 border-black"></div>
                    <span class="text-sm font-black text-gray-600">Radius 1 km</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-black border-2 border-black"></div>
                    <span class="text-sm font-black text-gray-600">Rute</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Nearby Kos List (Mobile View) -->
    <div id="nearby-kos-list" class="mt-8 hidden">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-map-marker-alt text-lime-600 mr-3"></i>
                    Kos Terdekat (Dalam 1 km)
                </h2>
                <button id="hide-nearby-list" class="text-gray-500 hover:text-black font-black text-lg transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <!-- Kos terdekat akan ditampilkan di sini -->
            </div>
        </div>
    </div>

    <!-- Kos List (Mobile View) -->
    <div class="mt-8 lg:hidden">
        <h2 class="text-xl font-black text-black mb-4 flex items-center">
            <i class="fas fa-home text-pink-500 mr-3"></i>
            Daftar Kos Terdekat
        </h2>
        <div class="grid grid-cols-1 gap-4">
            <?php $__currentLoopData = $kos->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white border-2 border-black p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="font-black text-black"><?php echo e($k->nama_kos); ?></h3>
                            <p class="text-sm font-black text-gray-600 mt-1"><?php echo e($k->alamat); ?></p>
                            <div class="flex items-center gap-4 mt-2">
                                <span class="text-xs font-black px-2.5 py-1 border-2 border-black
                                    <?php echo e($k->jenis_kos == 'putra' ? 'bg-blue-200 text-black' :
                                        ($k->jenis_kos == 'putri' ? 'bg-pink-200 text-black' :
                                            'bg-purple-200 text-black')); ?>">
                                    <?php echo e(ucfirst($k->jenis_kos)); ?>

                                </span>
                                <span class="text-xs font-black text-gray-500"><?php echo e($k->kamar_count ?? 0); ?> Kamar</span>
                            </div>
                        </div>
                        <div class="text-right ml-4">
                            <div class="mb-2">
                                <?php if(($k->kamar->min('harga') ?? 0) > 0): ?>
                                    <span class="text-sm font-black text-black">
                                        Rp <?php echo e(number_format($k->kamar->min('harga'), 0, ',', '.')); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-sm font-black text-red-500">Kamar tidak tersedia</span>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo e(route('public.kos.show', $k->id_kos)); ?>"
                                class="inline-flex items-center justify-center px-3 py-1.5 bg-lime-400 hover:bg-lime-500 text-black font-black text-sm border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                                <i class="fas fa-eye mr-1 text-xs"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine -->
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <script>
        // ============================================================
        // LOGIKA JAVASCRIPT ASLI - TIDAK DIUBAH SAMA SEKALI
        // ============================================================
        
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM loaded, initializing map...');

            // Elemen map
            const mapElement = document.getElementById('map');
            if (!mapElement) {
                console.error('Map element not found!');
                return;
            }

            // Default coordinates (Jakarta)
            const defaultLat = -6.208763;
            const defaultLng = 106.845599;

            // Initialize map
            let map;
            try {
                map = L.map('map').setView([defaultLat, defaultLng], 12);
                console.log('Map initialized successfully');
            } catch (error) {
                console.error('Error initializing map:', error);
                return;
            }

            // Add tile layer with dark theme
            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                maxZoom: 19,
                subdomains: 'abcd'
            }).addTo(map);

            // Custom icons based on kos type
            const icons = {
                putra: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    className: 'kos-marker'
                }),
                putri: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    className: 'kos-marker'
                }),
                campuran: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    className: 'kos-marker'
                }),
                user: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    className: 'user-marker'
                }),
                destination: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-gold.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    className: 'destination-marker'
                })
            };

            // Store all markers and kos data
            let markers = [];
            let userLocationMarker = null;
            let radiusCircle = null;
            let currentUserLocation = null;
            let routingControl = null;

            // Function to calculate distance between two coordinates in kilometers
            function calculateDistance(lat1, lon1, lat2, lon2) {
                const R = 6371; // Radius of the earth in km
                const dLat = deg2rad(lat2 - lat1);
                const dLon = deg2rad(lon2 - lon1);
                const a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                const distance = R * c; // Distance in km
                return distance;
            }

            function deg2rad(deg) {
                return deg * (Math.PI / 180);
            }

            // Function to format distance
            function formatDistance(distance) {
                if (distance < 1) {
                    return Math.round(distance * 1000) + ' m';
                }
                return distance.toFixed(1) + ' km';
            }

            // Function to show notification
            function showNotification(message, type = 'info') {
                // Remove existing notification
                const existingNotification = document.querySelector('.custom-notification');
                if (existingNotification) {
                    existingNotification.remove();
                }

                // Create new notification
                const notification = document.createElement('div');
                notification.className = `custom-notification ${type}`;
                notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas ${type === 'success' ? 'fa-check-circle text-emerald-400' :
                        type === 'error' ? 'fa-times-circle text-red-400' :
                            type === 'warning' ? 'fa-exclamation-triangle text-yellow-400' :
                                'fa-info-circle text-blue-400'
                    } mr-3"></i>
                            <span>${message}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="ml-4 text-gray-600 hover:text-white">
                            <i class="fas fa-times"></i>
                        </button>
                    `;

                document.body.appendChild(notification);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 5000);
            }

            // Function to remove existing route
            function removeRoute() {
                if (routingControl) {
                    map.removeControl(routingControl);
                    routingControl = null;
                }

                // Hide route control panel
                const routePanel = document.getElementById('route-control-panel');
                if (routePanel) {
                    routePanel.classList.add('hidden');
                }
            }

            // Function to show route
            function showRoute(fromLat, fromLng, toLat, toLng, kosName, kosAddress, kosId = null) {
                // Remove existing route
                removeRoute();

                // Cari marker kos asli berdasarkan ID atau koordinat
                let originalKosMarker = null;
                if (kosId) {
                    originalKosMarker = markers.find(k => k.id === kosId)?.marker;
                } else {
                    // Fallback: cari berdasarkan koordinat
                    originalKosMarker = markers.find(k =>
                        Math.abs(k.lat - toLat) < 0.0001 &&
                        Math.abs(k.lng - toLng) < 0.0001
                    )?.marker;
                }

                // Create routing control
                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(fromLat, fromLng),
                        L.latLng(toLat, toLng)
                    ],
                    routeWhileDragging: false,
                    showAlternatives: false,
                    fitSelectedRoutes: true,
                    show: false, // Hide default instructions panel
                    router: L.Routing.osrmv1({
                        serviceUrl: 'https://router.project-osrm.org/route/v1'
                    }),
                    lineOptions: {
                        styles: [
                            {
                                color: '#10b981',
                                weight: 5,
                                opacity: 0.8
                            }
                        ]
                    },
                    createMarker: function (i, waypoint, n) {
                        if (i === 0) {
                            // Marker untuk titik awal (lokasi pengguna)
                            return L.marker(waypoint.latLng, {
                                icon: icons.user
                            }).bindPopup(`
                                    <div class="p-2">
                                        <div class="text-emerald-400 text-lg mb-1 text-center">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="font-bold text-black">📍 Lokasi Anda</div>
                                    </div>
                                `);
                        } else {
                            // Untuk titik tujuan, KOSONGKAN - jangan buat marker baru
                            // Karena marker kos asli sudah ada
                            return null;
                        }
                    }
                });

                // Sembunyikan container panel kanan SETELAH routing ditambahkan ke map
                routingControl.on('add', function () {
                    const container = this.getContainer();
                    if (container) {
                        container.style.display = 'none';
                    }
                });

                routingControl.addTo(map);

                // Panggil langsung untuk jaga-jaga
                (function (ctrl) {
                    const container = ctrl.getContainer();
                    if (container) {
                        container.style.display = 'none';
                    }
                })(routingControl);

                // Event ketika route ditemukan
                routingControl.on('routesfound', function (e) {
                    // Sembunyikan container panel kanan (routing machine memunculkannya setelah _updateRoutes)
                    const ctr = this.getContainer();
                    if (ctr) {
                        ctr.style.display = 'none';
                    }

                    const routes = e.routes;
                    const route = routes[0];

                    if (route && route.summary) {
                        const distance = (route.summary.totalDistance / 1000).toFixed(1);
                        const time = Math.round(route.summary.totalTime / 60);

                        // Update route control panel
                        const routePanel = document.getElementById('route-control-panel');
                        const routeTitle = document.getElementById('route-title');
                        const routeDistance = document.getElementById('route-distance');
                        const routeInstructions = document.getElementById('route-instructions');

                        if (routePanel) {
                            routePanel.classList.remove('hidden');
                            routeTitle.textContent = `Rute ke ${kosName}`;
                            routeDistance.textContent = `📏 ${distance} km • ⏱️ ${time} menit`;

                            // Update instruksi rute
                            if (routeInstructions && route.instructions) {
                                routeInstructions.innerHTML = '';
                                route.instructions.forEach((instruction, index) => {
                                    const step = document.createElement('div');
                                    step.className = 'route-instruction-item';
                                    step.innerHTML = `
                                            <div class="flex items-start">
                                                <div class="route-step-icon">${index + 1}</div>
                                                <div>
                                                    <div class="text-white text-sm">${instruction.text}</div>
                                                    <div class="text-emerald-300/70 text-xs mt-1">
                                                        ${formatDistance(instruction.distance / 1000)}
                                                    </div>
                                                </div>
                                            </div>
                                        `;
                                    routeInstructions.appendChild(step);
                                });
                            }
                        }

                        // Buka popup kos asli (jika ada)
                        if (originalKosMarker) {
                            // Tunda sedikit agar routing selesai dulu
                            setTimeout(() => {
                                originalKosMarker.openPopup();
                            }, 500);
                        }

                        showNotification(`Rute ke ${kosName} ditemukan (${distance} km)`, 'success');
                    }
                });

                routingControl.on('routingerror', function (e) {
                    console.error('Routing error:', e.error);
                    showNotification('Tidak dapat menemukan rute. Coba lagi nanti.', 'error');
                });

                // Fit bounds untuk menampilkan seluruh rute
                setTimeout(() => {
                    if (routingControl && routingControl.getPlan()) {
                        const bounds = L.latLngBounds([
                            [fromLat, fromLng],
                            [toLat, toLng]
                        ]);
                        map.fitBounds(bounds, { padding: [50, 50] });
                    }
                }, 100);
            }

            // FITUR 1: Ketika tombol "Cari Kos Terdekat" ditekan, langsung muncul rute ke kos terdekat
            function findNearestKosAndShowRoute(userLat, userLng) {
                let nearestKos = null;
                let minDistance = Infinity;

                // Cari kos terdekat dalam radius 1 km
                markers.forEach(kos => {
                    const distance = calculateDistance(userLat, userLng, kos.lat, kos.lng);

                    if (distance <= 1 && distance < minDistance) {
                        minDistance = distance;
                        nearestKos = {
                            ...kos,
                            distance: distance
                        };
                    }
                });

                // Jika ditemukan kos terdekat dalam 1 km, tampilkan rute
                if (nearestKos) {
                    showRoute(
                        userLat,
                        userLng,
                        nearestKos.lat,
                        nearestKos.lng,
                        nearestKos.nama,
                        nearestKos.alamat,
                        nearestKos.id // Kirim ID kos untuk referensi
                    );

                    // Highlight the nearest kos marker
                    if (nearestKos.marker && nearestKos.marker._icon) {
                        nearestKos.marker._icon.classList.add('nearby-marker');

                        // Buka popup kos asli
                        setTimeout(() => {
                            nearestKos.marker.openPopup();
                        }, 1000);
                    }

                    showNotification(`Menampilkan rute ke kos terdekat: ${nearestKos.nama} (${formatDistance(minDistance)})`, 'success');
                    return nearestKos;
                }

                return null;
            }

            // FITUR 2: Ketika marker kos ditekan, muncul tombol untuk menampilkan rute
            function createKosPopupContent(kos) {
                return `
                        <div class="p-3" style="min-width: 250px; background: #1e293b; color: #e2e8f0;">
                            <h3 class="font-black text-lg text-white mb-2">${kos.nama}</h3>
                            <p class="text-sm text-gray-600 mb-3">${kos.alamat}</p>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-2 py-1 text-xs  
                                    ${kos.jenis == 'putra' ? 'bg-blue-900/30 text-black' :
                        (kos.jenis == 'putri' ? 'bg-pink-900/30 text-pink-300' :
                            'bg-purple-900/30 text-purple-300')}">
                                    ${kos.jenis.charAt(0).toUpperCase() + kos.jenis.slice(1)}
                                </span>
                                <span class="px-2 py-1 text-xs  bg-emerald-900/30 text-emerald-300">
                                    ${kos.tipe.charAt(0).toUpperCase() + kos.tipe.slice(1)}
                                </span>
                            </div>

                            <div class="mt-4 flex flex-col space-y-2">
                                <div class="flex justify-between items-center">
                                    <div>
                                        ${kos.minHarga > 0 ?
                        `<span class="text-sm font-black text-white">
                                                Mulai Rp ${kos.minHarga.toLocaleString('id-ID')}
                                            </span>` :
                        `<span class="text-sm font-black text-red-400">
                                                Kamar tidak tersedia
                                            </span>`
                    }
                                    </div>
                                    <span class="text-xs text-gray-600">${kos.kamarCount} Kamar</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <a href="${kos.detailUrl}" 
                                    class="bg-yellow-400 hover:bg-yellow-500  text-white px-3 py-2  text-sm transition-all duration-300 inline-flex items-center justify-center shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000]" style="color: white !important;">
                                        <i class="fas fa-eye mr-1 text-xs"></i>
                                        Detail
                                    </a>
                                    <button onclick="window.showRouteToKos(${kos.lat}, ${kos.lng}, '${kos.nama.replace(/'/g, "\\'")}', '${kos.alamat.replace(/'/g, "\\'")}')" 
                                    class="bg-yellow-400 hover:bg-yellow-500  text-white px-3 py-2  text-sm transition-all duration-300 inline-flex items-center justify-center shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000]">
                                        <i class="fas fa-route mr-1 text-xs"></i>
                                        Rute
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
            }

            // Global function to show route to specific kos (called from popup)
            window.showRouteToKos = function (kosLat, kosLng, kosName, kosAddress) {
                if (!currentUserLocation) {
                    // If user location not available, ask for permission
                    if (navigator.geolocation) {
                        showNotification('Meminta izin lokasi untuk menampilkan rute...', 'info');

                        navigator.geolocation.getCurrentPosition(function (position) {
                            const userLat = position.coords.latitude;
                            const userLng = position.coords.longitude;

                            currentUserLocation = { lat: userLat, lng: userLng };

                            // Add user marker
                            if (userLocationMarker) {
                                map.removeLayer(userLocationMarker);
                            }

                            userLocationMarker = L.marker([userLat, userLng], {
                                icon: icons.user
                            }).addTo(map);

                            // Show route
                            showRoute(userLat, userLng, kosLat, kosLng, kosName, kosAddress);

                        }, function (error) {
                            console.error('Geolocation error:', error);
                            showNotification('Izin lokasi diperlukan untuk menampilkan rute', 'error');
                        });
                    } else {
                        showNotification('Browser tidak mendukung geolocation', 'error');
                    }
                } else {
                    // Show route using known user location
                    showRoute(
                        currentUserLocation.lat,
                        currentUserLocation.lng,
                        kosLat,
                        kosLng,
                        kosName,
                        kosAddress
                    );
                }
            };

            // Function to find nearby kos (within 1 km)
            function findNearbyKos(userLat, userLng) {
                console.log('Finding nearby kos from:', userLat, userLng);

                currentUserLocation = { lat: userLat, lng: userLng };

                map.setView([userLat, userLng], 15);

                // Clear previous radius circle
                if (radiusCircle) {
                    map.removeLayer(radiusCircle);
                }

                // Add radius circle (1 km)
                radiusCircle = L.circle([userLat, userLng], {
                    color: '#f59e0b',
                    fillColor: '#fef3c7',
                    fillOpacity: 0.15,
                    radius: 1000, // 1 km in meters
                    className: 'radius-circle'
                }).addTo(map);

                let nearbyCount = 0;
                const nearbyKos = [];

                // Check each kos
                markers.forEach(kos => {
                    const distance = calculateDistance(userLat, userLng, kos.lat, kos.lng);

                    if (distance <= 1) { // Within 1 km
                        nearbyCount++;
                        nearbyKos.push({
                            ...kos,
                            distance: distance
                        });

                        // Add animation to nearby markers
                        if (kos.marker && kos.marker._icon) {
                            kos.marker._icon.classList.add('nearby-marker');
                        }

                        // Bring to front
                        kos.marker.bringToFront();
                    } else {
                        // Remove animation
                        if (kos.marker && kos.marker._icon) {
                            kos.marker._icon.classList.remove('nearby-marker');
                        }
                    }
                });

                console.log('Nearby kos found:', nearbyCount);

                // Show nearby info
                const nearbyInfo = document.getElementById('nearby-info');
                if (nearbyInfo) {
                    nearbyInfo.classList.remove('hidden');
                    document.getElementById('nearby-count').textContent = nearbyCount;
                }

                // Show nearby kos list for mobile
                if (nearbyKos.length > 0) {
                    showNearbyKosList(nearbyKos);
                }

                // Fit map to show all nearby kos and user location
                if (nearbyKos.length > 0) {
                    const bounds = L.latLngBounds([[userLat, userLng]]);
                    nearbyKos.forEach(kos => {
                        bounds.extend([kos.lat, kos.lng]);
                    });
                    map.fitBounds(bounds, { padding: [50, 50] });
                }

                return nearbyKos;
            }

            // Function to show nearby kos list
            function showNearbyKosList(nearbyKos) {
                const container = document.getElementById('nearby-kos-list');
                if (!container) return;

                const listContainer = container.querySelector('.grid');

                // Sort by distance
                nearbyKos.sort((a, b) => a.distance - b.distance);

                // Clear previous content
                listContainer.innerHTML = '';

                // Add each nearby kos
                nearbyKos.forEach(kos => {
                    const kosElement = document.createElement('div');
                    kosElement.className = 'bg-white border-2 border-black  p-4 hover:border-emerald-300 transition-all duration-300 hover:shadow-[3px_3px_0px_#000] hover:-translate-y-1 card-hover';
                    kosElement.innerHTML = `
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-black text-black mb-2">${kos.nama}</h3>
                                    <p class="text-sm text-gray-600 mb-3">${kos.alamat}</p>
                                    <div class="flex items-center gap-3">
                                        <span class="text-xs px-2 py-1  ${kos.jenis == 'putra' ? 'bg-blue-50 text-blue-700 border border-blue-100' : (kos.jenis == 'putri' ? 'bg-pink-50 text-pink-700 border border-pink-100' : 'bg-purple-50 text-purple-700 border border-purple-100')}">
                                            ${kos.jenis.charAt(0).toUpperCase() + kos.jenis.slice(1)}
                                        </span>
                                        <span class="text-xs text-gray-600">${kos.kamarCount} Kamar</span>
                                        <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-1  border border-emerald-100">
                                            <i class="fas fa-ruler mr-1"></i>
                                            ${formatDistance(kos.distance)}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right ml-4">
                                    <div class="mb-2">
                                        ${kos.minHarga > 0 ?
                            `<span class="text-sm font-black text-black">
                                                Rp ${kos.minHarga.toLocaleString('id-ID')}
                                            </span>` :
                            `<span class="text-sm font-black text-rose-500">
                                                Kamar tidak tersedia
                                            </span>`
                        }
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <a href="${kos.detailUrl}" 
                                        class="inline-flex items-center justify-center px-3 py-1.5 bg-sky-500 hover:bg-sky-600 text-white  text-sm transition-all duration-300 shadow-[2px_2px_0px_#000] hover:shadow-md">
                                            <i class="fas fa-eye mr-1 text-xs"></i>
                                            Detail
                                        </a>
                                        <button onclick="window.showRouteToKos(${kos.lat}, ${kos.lng}, '${kos.nama.replace(/'/g, "\\'")}', '${kos.alamat.replace(/'/g, "\\'")}')" 
                                        class="inline-flex items-center justify-center px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white  text-sm transition-all duration-300 shadow-[2px_2px_0px_#000] hover:shadow-md">
                                            <i class="fas fa-route mr-1 text-xs"></i>
                                            Rute
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                    listContainer.appendChild(kosElement);
                });

                // Show the container
                container.classList.remove('hidden');
                container.scrollIntoView({ behavior: 'smooth' });
            }

            // Function to clear nearby filter
            function clearNearbyFilter() {
                console.log('Clearing nearby filter');

                // Remove radius circle
                if (radiusCircle) {
                    map.removeLayer(radiusCircle);
                    radiusCircle = null;
                }

                // Remove user location marker
                if (userLocationMarker) {
                    map.removeLayer(userLocationMarker);
                    userLocationMarker = null;
                }

                // Remove route
                removeRoute();

                // Remove animation from all markers
                markers.forEach(kos => {
                    if (kos.marker && kos.marker._icon) {
                        kos.marker._icon.classList.remove('nearby-marker');
                    }
                });

                // Hide nearby info
                const nearbyInfo = document.getElementById('nearby-info');
                if (nearbyInfo) {
                    nearbyInfo.classList.add('hidden');
                }

                // Hide nearby kos list
                const nearbyList = document.getElementById('nearby-kos-list');
                if (nearbyList) {
                    nearbyList.classList.add('hidden');
                }

                currentUserLocation = null;
            }

            // Add markers for each kos
            <?php $__currentLoopData = $kos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($k->latitude && $k->longitude): ?>
                    try {
                        const kosData = {
                            id: <?php echo e($k->id_kos); ?>,
                            jenis: '<?php echo e($k->jenis_kos); ?>',
                            tipe: '<?php echo e($k->tipe_sewa); ?>',
                            harga: <?php echo e($k->kamar->min('harga') ?? 0); ?>,
                            lat: <?php echo e($k->latitude); ?>,
                            lng: <?php echo e($k->longitude); ?>,
                            nama: '<?php echo e(addslashes($k->nama_kos)); ?>',
                            alamat: '<?php echo e(addslashes($k->alamat)); ?>',
                            detailUrl: '<?php echo e(route('public.kos.show', $k->id_kos)); ?>',
                            minHarga: <?php echo e($k->kamar->min('harga') ?? 0); ?>,
                            kamarCount: <?php echo e($k->kamar_count ?? 0); ?>

                                    };

                        const marker = L.marker([<?php echo e($k->latitude); ?>, <?php echo e($k->longitude); ?>], {
                            icon: icons['<?php echo e($k->jenis_kos); ?>'] || icons.campuran,
                            riseOnHover: true
                        }).addTo(map);

                        marker.bindPopup(createKosPopupContent(kosData), {
                            maxWidth: 300,
                            className: 'custom-popup'
                        });

                        // Store marker reference
                        kosData.marker = marker;
                        markers.push(kosData);

                    } catch (error) {
                        console.error('Error adding marker for kos <?php echo e($k->id_kos); ?>:', error);
                    }
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            console.log('Total markers added:', markers.length);

            // Event listener for "Cari Kos Terdekat" button
            document.getElementById('find-nearby').addEventListener('click', function () {
                console.log('Finding nearby kos...');

                if (navigator.geolocation) {
                    // Show loading state
                    const button = this;
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mencari lokasi...';
                    button.disabled = true;

                    navigator.geolocation.getCurrentPosition(function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        console.log('User location obtained:', lat, lng);

                        // Add or update user location marker
                        if (userLocationMarker) {
                            map.removeLayer(userLocationMarker);
                        }

                        userLocationMarker = L.marker([lat, lng], {
                            icon: icons.user
                        }).addTo(map).bindPopup(`
                                <div class="p-2 text-center">
                                    <div class="text-emerald-400 text-lg mb-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="font-bold text-black">📍 Lokasi Anda Sekarang</div>
                                    <div class="text-xs text-gray-600 mt-1">${lat.toFixed(6)}, ${lng.toFixed(6)}</div>
                                </div>
                            `).openPopup();

                        // Restore button state
                        button.innerHTML = originalText;
                        button.disabled = false;

                        // FITUR 1: Cari kos terdekat dan tampilkan rute otomatis
                        const nearestKos = findNearestKosAndShowRoute(lat, lng);

                        // Juga tampilkan semua kos dalam radius 1 km
                        findNearbyKos(lat, lng);

                    }, function (error) {
                        console.error('Geolocation error:', error);
                        showNotification('Tidak dapat mengakses lokasi. Pastikan izin lokasi diaktifkan.', 'error');

                        // Restore button state
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    });
                } else {
                    showNotification('Geolocation tidak didukung oleh browser ini.', 'error');
                }
            });

            // Event listener for "Hapus Filter Jarak" button
            document.getElementById('clear-nearby')?.addEventListener('click', clearNearbyFilter);

            // Event listener for "Tutup" button on mobile list
            document.getElementById('hide-nearby-list')?.addEventListener('click', function () {
                const nearbyList = document.getElementById('nearby-kos-list');
                if (nearbyList) {
                    nearbyList.classList.add('hidden');
                }
            });

            // Event listener for "Tutup Rute" button
            document.getElementById('close-route')?.addEventListener('click', removeRoute);

            // Event listener for "Cetak Rute" button
            document.getElementById('print-route')?.addEventListener('click', function () {
                const routeInstructions = document.getElementById('route-instructions');
                if (routeInstructions) {
                    const printWindow = window.open('', '_blank');
                    printWindow.document.write(`
                            <html>
                                <head>
                                    <title>Rute ke Kos</title>
                                    <style>
                                        body { font-family: Arial, sans-serif; padding: 20px; background: #0f172a; color: #e2e8f0; }
                                        h1 { color: #e2e8f0; }
                                        .instruction { margin: 10px 0; padding: 10px; border-left: 3px solid #10b981; background: #1e293b; }
                                        .distance { color: #94a3b8; font-size: 0.9em; }
                                        hr { border-color: #334155; }
                                    </style>
                                </head>
                                <body>
                                    <h1>${document.getElementById('route-title').textContent}</h1>
                                    <p>${document.getElementById('route-distance').textContent}</p>
                                    <hr>
                                    ${routeInstructions.innerHTML}
                                </body>
                            </html>
                        `);
                    printWindow.document.close();
                    printWindow.print();
                }
            });

            // Filter functionality
            document.getElementById('apply-filter')?.addEventListener('click', function () {
                const jenisFilter = document.getElementById('filter-jenis').value;
                const tipeFilter = document.getElementById('filter-tipe').value;
                const hargaFilter = document.getElementById('filter-harga').value;

                markers.forEach(item => {
                    let show = true;

                    // Filter by jenis
                    if (jenisFilter && item.jenis !== jenisFilter) {
                        show = false;
                    }

                    // Filter by tipe
                    if (tipeFilter && item.tipe !== tipeFilter) {
                        show = false;
                    }

                    // Filter by harga
                    if (hargaFilter) {
                        const [min, max] = hargaFilter.split('-').map(Number);
                        if (item.harga < min || item.harga > max) {
                            show = false;
                        }
                    }

                    // Additional filter for nearby kos
                    if (currentUserLocation && radiusCircle) {
                        const distance = calculateDistance(
                            currentUserLocation.lat,
                            currentUserLocation.lng,
                            item.lat,
                            item.lng
                        );
                        if (distance > 1) {
                            show = false;
                        }
                    }

                    // Show/hide marker
                    if (show) {
                        if (!map.hasLayer(item.marker)) {
                            map.addLayer(item.marker);
                        }
                    } else {
                        if (map.hasLayer(item.marker)) {
                            map.removeLayer(item.marker);
                        }
                    }
                });
            });

            // Reset filter
            document.getElementById('reset-filter')?.addEventListener('click', function () {
                document.getElementById('filter-jenis').value = '';
                document.getElementById('filter-tipe').value = '';
                document.getElementById('filter-harga').value = '';

                markers.forEach(item => {
                    if (!map.hasLayer(item.marker)) {
                        map.addLayer(item.marker);
                    }
                });

                // Also clear nearby filter
                clearNearbyFilter();
            });

            // Add custom geolocation button to map
            const locateButton = L.control({ position: 'topleft' });
            locateButton.onAdd = function (map) {
                const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
                div.innerHTML = '<a href="#" title="Lokasi Saya" style="padding: 6px; background: #1e293b; color: #e2e8f0; border-radius: 4px; display: block; font-size: 16px; line-height: 1;"><i class="fas fa-location-arrow"></i></a>';
                div.onclick = function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    document.getElementById('find-nearby').click();
                };
                return div;
            };
            locateButton.addTo(map);

            // Add custom legend
            const legend = L.control({ position: 'bottomright' });
            legend.onAdd = function (map) {
                const div = L.DomUtil.create('div', 'legend');
                div.innerHTML = `
                        <h4 style="font-weight: 600; margin-bottom: 8px; color: #e2e8f0; font-size: 14px;">Keterangan:</h4>
                        <div style="display: flex; align-items: center; margin-bottom: 6px;">
                            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png" style="width: 16px; height: 24px; margin-right: 8px; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.3));">
                            <span style="font-size: 13px; color: #94a3b8;">Kos Putra</span>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 6px;">
                            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png" style="width: 16px; height: 24px; margin-right: 8px; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.3));">
                            <span style="font-size: 13px; color: #94a3b8;">Kos Putri</span>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 6px;">
                            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png" style="width: 16px; height: 24px; margin-right: 8px; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.3));">
                            <span style="font-size: 13px; color: #94a3b8;">Kos Campuran</span>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 6px;">
                            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png" style="width: 16px; height: 24px; margin-right: 8px; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.3));">
                            <span style="font-size: 13px; color: #94a3b8;">Lokasi Anda</span>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div style="width: 16px; height: 16px; border-radius: 50%; background-color: #f59e0b; margin-right: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></div>
                            <span style="font-size: 13px; color: #94a3b8;">Radius 1 km</span>
                        </div>
                    `;
                return div;
            };
            legend.addTo(map);

            // Force map resize
            setTimeout(() => {
                map.invalidateSize();
                console.log('Map resized');
            }, 100);

            // Map loaded event
            map.whenReady(() => {
                console.log('Map fully loaded');
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', ['hideFooter' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\public\kos\peta.blade.php ENDPATH**/ ?>