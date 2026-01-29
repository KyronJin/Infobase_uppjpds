@extends('layouts.app')

@section('content')
<style>
  .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
  .login-card { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); max-width: 400px; width: 100%; }
  .login-header { text-align: center; margin-bottom: 2rem; }
  .login-header h1 { font-size: 1.875rem; font-weight: bold; color: #333; margin: 0; }
  .login-header p { color: #666; margin-top: 0.5rem; }
  .form-group { margin-bottom: 1.5rem; }
  .form-group label { display: block; font-weight: 500; color: #333; margin-bottom: 0.5rem; }
  .form-group input { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box; }
  .form-group input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
  .error-box { background: #fee; border-left: 4px solid #c33; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; color: #c33; font-size: 0.9rem; }
  .btn { padding: 0.75rem 1.5rem; font-size: 1rem; font-weight: 600; border: none; border-radius: 6px; cursor: pointer; transition: all 0.3s ease; }
  .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; width: 100%; }
  .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4); }
  .form-footer { text-align: center; margin-top: 1.5rem; color: #666; font-size: 0.875rem; }
</style>
<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <h1>🔐 Admin Login</h1>
      <p>Silakan masuk untuk melanjutkan</p>
    </div>

    @if($errors->any())
      <div class="error-box">
        ❌ {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input 
          type="email" 
          id="email"
          name="email" 
          placeholder="admin@example.com"
          required 
          value="{{ old('email') }}"
        >
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input 
          type="password" 
          id="password"
          name="password" 
          placeholder="••••••••"
          required
        >
      </div>

      <button type="submit" class="btn btn-primary">Masuk</button>
    </form>

    <div class="form-footer">
      <p><a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;">← Kembali ke Beranda</a></p>
    </div>
  </div>
</div>
@endsection