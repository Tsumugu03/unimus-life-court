@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
  <main class="main admin-main">
    <section class="admin-panel">
      <div class="admin-panel-hero">
        <div>
          <h1>Admin Dashboard</h1>
          <p>Kelola katalog item kuliner, kost, dan BRT dengan cepat dan nyaman dari satu panel.</p>
          <a href="{{ route('admin.item.create') }}" class="btn btn-primary btn-sm mt-2">+ Tambah Item</a>
        </div>
        <div>
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin logout?')">🚪 Logout</button>
          </form>
        </div>
      </div>

      @if(session('success'))
        <div class="alert alert-success" style="margin-top:18px;">{{ session('success') }}</div>
      @endif

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
                  <a href="{{ route('admin.item.edit', $item) }}" class="btn-primary btn-sm">Edit</a>
                  <form method="POST" action="{{ route('admin.item.destroy', $item) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary btn-sm">Hapus</button>
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
