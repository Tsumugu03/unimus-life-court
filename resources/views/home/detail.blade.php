@extends('layouts.app')
@section('title', $item->name)

@section('content')
  <div class="detail-hero">
    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" style="width:100%;height:100%;object-fit:cover;" />
    <div class="detail-hero-overlay"></div>
  </div>
  <div class="detail-card">
    <a href="{{ route('home') }}" class="back-btn" style="cursor:pointer;z-index:10;">←</a>
    <span class="hero-badge">{{ $item->category }}</span>
    <h1 class="detail-name">{{ $item->name }}</h1>
    <p class="detail-shortdesc">{{ $item->short_desc }}</p>
    <p class="detail-price">{{ $item->price_formatted }} <span>{{ $item->price_label }}</span></p>
  </div>
  <div class="detail-main">
    <div class="detail-section">
      <p class="detail-section-title">📝 Deskripsi</p>
      <p class="detail-desc">{{ $item->description }}</p>
    </div>

    @if($item->facilities && count($item->facilities) > 0)
    <div class="detail-section">
      <p class="detail-section-title">✨ Fasilitas</p>
      <div class="facilities">
        @foreach($item->facilities as $facility)
          <div class="facility" style="background:linear-gradient(135deg,#dbeafe 0%,#bfdbfe 100%);color:#1e40af;border-radius:10px;padding:8px 10px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:8px;">
            <span>✓</span> {{ $facility }}
          </div>
        @endforeach
      </div>
    </div>
    @endif

    @if($item->category === 'BRT' && $item->stops && count($item->stops) > 0)
    <div class="detail-section">
      <p class="detail-section-title">🚌 Halte BRT</p>
      <div class="brt-stops">
        @foreach($item->stops as $stop)
          <div class="brt-stop" style="position:relative;font-size:13px;padding:8px 0 8px 20px;color:#1e293b;">{{ $stop }}</div>
        @endforeach
      </div>
    </div>
    @endif

    <div class="detail-section">
      <p class="detail-section-title">ℹ️ Informasi</p>
      <div class="info-row">
        <div class="info-icon">📍</div>
        <div style="flex:1;">
          <div class="info-label">Alamat</div>
          <div class="info-value">{{ $item->address }}</div>
        </div>
      </div>
      <div class="info-row">
        <div class="info-icon">⏰</div>
        <div style="flex:1;">
          <div class="info-label">Jam Operasional</div>
          <div class="info-value">{{ $item->hours }}</div>
        </div>
      </div>
      <div class="info-row">
        <div class="info-icon">📞</div>
        <div style="flex:1;">
          <div class="info-label">Kontak</div>
          <div class="info-value" style="color:var(--primary);font-weight:600;">{{ $item->contact }}</div>
        </div>
      </div>
    </div>

    @if($item->maps_url || ($item->lat && $item->lng))
    <div class="detail-section">
      <p class="detail-section-title">🗺️ Lokasi</p>
      <div class="map-preview" style="border-radius:14px;overflow:hidden;border:1.5px solid var(--border);background:var(--border);position:relative;height:240px;margin-bottom:12px;">
        @if($item->maps_url)
          @if(strpos($item->maps_url, 'iframe') !== false)
            {!! $item->maps_url !!}
          @else
            <iframe 
              width="100%" 
              height="240" 
              style="border:0;border-radius:14px;" 
              loading="lazy" 
              allowfullscreen="" 
              src="https://www.google.com/maps/embed/v1/place?key={{ config('services.google_maps.key') }}&q={{ $item->lat }},{{ $item->lng }}&zoom=16">
            </iframe>
          @endif
        @elseif($item->lat && $item->lng)
          <iframe 
            width="100%" 
            height="240" 
            style="border:0;border-radius:14px;" 
            loading="lazy" 
            allowfullscreen="" 
            src="https://www.google.com/maps/embed/v1/place?key={{ config('services.google_maps.key') }}&q={{ $item->lat }},{{ $item->lng }}&zoom=16">
          </iframe>
        @endif
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
        <a class="btn-primary" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->contact) }}?text=Halo,%20saya%20tertarik%20dengan%20{{ urlencode($item->name) }}" target="_blank" style="background:linear-gradient(135deg,#10b981 0%,#059669 100%);margin-top:0;display:flex;align-items:center;justify-content:center;gap:6px;font-size:15px;">
          💬 Hubungi
        </a>
        <a class="btn-primary" href="https://maps.google.com/?q={{ $item->lat }},{{ $item->lng }}" target="_blank" style="background:linear-gradient(135deg,#f59e0b 0%,#d97706 100%);margin-top:0;display:flex;align-items:center;justify-content:center;gap:6px;font-size:15px;">
          🧭 Rute
        </a>
      </div>
    </div>
    @endif
  </div>
@endsection
