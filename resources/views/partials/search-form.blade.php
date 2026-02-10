{{-- Search Form Component --}}
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem 1rem 1.5rem;">
    <form method="GET" action="{{ $action }}" class="flex gap-3 mb-6 flex-wrap">
        <div style="flex: 1; min-width: 200px;">
            <input 
                type="text" 
                name="search" 
                placeholder="{{ $placeholder ?? 'Cari...' }}" 
                value="{{ $search ?? '' }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300"
            >
        </div>
        
        {{-- Status Filter untuk pengumuman --}}
        @if(isset($showStatusFilter) && $showStatusFilter)
            <select 
                name="status"
                class="px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300 bg-white"
            >
                <option value="active" {{ isset($status) && ($status === 'active' || $status === '') ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ isset($status) && $status === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        @endif
        
        <button 
            type="submit" 
            class="px-6 py-2 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300 flex items-center gap-2"
        >
            <i class="fas fa-search"></i>
            Cari
        </button>
        @if(!empty($search) || (isset($status) && !empty($status)))
            <a 
                href="{{ $action }}" 
                class="px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition duration-300"
            >
                <i class="fas fa-times"></i>
            </a>
        @endif
    </form>

    @if(!empty($search) || (isset($status) && !empty($status)))
        <div style="margin-bottom: 1.5rem; padding: 1rem; background: #e3f2fd; border-left: 4px solid #00425A; border-radius: 0.5rem;">
            <p style="color: #00425A; font-size: 0.95rem; margin: 0;">
                <i class="fas fa-info-circle mr-2"></i>
                @if(!empty($search) && isset($status) && !empty($status))
                    Hasil pencarian untuk: <strong>{{ $search }}</strong> dengan status <strong>{{ $status === 'active' ? 'Aktif' : 'Tidak Aktif' }}</strong>
                @elseif(!empty($search))
                    Hasil pencarian untuk: <strong>{{ $search }}</strong>
                @else
                    Menampilkan pengumuman dengan status <strong>{{ $status === 'active' ? 'Aktif' : 'Tidak Aktif' }}</strong>
                @endif
                @if(isset($resultCount))
                    ({{ $resultCount }} hasil ditemukan)
                @endif
            </p>
        </div>
    @endif
</div>