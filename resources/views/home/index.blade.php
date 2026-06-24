@extends('layouts.app')
@section('title', 'Unimus Life & Culinary Hub')

@section('content')

{{-- HEADER --}}
<header class="app-header sticky-top">
  <nav class="navbar navbar-expand-lg navbar-dark px-0">
    <div class="container-fluid px-3 px-md-4">
      <a href="{{ route('home') }}" class="navbar-brand brand d-flex align-items-center gap-2 text-white mb-0">
        <div class="brand-icon">🎓</div>
        <div>
          <div style="font-size: 10px; opacity: 0.8; font-weight: 600;">UNIMUS</div>
          <div style="font-size: 16px; font-weight: 800;">Life & Culinary</div>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="ms-auto">
          <a href="{{ route('admin.login') }}" class="btn btn-link text-white text-decoration-none" style="font-size: 18px;">🛡️ Admin</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="search-section py-2">
    <div class="container-fluid px-3 px-md-4">
      <div class="row align-items-center">
        <div class="col-12">
          <h1 class="text-white fw-bold mb-2" style="font-size: 22px;">Hidup Hemat ala Mahasiswa Unimus</h1>
          <p class="text-white-50 mb-2" style="font-size: 13px;">Temukan kuliner murah, kost nyaman, dan rute BRT dalam satu aplikasi</p>
          
          <form method="GET" action="{{ route('home') }}" class="search-form">
            @if($activeCategory !== 'All')
              <input type="hidden" name="category" value="{{ $activeCategory }}" />
            @endif
            @if($activePrice !== 'all')
              <input type="hidden" name="price" value="{{ $activePrice }}" />
            @endif
            <div class="hero-search-row">
              <div class="hero-search-input">
                <span class="hero-search-icon">🔍</span>
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari makanan, kost, atau halte…" />
              </div>
              <button type="submit" class="hero-search-submit">Cari</button>
            </div>
          </form>
          <p class="hero-intro-text mt-3">Temukan rekomendasi makan murah, kost nyaman, dan rute BRT praktis untuk kebutuhan sehari-hari mahasiswa Unimus.</p>
          <div class="hero-feature-cards mt-4">
            <div class="feature-card">
              <div class="feature-card-icon">🍜</div>
              <div>
                <div class="feature-card-title">Kuliner hemat</div>
                <div class="feature-card-text">Menu favorit mahasiswa di sekitar kampus dengan harga ramah kantong.</div>
              </div>
            </div>
            <div class="feature-card">
              <div class="feature-card-icon">🏠</div>
              <div>
                <div class="feature-card-title">Kost nyaman</div>
                <div class="feature-card-text">Pilihan kost dekat kampus yang mudah diakses dan aman.</div>
              </div>
            </div>
            <div class="feature-card">
              <div class="feature-card-icon">🚌</div>
              <div>
                <div class="feature-card-title">Rute BRT</div>
                <div class="feature-card-text">Panduan halte dan jalur tercepat untuk perjalanan sehari-hari.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<main class="main py-4">
  <div class="container-fluid px-3 px-md-4">
    {{-- FILTERS (kategori + harga) --}}
    <div class="filters-grid mb-4">
      {{-- CATEGORY FILTER --}}
      <div class="filter-section">
      <p class="filter-title mb-3">Kategori</p>
      <div class="filter-chips">
        @php
          $categories = [
            'All'      => ['emoji' => '☰',  'label' => 'Semua'],
            'Culinary' => ['emoji' => '🍜', 'label' => 'Kuliner'],
            'Kost'     => ['emoji' => '🏠', 'label' => 'Kost'],
            'BRT'      => ['emoji' => '🚌', 'label' => 'BRT'],
          ];
        @endphp
        @foreach($categories as $key => $cat)
          <a href="{{ route('home', array_merge(request()->except('category'), ['category' => $key])) }}" 
             class="filter-btn {{ $activeCategory === $key ? 'active' : '' }}">
            {{ $cat['emoji'] }} {{ $cat['label'] }}
          </a>
        @endforeach
      </div>
      </div>

        {{-- PRICE FILTER --}}
        <div class="filter-section">
        <div class="filter-header">
          <p class="filter-title mb-0">Rentang Harga</p>
          <button type="button" class="toggle-btn" data-target="#price-filter-body" aria-expanded="false">Tampilkan</button>
        </div>
        <div id="price-filter-body" class="filter-chips collapsed">
        @php
          $priceOptions = [
            'all'  => '💵 Semua Harga',
            'low'  => '🟢 < 15rb',
            'mid'  => '🟡 15-50rb',
            'high' => '🔴 > 50rb',
          ];
        @endphp
        @foreach($priceOptions as $key => $label)
          <a href="{{ route('home', array_merge(request()->except('price'), ['price' => $key])) }}" 
             class="filter-btn {{ $activePrice === $key ? 'active' : '' }}">
            {{ $label }}
          </a>
        @endforeach
      </div>
      </div>
      </div>

    {{-- RESULTS HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0" style="font-size: 22px; font-weight: 800;">Hasil Pencarian</h2>
      <span class="badge bg-primary" style="font-size: 14px; padding: 8px 16px;">{{ $items->count() }} tempat</span>
    </div>

    {{-- ITEMS GRID --}}
    @if($items->isEmpty())
      <div class="empty-state">
        <div class="empty-state-icon">🔍</div>
        <p style="font-size: 16px;">Tidak ada hasil yang ditemukan</p>
        <p style="font-size: 14px; margin-top: 8px;">Coba ubah filter atau kata kunci pencarian</p>
      </div>
    @else
      <div class="row g-3">
        @foreach($items as $item)
          <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('item.show', $item) }}" class="text-decoration-none">
              <div class="card item-card h-100" style="box-shadow: var(--shadow-card); border: 1.5px solid var(--border);">
                <div class="position-relative overflow-hidden" style="aspect-ratio: 1/1;">
                  <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-100 h-100" style="object-fit: cover; loading: lazy;">
                  <span class="badge position-absolute top-2 start-2" style="background: rgba(30,64,175,.92); font-size: 11px; font-weight: 700; padding: 6px 12px;">
                    @if($item->category === 'Culinary') 🍜
                    @elseif($item->category === 'Kost') 🏠
                    @else 🚌
                    @endif
                    {{ $item->category }}
                  </span>
                </div>
                <div class="card-body">
                  <h5 class="card-title mb-2" style="font-size: 14px; font-weight: 700; line-height: 1.3; color: var(--text);">{{ $item->name }}</h5>
                  <p class="card-text mb-2" style="font-size: 12px; color: var(--text-light); display: flex; align-items: center; gap: 4px;">
                    📍 {{ $item->short_desc }}
                  </p>
                  <p style="font-size: 16px; font-weight: 800; color: var(--primary); margin: 0;">
                    {{ $item->price_formatted }}
                    <span style="font-size: 11px; font-weight: 500; color: var(--muted);">{{ $item->price_label }}</span>
                  </p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</main>

{{-- FLOATING BOTTOM NAV (Mobile) --}}
<nav class="bottom-nav d-lg-none fixed-bottom">
  <button class="nav-btn flex-grow-1" onclick="location.href='{{ route('home') }}'">🏠 Beranda</button>
  <button class="nav-btn flex-grow-1" onclick="location.href='{{ route('admin.login') }}'">🛡️ Admin</button>
</nav>

<style>
.bottom-nav { 
  background: white; 
  border-top: 1px solid var(--border); 
  display: flex; 
  z-index: 20;
  box-shadow: 0 -2px 8px rgba(0,0,0,0.08);
}
.nav-btn { 
  background: none; 
  border: none; 
  color: var(--muted); 
  font-size: 12px; 
  font-weight: 600;
  padding: 12px 8px;
  transition: all 0.2s;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
}
.nav-btn:hover { color: var(--primary); }
</style>

@endsection
