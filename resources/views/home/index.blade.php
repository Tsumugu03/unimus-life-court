@extends('layouts.app')
@section('title', 'Unimus Life & Culinary Hub')

@section('content')

{{-- HEADER --}}
<header class="app-header sticky-top">
  <nav class="navbar navbar-expand-lg navbar-dark px-0">
    <div class="container px-3 px-md-4">
      <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2 text-white mb-0">
        <div class="brand-icon">🎓</div>
        <div>
          <div style="font-size: 10px; opacity: 0.8; font-weight: 600; letter-spacing: 1px;">UNIMUS</div>
          <div style="font-size: 15px; font-weight: 800;">Life & Culinary</div>
        </div>
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="ms-auto">
          <a href="{{ route('admin.login') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
            <span class="me-1">🛡️</span> Admin
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>

{{-- HERO SECTION --}}
<section class="hero-section py-4 py-md-5">
  <div class="container px-3 px-md-4">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <h1 class="hero-title mb-3">Hidup Hemat<br><span class="text-warning">ala Mahasiswa Unimus</span></h1>
        <p class="hero-subtitle mb-4">Temukan kuliner murah, kost nyaman, dan rute BRT dalam satu platform.</p>
        
        <form method="GET" action="{{ route('home') }}" class="search-form">
          @if($activeCategory !== 'All')
            <input type="hidden" name="category" value="{{ $activeCategory }}" />
          @endif
          @if($activePrice !== 'all')
            <input type="hidden" name="price" value="{{ $activePrice }}" />
          @endif
          <div class="search-box">
            <span class="search-icon">🔍</span>
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari makanan, kost, atau halte…" class="search-input" />
            <button type="submit" class="search-btn">Cari</button>
          </div>
        </form>
      </div>
      <div class="col-lg-5 d-none d-lg-block text-end">
        <div class="hero-stats">
          <div class="stat-item">
            <span class="stat-number">{{ $items->count() }}</span>
            <span class="stat-label">Tempat</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">3</span>
            <span class="stat-label">Kategori</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<main class="main pb-5">
  <div class="container px-3 px-md-4">
    
    {{-- CATEGORY FILTER --}}
<div class="filter-section mb-4">
  <div class="filter-header">
    <h3 class="filter-title mb-0">Filter</h3>
    <button type="button" class="toggle-btn" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="true" aria-controls="filterCollapse">
      ∧
    </button>
  </div>
  <div class="collapse show" id="filterCollapse">
    <div class="d-flex align-items-center gap-3 flex-wrap mt-3">
      @php
        $categories = [
          'All'      => ['icon' => '☰',  'label' => 'Semua'],
          'Culinary' => ['icon' => '🍜', 'label' => 'Kuliner'],
          'Kost'     => ['icon' => '🏠', 'label' => 'Kost'],
          'BRT'      => ['icon' => '🚌', 'label' => 'BRT'],
        ];
      @endphp
      @foreach($categories as $key => $cat)
        <a href="{{ route('home', array_merge(request()->except('category'), ['category' => $key])) }}" 
           class="filter-btn {{ $activeCategory === $key ? 'active' : '' }}">
          <span class="me-1">{{ $cat['icon'] }}</span>
          {{ $cat['label'] }}
        </a>
      @endforeach
      
      <div class="ms-auto d-none d-md-block">
        <div class="price-filter dropdown">
          <button class="btn btn-outline-secondary btn-sm rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">
            💵 Harga
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            @php
              $priceOptions = [
                'all'  => 'Semua Harga',
                'low'  => '< 15rb',
                'mid'  => '15-50rb',
                'high' => '> 50rb',
              ];
            @endphp
            @foreach($priceOptions as $key => $label)
              <li>
                <a class="dropdown-item {{ $activePrice === $key ? 'active' : '' }}" 
                   href="{{ route('home', array_merge(request()->except('price'), ['price' => $key])) }}">
                  {{ $label }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    {{-- Filter Reset and Sort --}}
    <div class="d-flex align-items-center gap-2 mt-3">
      {{-- Reset Filter Button --}}
      @if($q || $activeCategory !== 'All' || $activePrice !== 'all')
        <a href="{{ route('home', ['q' => null, 'category' => 'All', 'price' => 'all']) }}" class="btn btn-sm btn-outline-secondary rounded-pill d-flex align-items-center gap-1">
          ✕ Reset Filter
        </a>
      @endif

      {{-- Sort Dropdown --}}
      <div class="dropdown ms-auto">
        <button class="btn btn-sm btn-outline-secondary rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          ⇅ Urutkan: {{ ['latest' => 'Terbaru', 'price_asc' => 'Harga Termurah', 'price_desc' => 'Harga Termahal', 'name_asc' => 'Nama A-Z'][request()->sort ?? 'latest'] }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item {{ (request()->sort ?? 'latest') === 'latest' ? 'active' : '' }}" href="{{ route('home', array_merge(request()->except('sort'), ['sort' => 'latest'])) }}">Terbaru</a></li>
          <li><a class="dropdown-item {{ request()->sort === 'price_asc' ? 'active' : '' }}" href="{{ route('home', array_merge(request()->except('sort'), ['sort' => 'price_asc'])) }}">Harga Termurah</a></li>
          <li><a class="dropdown-item {{ request()->sort === 'price_desc' ? 'active' : '' }}" href="{{ route('home', array_merge(request()->except('sort'), ['sort' => 'price_desc'])) }}">Harga Termahal</a></li>
          <li><a class="dropdown-item {{ request()->sort === 'name_asc' ? 'active' : '' }}" href="{{ route('home', array_merge(request()->except('sort'), ['sort' => 'name_asc'])) }}">Nama A-Z</a></li>
        </ul>
      </div>
    </div>

  </div>
</div>

    {{-- RESULTS HEADER --}}
    @if($q || $activeCategory !== 'All' || $activePrice !== 'all')
    <div class="results-header mb-4">
      <h2 class="results-title">Hasil Pencarian</h2>
      <span class="results-count">{{ $items->count() }} tempat ditemukan</span>
    </div>
    @endif

    {{-- ITEMS GRID --}}
    @if($items->isEmpty())
      <div class="empty-state">
        <div class="empty-icon">🔍</div>
        <h4>Tidak ada hasil</h4>
        <p>Coba ubah filter atau kata kunci pencarian</p>
      </div>
    @else
      <div class="row g-4">
        @foreach($items as $item)
          <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('item.show', $item) }}" class="item-link">
              <div class="item-card">
                <div class="item-image">
                  <img src="{{ $item->image_url }}" alt="{{ $item->name }}" loading="lazy" />
                  <span class="item-badge">
                    @if($item->category === 'Culinary') 🍜
                    @elseif($item->category === 'Kost') 🏠
                    @else 🚌
                    @endif
                  </span>
                </div>
                <div class="item-body">
                  <h5 class="item-title">{{ $item->name }}</h5>
                  <p class="item-location">{{ $item->short_desc }}</p>
                  <div class="item-price">{{ $item->price_formatted }}</div>
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
  <a href="{{ route('home') }}" class="nav-btn flex-grow-1 text-center">🏠<span>Beranda</span></a>
  <a href="{{ route('admin.login') }}" class="nav-btn flex-grow-1 text-center">🛡️<span>Admin</span></a>
</nav>

<style>
:root {
  --primary: #4f46e5;
  --primary-dark: #4338ca;
  --bg-light: #f8fafc;
  --text: #1e293b;
  --text-light: #64748b;
  --border: #e2e8f0;
  --shadow: 0 1px 3px rgba(0,0,0,0.1);
  --shadow-lg: 0 4px 12px rgba(0,0,0,0.1);
}

body {
  background: var(--bg-light);
  color: var(--text);
}

/* Header */
.app-header {
  background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
  box-shadow: var(--shadow);
}

/* Hero */
.hero-section {
  background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
  color: white;
  border-radius: 0 0 24px 24px;
  margin-bottom: -12px;
  position: relative;
}

.hero-title {
  font-size: 28px;
  font-weight: 800;
  line-height: 1.2;
}

.hero-subtitle {
  font-size: 15px;
  color: rgba(255,255,255,0.8);
  margin-bottom: 0;
}

/* Search Box */
.search-box {
  display: flex;
  align-items: center;
  background: white;
  border-radius: 50px;
  padding: 6px 6px 6px 16px;
  box-shadow: var(--shadow-lg);
  max-width: 500px;
}

.search-icon {
  font-size: 18px;
  margin-right: 8px;
}

.search-input {
  flex: 1;
  border: none;
  outline: none;
  font-size: 15px;
  padding: 8px 0;
  background: transparent;
}

.search-input::placeholder {
  color: var(--text-light);
}

.search-btn {
  background: var(--primary);
  color: white;
  border: none;
  padding: 10px 24px;
  border-radius: 50px;
  font-weight: 600;
  font-size: 14px;
  transition: all 0.2s;
}

.search-btn:hover {
  background: var(--primary-dark);
}

/* Hero Stats */
.hero-stats {
  display: flex;
  gap: 32px;
  justify-content: flex-end;
}

.stat-item {
  text-align: center;
}

.stat-number {
  display: block;
  font-size: 32px;
  font-weight: 800;
  color: #fbbf24;
}

.stat-label {
  font-size: 13px;
  color: rgba(255,255,255,0.7);
}

/* Category */
.category-btn {
  display: inline-flex;
  align-items: center;
  padding: 8px 16px;
  background: white;
  border: 1.5px solid var(--border);
  border-radius: 50px;
  color: var(--text);
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  transition: all 0.2s;
}

.category-btn:hover {
  border-color: var(--primary);
  color: var(--primary);
}

.category-btn.active {
  background: var(--primary);
  border-color: var(--primary);
  color: white;
}

/* Results Header */
.results-header {
  display: flex;
  align-items: center;
  gap: 12px;
}

.results-title {
  font-size: 18px;
  font-weight: 700;
  margin: 0;
}

.results-count {
  font-size: 13px;
  color: var(--text-light);
  background: white;
  padding: 4px 12px;
  border-radius: 50px;
}

/* Item Card */
.item-link {
  text-decoration: none;
  color: inherit;
}

.item-card {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: var(--shadow);
  transition: all 0.3s;
  height: 100%;
}

.item-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-lg);
}

.item-image {
  position: relative;
  aspect-ratio: 1/1;
  overflow: hidden;
}

.item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s;
}

.item-card:hover .item-image img {
  transform: scale(1.05);
}

.item-badge {
  position: absolute;
  top: 10px;
  left: 10px;
  background: rgba(255,255,255,0.95);
  padding: 6px 10px;
  border-radius: 50px;
  font-size: 16px;
  box-shadow: var(--shadow);
}

.item-body {
  padding: 14px;
}

.item-title {
  font-size: 14px;
  font-weight: 700;
  margin: 0 0 4px;
  color: var(--text);
  line-height: 1.3;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.item-location {
  font-size: 12px;
  color: var(--text-light);
  margin: 0 0 8px;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.item-price {
  font-size: 15px;
  font-weight: 700;
  color: var(--primary);
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: var(--text-light);
}

.empty-icon {
  font-size: 64px;
  margin-bottom: 16px;
}

.empty-state h4 {
  font-weight: 600;
  color: var(--text);
  margin-bottom: 8px;
}

/* Bottom Nav */
.bottom-nav { 
  background: white; 
  border-top: 1px solid var(--border); 
  display: flex; 
  z-index: 20;
  box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
  padding-bottom: env(safe-area-inset-bottom);
}

.nav-btn { 
  background: none; 
  border: none; 
  color: var(--text-light); 
  font-size: 11px; 
  font-weight: 600;
  padding: 12px 8px;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
  transition: color 0.2s;
}

.nav-btn:hover, .nav-btn:active { 
  color: var(--primary); 
}

.nav-btn span {
  font-size: 10px;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-title {
    font-size: 22px;
  }
  
  .search-box {
    padding: 4px 4px 4px 12px;
  }
  
  .search-btn {
    padding: 8px 16px;
  }
}
</style>

@endsection
