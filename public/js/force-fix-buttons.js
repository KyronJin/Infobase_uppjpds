// 🔧 CROP BUTTON FORCE FIXER - Inject this into any page to fix unclickable buttons

(function() {
    console.log('🚀 CROP BUTTON FORCE FIXER LOADED');
    
    function forceFixCropButtons() {
        // Find all crop buttons
        const buttons = document.querySelectorAll('.crop-button-standard, [id*="crop"], [onclick*="crop"], button[id*="btn"]');
        
        buttons.forEach((btn, index) => {
            console.log(`🔧 Fixing button ${index + 1}:`, btn);
            
            // Force all clickability properties
            btn.style.pointerEvents = 'auto';
            btn.style.zIndex = '999999';
            btn.style.position = 'relative';
            btn.style.cursor = 'pointer';
            btn.style.opacity = '1';
            btn.style.visibility = 'visible';
            btn.style.display = btn.style.display || 'inline-flex';
            
            // Remove any blocking elements
            btn.style.transform = 'none';
            btn.style.margin = '10px auto';
            
            // Add glow effect to make it obvious
            btn.style.boxShadow = '0 0 20px #3b82f6, 0 0 40px #3b82f6';
            btn.style.animation = 'none';
            
            // Force onclick if not present
            if (!btn.onclick) {
                btn.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('🎯 FORCE CLICK WORKED!', this);
                    alert(`✅ Button clicked! ID: ${this.id || 'no-id'}`);
                    
                    // Try to trigger original function
                    if (window.imageCropper && typeof window.imageCropper.openCropper === 'function') {
                        const fileInput = document.querySelector('input[type="file"]');
                        if (fileInput) {
                            window.imageCropper.openCropper(fileInput);
                        }
                    }
                };
            }
            
            // Add hover effect for testing
            btn.addEventListener('mouseenter', function() {
                console.log('🖱️ Mouse entered button:', this.id);
                this.style.transform = 'scale(1.1)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
        
        console.log(`✅ Fixed ${buttons.length} buttons`);
    }
    
    // Fix buttons now
    forceFixCropButtons();
    
    // Fix buttons when DOM changes
    const observer = new MutationObserver(function() {
        forceFixCropButtons();
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    // Fix buttons every 2 seconds
    setInterval(forceFixCropButtons, 2000);
    
    console.log('🛡️ FORCE FIXER ACTIVE - All crop buttons will be made clickable!');
})();

// Add this CSS to force button visibility
const forceCSS = `
.crop-button-standard,
button[id*="crop"],
button[onclick*="crop"] {
    pointer-events: auto !important;
    z-index: 999999 !important;
    position: relative !important;
    cursor: pointer !important;
    opacity: 1 !important;
    visibility: visible !important;
    display: inline-flex !important;
    background: linear-gradient(135deg, #ef4444, #dc2626) !important;
    color: white !important;
    border: 2px solid #dc2626 !important;
    padding: 15px 25px !important;
    border-radius: 8px !important;
    font-weight: bold !important;
    text-transform: uppercase !important;
    box-shadow: 0 0 30px #ef4444 !important;
    animation: forcePulse 1s infinite !important;
}

@keyframes forcePulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}
`;

const style = document.createElement('style');
style.textContent = forceCSS;
document.head.appendChild(style);

console.log('💉 FORCE CSS INJECTED');