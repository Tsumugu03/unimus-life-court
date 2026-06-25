@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
  <main class="main admin-main">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-error alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <section class="admin-panel">
      <div class="admin-panel-top">
        <div class="admin-panel-title">
          <h1>Admin Dashboard</h1>
          <p>Kelola katalog item kuliner, kost, dan BRT dengan cepat dan nyaman dari satu panel.</p>
        </div>
        <div class="admin-panel-logout">
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-logout" onclick="return confirm('Yakin ingin logout?')">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
        </div>
      </div>
      <div class="admin-panel-actions">
        <a href="{{ route('admin.item.create') }}" class="btn btn-primary btn-sm">+ Tambah Item</a>
      </div>

      @php
        $counts = $items->groupBy('category')->map->count();
      @endphp

      <div class="admin-summary">
        <div class="admin-summary-card">
          <strong>{{ $items->count() }}</strong>
          <span>Total Item</span>
        </div>
        <div class="admin-summary-card">
          <strong>{{ $counts->get('Culinary', 0) }}</strong>
          <span>Culinary</span>
        </div>
        <div class="admin-summary-card">
          <strong>{{ $counts->get('Kost', 0) }}</strong>
          <span>Kost</span>
        </div>
        <div class="admin-summary-card">
          <strong>{{ $counts->get('BRT', 0) }}</strong>
          <span>BRT</span>
        </div>
      </div>

      @if($items->isEmpty())
        <div class="empty" style="margin-top:24px;">Belum ada item. Tambahkan melalui tombol di atas.</div>
      @else
        <div class="admin-grid-list">
          @foreach($items as $item)
            <article class="admin-card">
              <div class="admin-card-thumb">
                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" />
                <span class="admin-card-badge">{{ $item->category }}</span>
              </div>
              <div class="admin-card-body">
                <div>
                  <h2 class="admin-card-title">{{ $item->name }}</h2>
                  <p class="admin-card-meta">{{ $item->price_formatted }}</p>
                  <p class="admin-card-desc">{{ $item->short_desc }}</p>
                </div>
                <div class="admin-card-actions">
                  <a href="{{ route('admin.item.edit', $item) }}" class="btn btn-primary btn-sm rounded-pill">Edit</a>
                  <form method="POST" action="{{ route('admin.item.destroy', $item) }}" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</button>
                  </form>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </section>
  </main>
@endsection
