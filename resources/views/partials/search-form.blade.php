{{-- Search Form Component --}}
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem 1rem 1.5rem;">
    <form method="GET" action="{{ $action }}" class="flex gap-3 mb-6">
        <div style="flex: 1;">
            <input 
                type="text" 
                name="search" 
                placeholder="{{ $placeholder ?? 'Cari...' }}" 
                value="{{ $search ?? '' }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300"
            >
        </div>
        <button 
            type="submit" 
            class="px-6 py-2 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300 flex items-center gap-2"
        >
            <i class="fas fa-search"></i>
            Cari
        </button>
        @if(!empty($search))
            <a 
                href="{{ $action }}" 
                class="px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition duration-300"
            >
                <i class="fas fa-times"></i>
            </a>
        @endif
    </form>

    @if(!empty($search))
        <div style="margin-bottom: 1.5rem; padding: 1rem; background: #e3f2fd; border-left: 4px solid #00425A; border-radius: 0.5rem;">
            <p style="color: #00425A; font-size: 0.95rem; margin: 0;">
                <i class="fas fa-info-circle mr-2"></i>
                Hasil pencarian untuk: <strong>{{ $search }}</strong>
                @if(isset($resultCount))
                    ({{ $resultCount }} hasil ditemukan)
                @endif
            </p>
        </div>
    @endif
</div>