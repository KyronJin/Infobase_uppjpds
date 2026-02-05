{{-- Image Cropper Component --}}
<link rel="stylesheet" href="{{ asset('css/image-cropper.css') }}">

<div id="image-cropper-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[9999] hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[95vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">✂️ Edit Gambar</h3>
                        <p class="text-sm text-gray-600 mt-1">Crop, rotate, dan edit gambar sebelum upload</p>
                    </div>
                    <button id="close-cropper-btn" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <!-- Quick Instructions -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mt-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 mr-2 mt-0.5"></i>
                        <div class="text-sm text-blue-800">
                            <strong>Cara Penggunaan:</strong> Drag sudut gambar untuk crop • Pilih aspect ratio • Gunakan tombol rotate/flip • Klik "Terapkan" untuk menyimpan
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <!-- Cropper Container -->
                <div class="mb-6">
                    <div id="cropper-container" class="bg-gray-100 rounded-lg overflow-hidden" style="max-height: 500px;">
                        <img id="cropper-image" src="" alt="Image to crop" style="max-width: 100%; display: block;">
                    </div>
                </div>
                
                <!-- Cropper Controls -->
                <div class="space-y-4">
                    <!-- Aspect Ratio -->
                    <div class="grid grid-cols-2 md:grid-cols-6 gap-2">
                        <div class="col-span-2 md:col-span-6 mb-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">📐 Aspect Ratio</label>
                        </div>
                        <button class="aspect-ratio-btn px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm" data-ratio="free">
                            🆓 Free
                        </button>
                        <button class="aspect-ratio-btn px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm" data-ratio="1/1">
                            ⏹️ 1:1
                        </button>
                        <button class="aspect-ratio-btn px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm" data-ratio="4/3">
                            📺 4:3
                        </button>
                        <button class="aspect-ratio-btn px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm" data-ratio="16/9">
                            🎬 16:9
                        </button>
                        <button class="aspect-ratio-btn px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm" data-ratio="3/4">
                            📱 3:4
                        </button>
                        <button class="aspect-ratio-btn px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm" data-ratio="2/3">
                            🖼️ 2:3
                        </button>
                    </div>
                    
                    <!-- Transform Controls -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">🔄 Rotate</label>
                            <div class="flex gap-1">
                                <button id="rotate-left" class="flex-1 px-2 py-2 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 text-sm">
                                    ↺ -90°
                                </button>
                                <button id="rotate-right" class="flex-1 px-2 py-2 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 text-sm">
                                    ↻ +90°
                                </button>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">🔃 Flip</label>
                            <div class="flex gap-1">
                                <button id="flip-horizontal" class="flex-1 px-2 py-2 bg-purple-50 text-purple-600 rounded hover:bg-purple-100 text-sm">
                                    ↔️ H
                                </button>
                                <button id="flip-vertical" class="flex-1 px-2 py-2 bg-purple-50 text-purple-600 rounded hover:bg-purple-100 text-sm">
                                    ↕️ V
                                </button>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">🔍 Zoom</label>
                            <div class="flex gap-1">
                                <button id="zoom-in" class="flex-1 px-2 py-2 bg-green-50 text-green-600 rounded hover:bg-green-100 text-sm">
                                    ➕
                                </button>
                                <button id="zoom-out" class="flex-1 px-2 py-2 bg-green-50 text-green-600 rounded hover:bg-green-100 text-sm">
                                    ➖
                                </button>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">🔄 Reset</label>
                            <button id="reset-crop" class="w-full px-2 py-2 bg-red-50 text-red-600 rounded hover:bg-red-100 text-sm">
                                🔄 Reset
                            </button>
                        </div>
                    </div>
                    
                    <!-- Quality Control -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" id="quality-label">⚡ Quality (0.8)</label>
                            <input type="range" id="quality-slider" min="0.1" max="1" step="0.1" value="0.8" class="w-full">
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>Low</span>
                                <span>High</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">📄 Format</label>
                            <select id="output-format" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="image/jpeg">JPEG (smaller)</option>
                                <option value="image/png">PNG (transparent)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                    <strong>Tips:</strong> Zoom dengan scroll mouse, drag untuk memindahkan gambar
                </div>
                <div class="flex gap-3">
                    <button id="cancel-crop-btn" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
                        ❌ Batal
                    </button>
                    <button id="apply-crop-btn" class="px-8 py-2 bg-gradient-to-r from-teal-600 to-teal-700 text-white rounded-lg hover:from-teal-700 hover:to-teal-800 font-bold transition-all transform hover:scale-105 shadow-lg">
                        ✨ Terapkan Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>