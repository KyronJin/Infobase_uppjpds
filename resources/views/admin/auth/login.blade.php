@extends('layouts.app')

@section('content')
<style>
    /* Login Page Specific Styles */
    .login-container * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .login-container {
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        padding: 2rem 1.5rem;
        margin-top: 0;
    }

    .login-card {
        background: white;
        padding: 3rem;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        max-width: 450px;
        width: 100%;
        position: relative;
        z-index: 10;
    }

    .login-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .login-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #00425A;
        margin-bottom: 0.5rem;
    }

    .login-header p {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        border-left: 4px solid;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .alert-danger {
        background: #fee2e2;
        border-color: #dc2626;
        color: #991b1b;
    }

    .alert-success {
        background: #dcfce7;
        border-color: #16a34a;
        color: #15803d;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: white;
    }

    .form-input:focus {
        outline: none;
        border-color: #00425A;
        box-shadow: 0 0 0 3px rgba(0, 66, 90, 0.1);
    }

    .form-input::placeholder {
        color: #9ca3af;
    }

    .password-container {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        font-size: 1.1rem;
        transition: color 0.2s ease;
    }

    .password-toggle:hover {
        color: #00425A;
    }

    .login-btn {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #f85e38 0%, #d94e2e 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-bottom: 1.5rem;
    }

    .login-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(248, 94, 56, 0.3);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .login-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .form-footer {
        text-align: center;
    }

    .back-link {
        color: #6b7280;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-link:hover {
        color: #00425A;
        transform: translateX(-2px);
    }

    .loading-spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
        margin-right: 0.5rem;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 480px) {
        .login-container {
            padding: 1rem;
        }

        .login-card {
            padding: 2rem;
        }

        .login-header h1 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1>🔐 Admin Login</h1>
            <p>Masuk ke dashboard admin</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">
                    Email
                </label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    class="form-input"
                    placeholder="masukkan email admin"
                    required 
                    value="{{ old('email') }}"
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    Password
                </label>
                <div class="password-container">
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        class="form-input"
                        placeholder="masukkan password"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="login-btn" id="loginButton">
                <span class="loading-spinner"></span>
                <span id="buttonText">
                    Masuk ke Dashboard
                </span>
            </button>
        </form>

        <div class="form-footer">
            <a href="{{ route('infobase.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            passwordIcon.className = 'fas fa-eye';
        }
    }

    // Form submission with loading state
    document.getElementById('loginForm').addEventListener('submit', function() {
        const button = document.getElementById('loginButton');
        const spinner = button.querySelector('.loading-spinner');
        const buttonText = document.getElementById('buttonText');
        
        button.disabled = true;
        spinner.style.display = 'inline-block';
        buttonText.innerHTML = 'Sedang Memproses...';
    });

    // Auto focus on email input
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('email').focus();
    });

    // Add enter key support
    document.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('loginForm').submit();
        }
    });
</script>

@endsection