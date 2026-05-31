@extends('layouts.app')
@section('title', $item->name)

@section('content')
  <div class="detail-hero">
    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" />
  </div>
  <div class="detail-card">
    <button class="back-btn" onclick="location.href='{{ route('home') }}'">←</button>
    <span class="hero-badge">{{ $item->category }}</span>
    <h1 class="detail-name">{{ $item->name }}</h1>
    <p class="detail-shortdesc">{{ $item->short_desc }}</p>
    <p class="detail-price">{{ $item->price_formatted }} <span>{{ $item->price_label }}</span></p>
    <div class="detail-main">
      <div class="detail-section">
        <p class="detail-section-title">Deskripsi</p>
        <p class="detail-desc">{{ $item->description }}</p>
      </div>
      <div class="detail-section">
        <p class="detail-section-title">Fasilitas</p>
        <div class="facilities">
          @forelse($item->facilities ?? [] as $facility)
            <div class="facility">• {{ $facility }}</div>
          @empty
            <div class="facility">Tidak ada data fasilitas.</div>
          @endforelse
        </div>
      </div>
      @if($item->category === 'BRT')
        <div class="detail-section">
          <p class="detail-section-title">Rute BRT</p>
          <div class="brt-stops">
            @forelse($item->stops ?? [] as $stop)
              <div class="brt-stop">{{ $stop }}</div>
            @empty
              <div class="brt-stop">Tidak ada halte.</div>
            @endforelse
          </div>
        </div>
      @endif
      <div class="detail-section">
        <div class="info-row">
          <div class="info-icon">📍</div>
          <div>
            <div class="info-label">Alamat</div>
            <div class="info-value">{{ $item->address }}</div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon">⏰</div>
          <div>
            <div class="info-label">Jam</div>
            <div class="info-value">{{ $item->hours }}</div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon">📞</div>
          <div>
            <div class="info-label">Kontak</div>
            <div class="info-value">{{ $item->contact }}</div>
          </div>
        </div>
      </div>
      <div class="detail-section">
        <a class="btn-primary" href="https://maps.google.com/?q={{ $item->lat }},{{ $item->lng }}" target="_blank">Lihat di Peta</a>
      </div>
    </div>
  </div>
@endsection
