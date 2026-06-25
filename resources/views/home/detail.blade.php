@extends('layouts.app')
@section('title', $item->name)

@section('content')

<div class="position-relative" style="aspect-ratio: 16/9; overflow: hidden; background: var(--border);">
  <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-100 h-100" style="object-fit: cover;">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%, transparent 60%);"></div>
  
  <a href="{{ route('home') }}" class="btn btn-light rounded-circle position-absolute top-3 start-3" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border: none;">
    ←
  </a>
  
  <span class="badge position-absolute top-3 end-3" style="background: var(--primary); font-size: 12px; font-weight: 700; padding: 8px 14px; border-radius: 20px;">
    @if($item->category === 'Culinary') 🍜
    @elseif($item->category === 'Kost') 🏠
    @else 🚌
    @endif
    {{ $item->category }}
  </span>
</div>

<div class="container-fluid px-0">
  <div class="card" style="margin-top: -24px; margin-left: auto; margin-right: auto; max-width: 100%; border: 1.5px solid var(--border); border-radius: 24px; box-shadow: 0 8px 24px rgba(0,0,0,0.10); position: relative; z-index: 1; margin-left: auto; margin-right: auto; width: calc(100% - 32px); max-width: 960px;">
    <div class="card-body p-4 p-md-5">
      <h1 class="mb-3" style="font-size: 28px; font-weight: 800; line-height: 1.2;">{{ $item->name }}</h1>
      <p class="text-muted mb-3" style="font-size: 15px;">{{ $item->short_desc }}</p>
      <p style="font-size: 28px; font-weight: 900; color: var(--primary); margin: 0;">
        {{ $item->price_formatted }}
        <span style="font-size: 14px; font-weight: 500; color: var(--muted);">{{ $item->price_label }}</span>
      </p>
    </div>
  </div>
</div>

<main class="detail-main mt-5 pb-5">
  <div class="container-fluid px-3 px-md-4" style="max-width: 960px; margin-left: auto; margin-right: auto;">
    
    {{-- DESCRIPTION --}}
    <div class="detail-section mb-5 p-4 rounded-3" style="background: white; border: 1.5px solid var(--border); box-shadow: var(--shadow-card);">
      <h3 class="detail-section-title mb-3">📝 Deskripsi</h3>
      <p class="detail-desc mb-0" style="font-size: 15px; line-height: 1.7;">{{ $item->description }}</p>
    </div>

    {{-- FACILITIES --}}
    @if($item->facilities && count($item->facilities) > 0)
    <div class="detail-section mb-5 p-4 rounded-3" style="background: white; border: 1.5px solid var(--border); box-shadow: var(--shadow-card);">
      <h3 class="detail-section-title mb-3">✨ Fasilitas</h3>
      <div class="row g-2">
        @foreach($item->facilities as $facility)
          <div class="col-6 col-md-4">
            <div class="p-3 rounded-3 text-center" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af; font-size: 13px; font-weight: 600;">
              ✓ {{ $facility }}
            </div>
          </div>
        @endforeach
      </div>
    </div>
    @endif

    {{-- BRT STOPS --}}
    @if($item->category === 'BRT' && $item->stops && count($item->stops) > 0)
    <div class="detail-section mb-5 p-4 rounded-3" style="background: white; border: 1.5px solid var(--border); box-shadow: var(--shadow-card);">
      <h3 class="detail-section-title mb-3">🚌 Halte BRT</h3>
      <div style="border-left: 3px solid var(--primary); padding-left: 20px;">
        @foreach($item->stops as $stop)
          <p class="mb-2" style="font-size: 14px; color: var(--text); position: relative; padding-left: 10px;">
            <span style="position: absolute; left: -26px; top: 2px; width: 12px; height: 12px; border-radius: 50%; background: var(--primary); border: 3px solid white;"></span>
            {{ $stop }}
          </p>
        @endforeach
      </div>
    </div>
    @endif

    {{-- INFORMATION --}}
    <div class="detail-section mb-5 p-4 rounded-3" style="background: white; border: 1.5px solid var(--border); box-shadow: var(--shadow-card);">
      <h3 class="detail-section-title mb-4">ℹ️ Informasi</h3>

      @php
        $instagramUrl = null;
        $tiktokUrl = null;
        if ($item->instagram) {
            $insta = trim($item->instagram);
            $instagramUrl = preg_match('/^https?:\/\//', $insta) ? $insta : 'https://instagram.com/'.ltrim($insta, '@');
        }
        if ($item->tiktok) {
            $tiktok = trim($item->tiktok);
            $tiktokUrl = preg_match('/^https?:\/\//', $tiktok) ? $tiktok : 'https://www.tiktok.com/@'.ltrim($tiktok, '@');
        }
      @endphp
      
      <div class="row g-3">
        <div class="col-12">
          <div class="d-flex gap-3 p-3 rounded-2" style="background: var(--primary-soft); border: 1px solid rgba(30,64,175,0.2);">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px;">📍</div>
            <div>
              <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--muted); margin: 0;">Alamat</p>
              <p style="font-size: 14px; color: var(--text); margin: 4px 0 0 0; font-weight: 600;">{{ $item->address }}</p>
            </div>
          </div>
        </div>
        
        <div class="col-12">
          <div class="d-flex gap-3 p-3 rounded-2" style="background: #fef3c7; border: 1px solid rgba(245,158,11,0.2);">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: var(--accent); color: white; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px;">⏰</div>
            <div>
              <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--muted); margin: 0;">Jam Operasional</p>
              <p style="font-size: 14px; color: var(--text); margin: 4px 0 0 0; font-weight: 600;">{{ $item->hours }}</p>
            </div>
          </div>
        </div>
        
        <div class="col-12">
          <div class="d-flex gap-3 p-3 rounded-2" style="background: #e0f2fe; border: 1px solid rgba(30,64,175,0.2);">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px;">📞</div>
            <div>
              <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--muted); margin: 0;">Kontak</p>
              <p style="font-size: 14px; color: var(--primary); margin: 4px 0 0 0; font-weight: 700;">{{ $item->contact }}</p>
            </div>
          </div>
        </div>

        @if($instagramUrl || $tiktokUrl)
        <div class="col-12">
          <div class="p-3 rounded-2" style="background: #f8fafc; border: 1.5px solid rgba(226,232,240,0.8);">
            <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--muted); margin: 0 0 12px 0;">Sosial Media</p>
            <div class="d-flex flex-wrap gap-2">
              @if($instagramUrl)
                <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark btn-sm rounded-pill" style="min-width: 120px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                  📷 Instagram
                </a>
              @endif
              @if($tiktokUrl)
                <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark btn-sm rounded-pill" style="min-width: 120px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                  🎵 TikTok
                </a>
              @endif
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>

    {{-- LOCATION & ACTIONS --}}
    @if($item->lat && $item->lng)
    <div class="detail-section mb-5 p-4 rounded-3" style="background: white; border: 1.5px solid var(--border); box-shadow: var(--shadow-card);">
      <h3 class="detail-section-title mb-4">🗺️ Lokasi</h3>

      <div class="mb-4 p-4 rounded-3" style="background: #f8fafc; border: 1.5px solid var(--border);">
        <p style="font-size: 14px; font-weight: 700; margin: 0 0 6px 0; color: var(--muted);">Alamat</p>
        <p style="font-size: 15px; margin: 0; color: var(--text);">{{ $item->address }}</p>
      </div>

      <div class="row g-3">
        @if($item->contact)
        <div class="col-6">
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->contact) }}?text=Halo,%20saya%20tertarik%20dengan%20{{ urlencode($item->name) }}" 
             target="_blank" 
             class="btn w-100" 
             style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; font-weight: 700; padding: 12px 16px; border-radius: 12px;">
            💬 WhatsApp
          </a>
        </div>
        @endif
        <div class="col-6">
          @if($item->category === 'BRT')
          <a href="https://www.google.com/maps/dir/?api=1&origin=UNIMUS+Semarang&destination={{ $item->lat }},{{ $item->lng }}&travelmode=transit" 
             target="_blank" 
             class="btn w-100" 
             style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; font-weight: 700; padding: 12px 16px; border-radius: 12px;">
            🚏 Rute dari UNIMUS
          </a>
          @else
          <a href="https://maps.google.com/?q={{ $item->lat }},{{ $item->lng }}" 
             target="_blank" 
             class="btn w-100" 
             style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; font-weight: 700; padding: 12px 16px; border-radius: 12px;">
            🧭 Buka Google Maps
          </a>
          @endif
        </div>
      </div>
    </div>
    @endif

    {{-- BACK BUTTON --}}
    <div class="text-center mb-5">
      <a href="{{ route('home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2">
        ← Kembali ke Beranda
      </a>
    </div>

  </div>
</main>

<style>
.detail-section-title { 
  font-size: 14px; 
  font-weight: 700; 
  text-transform: uppercase; 
  letter-spacing: 0.08em; 
  color: var(--muted); 
}
.detail-desc { 
  font-size: 15px; 
  line-height: 1.7;
  color: var(--text);
}
</style>

@endsection
