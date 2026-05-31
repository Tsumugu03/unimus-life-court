@extends('layouts.app')
@section('title', $item ? 'Edit Item' : 'Tambah Item')

@section('content')
  <main class="main">
    <div style="max-width:640px;margin:0 auto;">
      <h1 style="font-size:24px;margin-bottom:18px;">{{ $item ? 'Edit Item' : 'Tambah Item' }}</h1>
      @if($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ $item ? route('admin.item.update', $item) : route('admin.item.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item)
          @method('PUT')
        @endif

        <label style="display:block;margin-bottom:12px;">Nama
          <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Kategori
          <select name="category" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;">
            @foreach(['Culinary','Kost','BRT'] as $category)
              <option value="{{ $category }}" {{ old('category', $item->category ?? '') === $category ? 'selected' : '' }}>{{ $category }}</option>
            @endforeach
          </select>
        </label>

        <label style="display:block;margin-bottom:12px;">Harga
          <input type="number" name="price" value="{{ old('price', $item->price ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Label Harga
          <input type="text" name="price_label" value="{{ old('price_label', $item->price_label ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Deskripsi Singkat
          <input type="text" name="short_desc" value="{{ old('short_desc', $item->short_desc ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Deskripsi Lengkap
          <textarea name="description" rows="4" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;">{{ old('description', $item->description ?? '') }}</textarea>
        </label>

        <label style="display:block;margin-bottom:12px;">Jam Operasional
          <input type="text" name="hours" value="{{ old('hours', $item->hours ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Kontak
          <input type="text" name="contact" value="{{ old('contact', $item->contact ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Alamat
          <input type="text" name="address" value="{{ old('address', $item->address ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Latitude
          <input type="text" name="lat" value="{{ old('lat', $item->lat ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Longitude
          <input type="text" name="lng" value="{{ old('lng', $item->lng ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Instagram
          <input type="text" name="instagram" value="{{ old('instagram', $item->instagram ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">TikTok
          <input type="text" name="tiktok" value="{{ old('tiktok', $item->tiktok ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Kode Rute BRT
          <input type="text" name="route_code" value="{{ old('route_code', $item->route_code ?? '') }}" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <label style="display:block;margin-bottom:12px;">Fasilitas (1 baris = 1 item)
          <textarea name="facilities_text" rows="3" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;">{{ old('facilities_text', $item ? implode("\n", $item->facilities ?? []) : '') }}</textarea>
        </label>

        <label style="display:block;margin-bottom:12px;">Halte BRT (1 baris = 1 halte)
          <textarea name="stops_text" rows="3" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;">{{ old('stops_text', $item ? implode("\n", $item->stops ?? []) : '') }}</textarea>
        </label>

        <label style="display:block;margin-bottom:12px;">Gambar
          <input type="file" name="image" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:12px;" />
        </label>

        <button type="submit" class="btn-primary" style="width:100%;margin-top:16px;">{{ $item ? 'Simpan Perubahan' : 'Simpan Item' }}</button>
      </form>
    </div>
  </main>
@endsection
