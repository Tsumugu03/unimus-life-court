@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
  <main class="main">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
      <div>
        <h1 style="font-size:24px;margin-bottom:8px;">Admin Dashboard</h1>
        <p style="color:#64748b;">Kelola katalog item kuliner, kost, dan BRT.</p>
      </div>
      <a href="{{ route('admin.item.create') }}" class="btn-primary" style="width:auto;padding:12px 16px;">Tambah Item</a>
    </div>

    @if(session('success'))
      <div class="alert alert-success" style="margin-top:18px;">{{ session('success') }}</div>
    @endif

    <div style="margin-top:24px;">
      @if($items->isEmpty())
        <div class="empty">Belum ada item. Tambahkan melalui tombol di atas.</div>
      @else
        <div class="grid" style="grid-template-columns:1fr;gap:14px;">
          @foreach($items as $item)
            <article class="card">
              <div style="display:flex;gap:14px;align-items:center;">
                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" style="width:120px;height:90px;object-fit:cover;border-radius:14px;" />
                <div style="flex:1;">
                  <h2 style="margin:0 0 8px;font-size:18px;">{{ $item->name }}</h2>
                  <p style="margin:0 0 6px;color:#64748b;">{{ $item->category }} · {{ $item->price_formatted }}</p>
                  <p style="margin:0;color:#475569;font-size:13px;">{{ $item->short_desc }}</p>
                </div>
              </div>
              <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ route('admin.item.edit', $item) }}" class="btn-primary" style="background:#2563eb;">Edit</a>
                <form method="POST" action="{{ route('admin.item.destroy', $item) }}" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="padding:10px 14px;border-radius:12px;border:1px solid #ef4444;color:#ef4444;background:#fff;cursor:pointer;">Hapus</button>
                </form>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </main>
@endsection
