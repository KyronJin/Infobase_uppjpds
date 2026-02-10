@extends('layouts.app')

@section('content')

<style>
    /* Calendar Aktifitas specific styles */

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 82, 204, 0.15);
        border-color: #0052CC;
    }

    .room-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .filter-btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        border: 2px solid #e2e8f0;
        background: white;
        color: #64748b;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background: #0052CC;
        color: white;
        border-color: #0052CC;
    }

    .filter-btn:hover {
        border-color: #0052CC;
        color: #0052CC;
    }

    .filter-btn.active:hover {
        background: #003A99;
    }

    .pagination-btn {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        border: 2px solid #e2e8f0;
        background: white;
        color: #0052CC;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .pagination-btn:hover:not(:disabled) {
        border-color: #0052CC;
        background: #0052CC;
        color: white;
    }

    .pagination-btn.active {
        background: #0052CC;
        color: white;
        border-color: #0052CC;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<div class="page-header">
    <div class="header-content">
        <div class="header-left">
            <span><i class="fas fa-calendar mr-2"></i>Aktivitas</span>
            <h1><i class="fas fa-calendar-alt mr-3 text-white"></i>Calendar Aktifitas</h1>
            <p>Jadwal lengkap event, workshop, dan kegiatan perpustakaan.</p>
        </div>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>

{{-- Search Form --}}
@include('partials.search-form', [
    'action' => route('infobase.calendar-aktifitas'),
    'placeholder' => 'Cari event berdasarkan judul, deskripsi, atau lokasi...',
    'search' => $search ?? '',
    'resultCount' => isset($events) ? $events->total() : null
])

<div class="min-h-screen bg-[#f8fafc] pt-0 pb-24">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Loading State -->
        <div id="loadingState" class="space-y-6">
            <!-- Summary Cards Skeleton -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="skeleton h-24 rounded-xl"></div>
            </div>
            
            <!-- Filter Skeleton -->
            <div class="skeleton h-12 rounded-xl mb-8"></div>

            <!-- Event List Skeleton -->
            <div class="space-y-4">
                <div class="skeleton h-32 rounded-xl"></div>
                <div class="skeleton h-32 rounded-xl"></div>
                <div class="skeleton h-32 rounded-xl"></div>
            </div>
        </div>

        <!-- Error State -->
        <div id="errorState" class="hidden">
            <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-6 mb-6">
                <div class="flex items-start gap-4">
                    <i class="fas fa-exclamation-circle text-red-500 text-2xl mt-1"></i>
                    <div>
                        <h3 class="text-lg font-bold text-red-900 mb-2">Gagal Memuat Agenda</h3>
                        <p class="text-red-700 mb-4" id="errorMessage"></p>
                        <button onclick="location.reload()" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-semibold">
                            <i class="fas fa-sync-alt mr-2"></i> Coba Lagi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content State -->
        <div id="contentState" class="hidden space-y-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="glass-card rounded-xl p-6 border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide">Total Event</p>
                            <p class="text-4xl font-bold text-[#0052CC] mt-2" id="eventCount">0</p>
                        </div>
                        <div class="text-5xl opacity-30 text-orange-500">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-filter text-[#0052CC]"></i>
                    Filter Jadwal
                </h3>
                <div class="flex flex-wrap gap-3">
                    <button class="filter-btn active" onclick="setFilter('all')">
                        <i class="fas fa-calendar mr-2"></i>Semua Event
                    </button>
                    <button class="filter-btn" onclick="setFilter('week')">
                        <i class="fas fa-calendar-week mr-2"></i>Minggu Depan
                    </button>
                    <button class="filter-btn" onclick="setFilter('month')">
                        <i class="fas fa-calendar-days mr-2"></i>Bulan Ini
                    </button>
                </div>
            </div>

            <!-- Events Section -->
            <div id="eventsSection" class="hidden">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        <i class="fas fa-thumbtack text-3xl text-orange-500"></i>
                        Event
                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold ml-2" id="eventCountBadge">0</span>
                    </h2>
                </div>
                <div id="eventsList" class="space-y-4"></div>
                
                <!-- Pagination -->
                <div id="eventsPagination" class="mt-8 flex items-center justify-center gap-2"></div>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4 block"></i>
                <p class="text-gray-600 text-lg font-semibold">Tidak ada agenda untuk periode ini</p>
                <p class="text-gray-400 mt-2">Silakan pilih filter lain untuk melihat jadwal lainnya</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/utc.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/timezone.js"></script>
<script>
  dayjs.extend(window.dayjs_plugin_utc);
  dayjs.extend(window.dayjs_plugin_timezone);
</script>
<script>
    // ===== KONFIGURASI =====
    const API_BASE_URL = 'https://agenda-cerdas.dimasp.app';
    const ITEMS_PER_PAGE = 8;

    let currentFilter = 'all';
    let currentPage = {
        events: 1
    };
    let allData = null;

    // ===== SET FILTER =====
    function setFilter(filter) {
        currentFilter = filter;
        currentPage = { events: 1 };

        // Update button states
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.closest('.filter-btn').classList.add('active');

        // Re-render
        if (allData) {
            renderAgenda(allData);
        }
    }

    function to24Hour(timeStr) {
    if (!timeStr) return '';
    // Jika sudah format 24 jam (misal: 13:00), langsung return
    if (/^\d{2}:\d{2}$/.test(timeStr)) return timeStr;
    // Jika format 12 jam (misal: 1:00 PM)
    const d = new Date('1970-01-01T' + timeStr);
    if (!isNaN(d)) {
        return d.toTimeString().slice(0,5);
    }
    return timeStr;
}

function toLocal24Hour(utcString) {
    if (!utcString || typeof utcString !== 'string') return '';
    
    try {
        const trimmed = utcString.trim();
        
        // Jika format ISO dengan Z (UTC), parse sebagai UTC
        if (trimmed.includes('T') && trimmed.includes('Z')) {
            return dayjs(trimmed).utc().tz('Asia/Jakarta').format('HH:mm');
        }
        
        // Jika hanya jam (HH:mm), return as-is
        if (/^\d{2}:\d{2}/.test(trimmed)) {
            return trimmed.substring(0, 5);
        }
        
        // Fallback: coba parse langsung
        const parsed = dayjs(trimmed);
        if (parsed.isValid()) {
            return parsed.tz('Asia/Jakarta').format('HH:mm');
        }
        
        return '';
    } catch (error) {
        console.warn('toLocal24Hour error:', utcString, error.message);
        return '';
    }
}

    // ===== FETCH AGENDA =====
    async function fetchAgenda() {
        try {
            document.getElementById('loadingState').classList.remove('hidden');
            document.getElementById('errorState').classList.add('hidden');
            document.getElementById('contentState').classList.add('hidden');

            const response = await fetch(`${API_BASE_URL}/api/v1/events`);

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();

            if (!data.success) {
                throw new Error(data.message || 'Gagal mengambil data agenda');
            }

            console.log('📥 Data agenda berhasil diambil:', data);

            const filteredData = filterEventsFromToday(data);
            allData = filteredData;
            renderAgenda(filteredData);

            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('contentState').classList.remove('hidden');

        } catch (error) {
            console.error('❌ Error:', error);
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('errorState').classList.remove('hidden');
            document.getElementById('errorMessage').textContent = 
                `${error.message}. Pastikan URL API sudah benar: ${API_BASE_URL}`;
        }
    }

    // ===== FILTER DATA: HANYA DARI HARI INI KE DEPAN =====
    // ...existing code...
        // ===== FILTER DATA: HANYA DARI HARI INI KE DEPAN =====
        function filterEventsFromToday(data) {
            // Hitung batas waktu hari ini (Start of Day Jakarta) dalam Timestamp (ms)
            // Timestamp adalah angka, jadi perbandingannya pasti aman & cepat
            let cutoffTimestamp;
            try {
                cutoffTimestamp = dayjs().tz('Asia/Jakarta').startOf('day').valueOf();
            } catch (e) {
                console.warn("Fallback cutoff to local time");
                cutoffTimestamp = dayjs().startOf('day').valueOf();
            }
            
            const filteredData = { ...data };
            if (!filteredData.data) filteredData.data = {};
        
            filteredData.data.events = (data.data.events || []).filter((event) => {
                try {
                    // Ambil string tanggal
                    const eventDateStr = (event.startTime || event.date || '').trim();
                    if (!eventDateStr) return false;
                    
                    // STRATEGI AMAN: Bandingkan Timestamp (ms)
                    let eventTimestamp;
                    
                    if (eventDateStr.includes('T')) {
                        // ISO Format (e.g. 2026-01-30T03:00:00Z)
                        // dayjs(str).valueOf() sangat aman & standard
                        eventTimestamp = dayjs(eventDateStr).valueOf();
                    } else if (/^\d{4}-\d{2}-\d{2}$/.test(eventDateStr)) {
                        // Date Format (2026-01-30)
                        // Coba parse sebagai Jakarta time, fallback ke local jika error
                        try {
                            eventTimestamp = dayjs.tz(eventDateStr, 'Asia/Jakarta').startOf('day').valueOf();
                        } catch (e) {
                            eventTimestamp = dayjs(eventDateStr).startOf('day').valueOf();
                        }
                    } else {
                        return false;
                    }
    
                    if (!eventTimestamp || isNaN(eventTimestamp)) return false;
                    
                    // Bandingkan angka timestamp (Event >= Hari Ini)
                    return eventTimestamp >= cutoffTimestamp;
                    
                } catch (error) {
                    console.warn("Filter skip event:", event.title);
                    return false;
                }
            });
        
            if (filteredData.summary) {
                filteredData.summary.totalEvents = filteredData.data.events.length;
            }
        
            return filteredData;
        }
    
        // ===== APPLY FILTER BY DATE RANGE =====
        function applyDateFilter(items) {
            if (currentFilter === 'all') return items;
        
            // Siapkan range waktu (timestamp)
            let startTimestamp, endTimestamp;
            try {
                const now = dayjs().tz('Asia/Jakarta').startOf('day');
                startTimestamp = now.valueOf();
                if (currentFilter === 'week') {
                    endTimestamp = now.add(7, 'day').valueOf();
                }
            } catch (e) {
                const now = dayjs().startOf('day');
                startTimestamp = now.valueOf();
                if (currentFilter === 'week') {
                    endTimestamp = now.add(7, 'day').valueOf();
                }
            }
        
            return items.filter(item => {
                try {
                    const eventDateStr = (item.startTime || item.date || '').trim();
                    if (!eventDateStr) return false;
                    
                    let eventTimestamp; // ms
                    
                    if (eventDateStr.includes('T')) {
                        eventTimestamp = dayjs(eventDateStr).valueOf();
                    } else {
                        try {
                            eventTimestamp = dayjs.tz(eventDateStr, 'Asia/Jakarta').startOf('day').valueOf();
                        } catch (e) {
                            eventTimestamp = dayjs(eventDateStr).startOf('day').valueOf();
                        }
                    }
                    
                    if (!eventTimestamp || isNaN(eventTimestamp)) return false;
    
                    if (currentFilter === 'week') {
                        return eventTimestamp >= startTimestamp && eventTimestamp <= endTimestamp;
                    }
    
                    if (currentFilter === 'month') {
                        // Logika bulan butuh extraksi komponen
                        let d;
                        // Parse ulang ke object dayjs yg aman
                        if (eventDateStr.includes('T')) d = dayjs(eventTimestamp); 
                        else d = dayjs(eventTimestamp);
    
                        // Konversi ke Jakarta jika bisa, biar bulan akurat
                        try { d = d.tz('Asia/Jakarta'); } catch(e) {}
                        
                        let nowD = dayjs(startTimestamp);
                        try { nowD = nowD.tz('Asia/Jakarta'); } catch(e) {}
    
                        return d.month() === nowD.month() && d.year() === nowD.year();
                    }
                    
                    return true;
                } catch (error) {
                    return false;
                }
            });
        }
    // ...existing code...

    // ===== PAGINATION HELPER =====
    function paginate(items, page) {
        const start = (page - 1) * ITEMS_PER_PAGE;
        const end = start + ITEMS_PER_PAGE;
        return items.slice(start, end);
    }

    function createPagination(totalItems, currentPage, pageChangeCallback, containerId) {
        const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);
        const container = document.getElementById(containerId);
        
        if (!container || totalPages <= 1) return;

        let html = '';

        // Previous button
        html += `<button class="pagination-btn" ${currentPage === 1 ? 'disabled' : ''} onclick="${pageChangeCallback}(${currentPage - 1})">
            <i class="fas fa-chevron-left"></i>
        </button>`;

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                html += `<button class="pagination-btn ${i === currentPage ? 'active' : ''}" onclick="${pageChangeCallback}(${i})">${i}</button>`;
            } else if (i === 2 || i === totalPages - 1) {
                html += `<span class="text-gray-400">...</span>`;
            }
        }

        // Next button
        html += `<button class="pagination-btn" ${currentPage === totalPages ? 'disabled' : ''} onclick="${pageChangeCallback}(${currentPage + 1})">
            <i class="fas fa-chevron-right"></i>
        </button>`;

        container.innerHTML = html;
    }

    // ===== PAGE CHANGE FUNCTIONS =====
    function changeEventsPage(page) {
        currentPage.events = page;
        renderEvents();
    }

    // ===== RENDER AGENDA =====
    function renderAgenda(data) {
        const { events } = data.data;
        const { totalEvents } = data.summary;

        document.getElementById('eventCount').textContent = totalEvents;

        const hasData = totalEvents > 0;

        if (!hasData) {
            document.getElementById('emptyState').classList.remove('hidden');
            document.getElementById('eventsSection').classList.add('hidden');
            return;
        }

        document.getElementById('emptyState').classList.add('hidden');

        // Filter by date range
        const filteredEvents = applyDateFilter(events);

        if (filteredEvents.length > 0) {
            document.getElementById('eventsSection').classList.remove('hidden');
            document.getElementById('eventCountBadge').textContent = filteredEvents.length;
            renderEvents(filteredEvents);
        } else {
            document.getElementById('eventsSection').classList.add('hidden');
        }
    }

    // ===== RENDER EVENTS =====
    function renderEvents(events = []) {
        if (!allData) return;
        
        const filtered = applyDateFilter(allData.data.events || []);
        const sorted = filtered.sort((a, b) => new Date(a.startTime) - new Date(b.startTime));
        const paginatedEvents = paginate(sorted, currentPage.events);

        const eventsList = document.getElementById('eventsList');
        eventsList.innerHTML = paginatedEvents.map(event => `
            <div class="event-card rounded-xl p-6 border-l-4 border-blue-500 hover:border-[#0052CC]">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-[#0052CC]">${escapeHtml(event.title)}</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4 text-sm">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-4 text-orange-500"></i>
                                <span>${formatDate(event.date)}</span>
                            </div>
                            
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-clock w-4 text-orange-500"></i>
                                <span>
                                  ${toLocal24Hour(event.startTime)} - 
                                  ${event.endTime ? toLocal24Hour(event.endTime) : 'Selesai'}
                                </span>
                            </div>

                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-door-open w-4 text-orange-500"></i>
                                <div>
                                    <span class="room-badge" style="background-color: ${event.room.color}22; color: ${event.room.color}; border: 1px solid ${event.room.color};">
                                        ${escapeHtml(event.room.name)}
                                    </span>
                                    ${event.room.capacity ? `<span class="text-xs text-gray-500 ml-2">(Kapasitas: ${event.room.capacity})</span>` : ''}
                                </div>
                            </div>

                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-users w-4 text-orange-500"></i>
                                <span>${event.participants || 0} peserta</span>
                            </div>

                            ${event.organizer && event.organizer !== '-' ? `
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-user w-4 text-orange-500"></i>
                                    <span>${escapeHtml(event.organizer)}</span>
                                </div>
                            ` : ''}

                            ${event.contact && event.contact !== '-' ? `
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-phone w-4 text-blue-500"></i>
                                    <a href="tel:${event.contact}" class="hover:text-[#0052CC]">${event.contact}</a>
                                </div>
                            ` : ''}
                        </div>

                        ${event.notes ? `
                            <div class="mt-4 p-3 bg-blue-50 rounded-lg border-l-2 border-blue-300">
                                <p class="text-sm text-gray-700"><strong>Catatan:</strong> ${escapeHtml(event.notes)}</p>
                            </div>
                        ` : ''}

                        ${event.meetingLink ? `
                            <div class="mt-3">
                                <a href="${event.meetingLink}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0052CC] text-white rounded-lg hover:bg-[#003A99] transition font-semibold">
                                    <i class="fas fa-video"></i> Buka Link Meeting
                                </a>
                            </div>
                        ` : ''}`
                    </div>
                </div>
            </div>
        `).join('');

        const filtered_sorted = applyDateFilter(allData.data.events || []).sort((a, b) => new Date(a.startTime) - new Date(b.startTime));
        createPagination(filtered_sorted.length, currentPage.events, 'changeEventsPage', 'eventsPagination');
    }

    // ===== HELPER: Format Date =====
    function formatDate(dateString) {
    if (!dateString || typeof dateString !== 'string') return 'Tanggal tidak valid';
    
    try {
        const trimmed = dateString.trim();
        
        // Jika format YYYY-MM-DD saja (date only)
        if (/^\d{4}-\d{2}-\d{2}$/.test(trimmed)) {
            return dayjs.tz(trimmed, 'Asia/Jakarta').format('dddd, D MMMM YYYY');
        }
        
        // Jika format ISO dengan T (full timestamp)
        if (trimmed.includes('T')) {
            return dayjs(trimmed).utc().tz('Asia/Jakarta').format('dddd, D MMMM YYYY');
        }
        
        // Fallback: coba parse langsung
        const parsed = dayjs(trimmed);
        if (parsed.isValid()) {
            return parsed.tz('Asia/Jakarta').format('dddd, D MMMM YYYY');
        }
        
        return 'Tanggal tidak valid';
    } catch (error) {
        console.warn('formatDate error:', dateString, error.message);
        return 'Tanggal tidak valid';
    }
}

    // ===== HELPER: Escape HTML =====
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // ===== LOAD AGENDA SAAT PAGE LOAD =====
    document.addEventListener('DOMContentLoaded', fetchAgenda);

    // ===== AUTO REFRESH SETIAP 5 MENIT =====
    setInterval(fetchAgenda, 5 * 60 * 1000);
</script>

@endsection