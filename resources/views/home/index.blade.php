@extends('layouts.app')
@section('title', 'Unimus Life & Culinary Hub')

@section('content')

{{-- HEADER --}}
<header class="app-header">
  <div class="header-inner">
    <a href="{{ route('home') }}" class="header-brand">
      <div class="brand-icon">🎓</div>
      <div class="brand-label">
        <small>Unimus</small>
        <strong>Life & Culinary</strong>
      </div>
    </a>
    <a href="{{ route('admin.login') }}" class="header-admin-btn">🛡️</a>
  </div>

  <div class="search-inner">
    <div class="search-hero">
      <h1>Hidup hemat ala mahasiswa Unimus.</h1>
      <p>Cari kuliner murah, kost harian, dan rute BRT Trans Semarang dalam satu tempat.</p>
    </div>
    <form method="GET" action="{{ route('home') }}">
      @if($activeCategory !== 'All')
        <input type="hidden" name="category" value="{{ $activeCategory }}" />
      @endif
      @if($activePrice !== 'all')
        <input type="hidden" name="price" value="{{ $activePrice }}" />
      @endif
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari makanan, kost, atau halte…" />
        <button type="submit" class="search-btn">Cari</button>
      </div>
    </form>
  </div>
</header>

<main class="main">
  @php
    $categories = [
      'All'      => ['emoji' => '☰',  'label' => 'Semua'],
      'Culinary' => ['emoji' => '🍜', 'label' => 'Kuliner'],
      'Kost'     => ['emoji' => '🏠', 'label' => 'Kost'],
      'BRT'      => ['emoji' => '🚌', 'label' => 'BRT'],
    ];
  @endphp

  <div class="chip-row">
    @foreach($categories as $key => $cat)
      <a href="{{ route('home', array_merge(request()->except('category'), ['category' => $key])) }}" class="chip {{ $activeCategory === $key ? 'active' : '' }}">
        {{ $cat['emoji'] }} {{ $cat['label'] }}
      </a>
    @endforeach
  </div>

  @php
    $priceOptions = [
      'all'  => 'Semua harga',
      'low'  => '< 15rb',
      'mid'  => '15-50rb',
      'high' => '> 50-100rb',
    ];
  @endphp
  <p class="section-label-price">Rentang harga</p>
  <div class="price-row">
    @foreach($priceOptions as $key => $label)
      <a href="{{ route('home', array_merge(request()->except('price'), ['price' => $key])) }}" class="price-btn {{ $activePrice === $key ? 'active' : '' }}">
        {{ $label }}
      </a>
    @endforeach
  </div>

  <div class="results-header">
    <h2 class="results-title">Hasil pencarian</h2>
    <span class="results-count">{{ $items->count() }} tempat</span>
  </div>

  @if($items->isEmpty())
    <div class="empty">Tidak ada hasil. Coba kata kunci atau filter lain.</div>
  @else
    <div class="grid">
      @foreach($items as $item)
        <a href="{{ route('item.show', $item) }}" class="card">
          <div class="card-img">
            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" loading="lazy" />
            <span class="cat-badge {{ $item->category_badge_class }}">
              @if($item->category === 'Culinary') 🍜
              @elseif($item->category === 'Kost') 🏠
              @else 🚌
              @endif
              {{ $item->category }}
            </span>
          </div>
          <div class="card-body">
            <p class="card-name">{{ $item->name }}</p>
            <p class="card-desc">{{ $item->short_desc }}</p>
            <p class="card-price">
              {{ $item->price_formatted }}
              <span>{{ $item->price_label }}</span>
            </p>
          </div>
        </a>
      @endforeach
    </div>
  @endif
</main>

<nav class="bottom-nav">
  <button class="nav-btn active" onclick="location.href='{{ route('home') }}'">🏠 Beranda</button>
  <button class="nav-btn" onclick="location.href='{{ route('admin.login') }}'">🛡️ Admin</button>
</nav>

@endsection
