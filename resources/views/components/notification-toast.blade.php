@if(session('success'))
<div id="notification-toast" class="fixed top-6 right-6 z-50 max-w-md">
    @php
        $notification = session('success');
        $title = is_array($notification) ? $notification['title'] ?? 'Berhasil' : $notification;
        $message = is_array($notification) ? $notification['message'] ?? '' : '';
        $type = is_array($notification) ? $notification['type'] ?? 'success' : 'success';
        
        $bgColor = $type === 'success' ? 'bg-green-50 border-green-200' : ($type === 'error' ? 'bg-red-50 border-red-200' : 'bg-slate-50 border-slate-200');
        $borderColor = $type === 'success' ? 'border-l-4 border-l-green-500' : ($type === 'error' ? 'border-l-4 border-l-red-500' : 'border-l-4 border-l-teal-600');
        $iconColor = $type === 'success' ? 'text-green-600' : ($type === 'error' ? 'text-red-600' : 'text-teal-600');
        $icon = $type === 'success' ? 'fa-check-circle' : ($type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle');
    @endphp
    
    <div class="rounded-lg shadow-lg overflow-hidden {{ $borderColor }}">
        <div class="{{ $bgColor }} px-6 py-5 flex items-start gap-4">
            <!-- Icon -->
            <div class="flex-shrink-0 mt-0.5">
                <i class="fas {{ $icon }} {{ $iconColor }} text-xl"></i>
            </div>
            
            <!-- Content -->
            <div class="flex-grow">
                <h3 class="font-semibold text-gray-900 mb-1">{{ $title }}</h3>
                @if($message)
                    <p class="text-sm text-gray-700">{{ $message }}</p>
                @endif
            </div>
            
            <!-- Close Button -->
            <button onclick="document.getElementById('notification-toast').remove()" class="flex-shrink-0 ml-2 text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<script>
    // Auto-close notification after 5 seconds
    setTimeout(() => {
        const toast = document.getElementById('notification-toast');
        if (toast) {
            toast.style.transition = 'opacity 0.3s ease-out';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }
    }, 5000);
</script>
@endif

@if(session('error'))
<div id="notification-toast" class="fixed top-6 right-6 z-50 max-w-md">
    @php
        $notification = session('error');
        $title = is_array($notification) ? $notification['title'] ?? 'Error' : 'Terjadi Kesalahan';
        $message = is_array($notification) ? $notification['message'] ?? '' : $notification;
    @endphp
    
    <div class="rounded-lg shadow-lg overflow-hidden border-l-4 border-l-red-500">
        <div class="bg-red-50 border border-red-200 px-6 py-5 flex items-start gap-4">
            <!-- Icon -->
            <div class="flex-shrink-0 mt-0.5">
                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
            </div>
            
            <!-- Content -->
            <div class="flex-grow">
                <h3 class="font-semibold text-gray-900 mb-1">{{ $title }}</h3>
                @if($message)
                    <p class="text-sm text-gray-700">{{ $message }}</p>
                @endif
            </div>
            
            <!-- Close Button -->
            <button onclick="document.getElementById('notification-toast').remove()" class="flex-shrink-0 ml-2 text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<script>
    // Auto-close notification after 5 seconds
    setTimeout(() => {
        const toast = document.getElementById('notification-toast');
        if (toast) {
            toast.style.transition = 'opacity 0.3s ease-out';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }
    }, 5000);
</script>
@endif
