@extends('layouts.app')
@section('title', 'FAQ - Unimus Life & Culinary Hub')

@section('content')
<div class="container px-3 px-md-4 py-5">
  <div class="faq-card">
    <div class="faq-header">
      <h1>FAQ</h1>
      <p>Temukan jawaban singkat tentang penggunaan aplikasi dan akses admin di smartphone.</p>
    </div>
    <div class="faq-grid">
      <div class="faq-item">
        <strong>Bagaimana menggunakan aplikasi ini?</strong>
        <p>Gunakan kolom pencarian untuk menemukan kuliner, kost, atau halte BRT. Filter kategori dan harga membantu mempersempit hasil.</p>
      </div>
      <div class="faq-item">
        <strong>Apakah admin bisa diakses dari smartphone?</strong>
        <p>Bisa. Tombol Admin tersedia di menu bawah pada smartphone, sehingga akses login admin tetap mudah dari ponsel.</p>
      </div>
      <div class="faq-item">
        <strong>Apa fungsi tombol Admin?</strong>
        <p>Tombol Admin membuka halaman login admin untuk mengelola daftar tempat, mengganti info, dan menambah item baru.</p>
      </div>
      <div class="faq-item">
        <strong>Bagaimana melihat detail setiap tempat?</strong>
        <p>Klik kartu tempat dari hasil pencarian atau daftar untuk membuka halaman detail lengkap.</p>
      </div>
    </div>
  </div>
</div>
@endsection
