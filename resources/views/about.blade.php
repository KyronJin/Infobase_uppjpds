@extends('layouts.app')

@section('content')
<section class="py-20 bg-white">
  <div class="container mx-auto px-6 max-w-6xl">
    <div class="text-center mb-12">
      <span class="welcome-badge">Tentang Kami</span>
      <h1 class="main-title">Perpustakaan Jakarta — UPPJPDS</h1>
      <p class="subtitle">Pusat pembelajaran, dokumentasi, dan layanan informasi untuk warga Jakarta.</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12 items-start">
      <div>
        <h2 class="text-2xl font-bold mb-4">Visi & Misi</h2>
        <p class="text-gray-700 mb-6">Visi kami adalah menjadi pusat pengetahuan yang inklusif dan inovatif untuk seluruh warga Jakarta. Kami menyediakan akses ke koleksi, program edukasi, dan ruang kolaborasi untuk mendukung literasi dan kreativitas.</p>

        <h3 class="text-xl font-semibold mb-2">Nilai Inti</h3>
        <ul class="list-disc list-inside text-gray-700 mb-6">
          <li>Integritas</li>
          <li>Inovasi</li>
          <li>Kualitas layanan</li>
          <li>Kepercayaan publik</li>
        </ul>

        <a href="{{ route('contact') }}" class="btn-primary">Hubungi Kami</a>
      </div>

      <div>
        <div class="image-container mb-6">
          <img src="{{ asset('images/library.jpg') }}" alt="Perpustakaan Jakarta" class="w-full h-full object-cover">
        </div>

        <div class="content-box">
          <h4 class="font-semibold mb-2">Alamat</h4>
          <p class="text-gray-700">Jl. Cikini Raya No.73, Jakarta Pusat</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
