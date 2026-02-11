{{-- Toast Notification Styles & Scripts --}}

<style>
    .toast-notification {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        z-index: 999;
        animation: slideInUp 0.3s ease-out, slideOutDown 0.3s ease-in 2.7s forwards;
        max-width: 400px;
    }

    .toast-success {
        background-color: #ECFDF1;
        border: 1px solid #86EFAC;
        color: #166534;
    }

    .toast-error {
        background-color: #FEE2E2;
        border: 1px solid #FECACA;
        color: #991B1B;
    }

    .toast-info {
        background-color: #F0F9FF;
        border: 1px solid #BAE6FD;
        color: #0C4A6E;
    }

    .toast-notification i {
        margin-right: 0.75rem;
        font-weight: bold;
    }

    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideOutDown {
        from {
            transform: translateY(0);
            opacity: 1;
        }
        to {
            transform: translateY(100%);
            opacity: 0;
        }
    }

    @media (max-width: 640px) {
        .toast-notification {
            bottom: 1rem;
            right: 1rem;
            left: 1rem;
            max-width: none;
        }
    }
</style>

<script>
    function showToast(message, type = 'success', duration = 3000) {
        const container = document.body;
        const toast = document.createElement('div');
        
        toast.className = `toast-notification toast-${type}`;
        
        let icon = '';
        switch(type) {
            case 'success':
                icon = '<i class="fas fa-check-circle"></i>';
                break;
            case 'error':
                icon = '<i class="fas fa-exclamation-circle"></i>';
                break;
            case 'info':
                icon = '<i class="fas fa-info-circle"></i>';
                break;
            default:
                icon = '<i class="fas fa-bell"></i>';
        }
        
        toast.innerHTML = `${icon}<span>${message}</span>`;
        container.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, duration);
    }

    function showSuccessToast(message, duration = 3000) {
        showToast(message, 'success', duration);
    }

    function showErrorToast(message, duration = 3000) {
        showToast(message, 'error', duration);
    }

    function showInfoToast(message, duration = 3000) {
        showToast(message, 'info', duration);
    }
</script>
