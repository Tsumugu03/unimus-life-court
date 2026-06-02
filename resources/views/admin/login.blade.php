@extends('layouts.app')
@section('title', 'Admin Login')

@section('content')
  <main class="main admin-main">
    <section class="form-card" style="max-width:460px; margin: 80px auto;">
      <div style="margin-bottom: 20px;">
        <h1 style="font-size:28px; margin-bottom: 10px;">Admin Login</h1>
        <p style="color: var(--text-light); line-height: 1.6;">Masuk untuk mengelola katalog item kuliner, kost, dan BRT dengan panel admin yang lebih rapi.</p>
      </div>

      @if($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="form-grid">
          <div class="field-group span-2">
            <label class="field-label">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" class="field-input" />
          </div>

          <div class="field-group span-2">
            <label class="field-label">Password</label>
            <input type="password" name="password" class="field-input" />
          </div>
        </div>

        <button type="submit" class="btn-primary">Masuk</button>
      </form>
    </section>
  </main>
@endsection
