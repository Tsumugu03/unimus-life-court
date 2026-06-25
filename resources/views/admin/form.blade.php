@extends('layouts.app')
@section('title', $item ? 'Edit Item' : 'Tambah Item')

@section('content')
  <main class="main admin-main">
    <section class="form-card">
      <div style="margin-bottom: 24px;">
        <h1 style="font-size: 28px; margin-bottom: 10px;">{{ $item ? 'Edit Item' : 'Tambah Item' }}</h1>
        <p style="color: var(--text-light); line-height: 1.6;">Lengkapi data item untuk memperbarui katalog dengan tampilan lebih rapi dan profesional.</p>
      </div>

      @if($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ $item ? route('admin.item.update', $item) : route('admin.item.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item)
          @method('PUT')
        @endif

        <div class="form-grid">
          <div class="field-group">
            <label class="field-label">Nama</label>
            <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="field-input" />
          </div>

          <div class="field-group">
            <label class="field-label">Kategori</label>
            <select name="category" class="field-input">
              @foreach(['Culinary','Kost','BRT'] as $category)
                <option value="{{ $category }}" {{ old('category', $item->category ?? '') === $category ? 'selected' : '' }}>{{ $category }}</option>
              @endforeach
            </select>
          </div>

          <div class="field-group">
            <label class="field-label">Harga</label>
            <input type="number" name="price" value="{{ old('price', $item->price ?? '') }}" class="field-input" />
          </div>

          <div class="field-group">
            <label class="field-label">Label Harga</label>
            <input type="text" name="price_label" value="{{ old('price_label', $item->price_label ?? '') }}" class="field-input" />
          </div>

          <div class="field-group span-2">
            <label class="field-label">Deskripsi Singkat</label>
            <input type="text" name="short_desc" value="{{ old('short_desc', $item->short_desc ?? '') }}" class="field-input" />
          </div>

          <div class="field-group span-2">
            <label class="field-label">Deskripsi Lengkap</label>
            <textarea name="description" class="field-input">{{ old('description', $item->description ?? '') }}</textarea>
          </div>

          <div class="field-group">
            <label class="field-label">Jam Operasional</label>
            <input type="text" name="hours" value="{{ old('hours', $item->hours ?? '') }}" class="field-input" />
          </div>

          <div class="field-group">
            <label class="field-label">Kontak (Optional)</label>
            <input type="text" name="contact" value="{{ old('contact', $item->contact ?? '') }}" class="field-input" />
            <small style="display:block;margin-top:6px;color:var(--text-light);line-height:1.6;">Nomor kontak hanya diperlukan jika ingin menampilkan tombol WhatsApp pada detail item.</small>
          </div>

          <div class="field-group">
            <label class="field-label">Alamat</label>
            <input type="text" name="address" value="{{ old('address', $item->address ?? '') }}" class="field-input" />
          </div>

          <div class="field-group">
            <label class="field-label">Latitude</label>
            <input type="text" name="lat" value="{{ old('lat', $item->lat ?? '') }}" class="field-input" />
          </div>

          <div class="field-group">
            <label class="field-label">Longitude</label>
            <input type="text" name="lng" value="{{ old('lng', $item->lng ?? '') }}" class="field-input" />
          </div>

          {{-- maps_url field removed because the database schema does not currently include this column. --}}

          <div class="field-group">
            <label class="field-label">Instagram</label>
            <input type="text" name="instagram" value="{{ old('instagram', $item->instagram ?? '') }}" class="field-input" />
          </div>

          <div class="field-group">
            <label class="field-label">TikTok</label>
            <input type="text" name="tiktok" value="{{ old('tiktok', $item->tiktok ?? '') }}" class="field-input" />
          </div>

          <div class="field-group">
            <label class="field-label">Kode Rute BRT</label>
            <input type="text" name="route_code" value="{{ old('route_code', $item->route_code ?? '') }}" class="field-input" />
          </div>

          <div class="field-group span-2">
            <label class="field-label">Fasilitas (1 baris = 1 item)</label>
            <textarea name="facilities_text" class="field-input">{{ old('facilities_text', $item ? implode("\n", $item->facilities ?? []) : '') }}</textarea>
          </div>

          <div class="field-group span-2">
            <label class="field-label">Halte BRT (1 baris = 1 halte)</label>
            <textarea name="stops_text" class="field-input">{{ old('stops_text', $item ? implode("\n", $item->stops ?? []) : '') }}</textarea>
          </div>

          <div class="field-group span-2">
            <label class="field-label">Gambar</label>
            <input type="file" name="image" class="field-input" />
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-primary" style="margin-top: 0;">{{ $item ? 'Simpan Perubahan' : 'Simpan Item' }}</button>
          <a href="{{ route('admin.dashboard') }}" class="btn-danger-full" style="margin-top: 0;">Kembali</a>
        </div>
      </form>
    </section>
  </main>
@endsection
