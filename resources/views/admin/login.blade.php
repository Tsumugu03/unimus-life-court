@extends('layouts.app')
@section('title', 'Admin Login')

@section('content')
  <main class="main">
    <div style="max-width:420px;margin:80px auto;background:#fff;padding:24px;border-radius:18px;box-shadow:0 10px 30px rgba(0,0,0,.08);">
      <h1 style="font-size:24px;margin-bottom:18px;">Admin Login</h1>
      @if($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <label style="display:block;margin-bottom:10px;">
          Username
          <input type="text" name="username" value="{{ old('username') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;margin-top:6px;" />
        </label>
        <label style="display:block;margin-bottom:10px;">
          Password
          <input type="password" name="password" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;margin-top:6px;" />
        </label>
        <button type="submit" class="btn-primary" style="width:100%;margin-top:14px;">Masuk</button>
      </form>
    </div>
  </main>
@endsection
