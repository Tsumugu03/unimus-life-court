@extends('layouts.app')
@section('title', 'Admin Login')

@section('content')
<main class="main admin-main py-5">
  <div class="container">
    <div class="row justify-content-start mb-3">
      <div class="col-auto">
        <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">
          ← Kembali ke Home
        </a>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px);">
          <div class="card-body p-4">
            <div class="text-center mb-4">
              <div class="mb-3">
                <span style="font-size: 48px;">🔐</span>
              </div>
              <h3 class="text-dark fw-bold mb-2">Admin Login</h3>
              <p class="text-white-50 small mb-0">Masuk untuk mengelola katalog item kuliner, kost, dan BRT.</p>
            </div>

            @if($errors->any())
              <div class="alert alert-danger py-2 small rounded-3">
                {{ $errors->first() }}
              </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
              @csrf
              <div class="mb-3">
                <label class="form-label text-white-50 small">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" 
                       class="form-control form-control-lg rounded-3" placeholder="Masukkan username" required />
              </div>

              <div class="mb-4">
                <label class="form-label text-white-50 small">Password</label>
                <input type="password" name="password" class="form-control form-control-lg rounded-3" 
                       placeholder="Masukkan password" required />
              </div>

              <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold mb-2">
                Masuk
              </button>
              <a href="{{ route('home') }}" class="btn btn-danger w-100 py-2 rounded-3 fw-semibold">
                Kembali ke Menu
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
