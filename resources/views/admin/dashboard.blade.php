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
      <div class="admin-actions-and-filter" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('admin.item.create') }}" class="btn btn-primary btn-sm">+ Tambah Item</a>
        <!-- Filter Kategori dengan Dropdown -->
        <div class="admin-filter" style="display: flex; gap: 12px; align-items: center;">
          <div class="dropdown">
            <button class="btn btn-outline-secondary btn-sm rounded-pill d-flex align-items-center gap-2" type="button" id="categoryFilter" data-bs-toggle="dropdown">
              <span>🔽 Filter Kategori</span>
              <span style="font-size: 12px; background: var(--primary); color: white; padding: 2px 8px; border-radius: 12px; min-width: 20px; text-align: center;">
                {{ $items->count() }}
              </span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="categoryFilter">
              <li><a class="dropdown-item {{ !$category ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">📋 Semua ({{ $items->count() }})</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item {{ $category === 'Culinary' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['category' => 'Culinary']) }}">🍜 Culinary ({{ $counts->get('Culinary', 0) }})</a></li>
              <li><a class="dropdown-item {{ $category === 'Kost' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['category' => 'Kost']) }}">🏠 Kost ({{ $counts->get('Kost', 0) }})</a></li>
              <li><a class="dropdown-item {{ $category === 'BRT' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['category' => 'BRT']) }}">🚌 BRT ({{ $counts->get('BRT', 0) }})</a></li>
            </ul>
          </div>
        </div>
      </div>

      @if($items->isEmpty())
        <div class="empty" style="margin-top:24px;">Belum ada item. Tambahkan melalui tombol di atas.</div>
      @else
        <div class="admin-summary">
          <div class="admin-summary-card">
            <strong>{{ $totalCount }}</strong>
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
                <div class="admin-card-actions d-flex gap-2">
                  <!-- Action Menu Dropdown -->
                  <div class="dropdown">
                    <button class="btn btn-sm rounded-pill" style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white; border: none; padding: 8px 16px; font-weight: 600; display: flex; align-items: center; gap: 6px;" type="button" data-bs-toggle="dropdown">
                      ⚙️ Aksi
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                      <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('item.show', $item) }}" target="_blank"><span>👁️</span> Preview</a></li>
                      <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.item.edit', $item) }}"><span>✏️</span> Edit</a></li>
                      <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.item.duplicate', $item) }}"><span>📋</span> Duplikat</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <form method="POST" action="{{ route('admin.item.destroy', $item) }}" class="m-0" style="display: contents;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger" onclick="return confirm('Yakin ingin menghapus item ini?')">
                            <span>🗑️</span> Hapus
                          </button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </section>
  </main>

  <style>
    /* Filter Dropdown Styling */
    .admin-filter .dropdown-menu {
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 8px 0;
    }

    .admin-filter .dropdown-item {
      padding: 10px 16px;
      font-size: 14px;
      color: #374151;
      transition: all 0.2s ease;
    }

    .admin-filter .dropdown-item:hover {
      background-color: #f3f4f6;
      color: #1e40af;
    }

    .admin-filter .dropdown-item.active {
      background-color: #dbeafe;
      color: #1e40af;
      font-weight: 600;
    }

    /* Action Menu Dropdown */
    .admin-card-actions .dropdown-menu {
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
      padding: 8px 0;
      animation: slideDown 0.2s ease;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-8px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .admin-card-actions .dropdown-item {
      padding: 12px 16px;
      font-size: 14px;
      color: #374151;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
    }

    .admin-card-actions .dropdown-item:hover {
      background-color: #f3f4f6;
      color: #1e40af;
      border-left-color: #3b82f6;
      padding-left: 13px;
    }

    .admin-card-actions .dropdown-item.text-danger:hover {
      background-color: #fef2f2;
      color: #dc2626;
      border-left-color: #dc2626;
    }

    .admin-card-actions .dropdown-item span {
      min-width: 20px;
      text-align: center;
    }

    /* Aksi Button */
    .admin-card-actions .btn {
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(30, 64, 175, 0.15);
    }

    .admin-card-actions .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25);
    }
  </style>
@endsection
