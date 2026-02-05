@extends('layouts.app')

@section('content')

<section class="py-20 bg-white">
  <div class="container mx-auto px-6 max-w-6xl">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 bg-[#00425A] bg-opacity-10 text-[#00425A] text-sm font-semibold rounded-full border border-[#00425A] border-opacity-20">
        Tentang Kami
      </span>
      <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mt-4 mb-4">Perpustakaan Jakarta — UPPJPDS</h1>
      <p class="text-lg text-gray-800 max-w-2xl mx-auto">Pusat pembelajaran, dokumentasi, dan layanan informasi untuk warga Jakarta.</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12 items-start mb-16">
      <div>
        <h2 class="text-3xl font-bold mb-6 text-[#00425A]">Tentang Kami</h2>
        <p class="text-gray-700 mb-6 text-lg leading-relaxed">
          Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen untuk menyediakan akses informasi berkualitas tinggi kepada seluruh masyarakat Jakarta. Kami berfungsi sebagai pusat pembelajaran, dokumentasi, dan pemeliharaan memori kolektif masyarakat.
        </p>
        <p class="text-gray-700 mb-8 text-lg leading-relaxed">
          Dengan koleksi lengkap, fasilitas modern, dan staf yang profesional, kami menawarkan lebih dari sekadar tempat meminjam buku. Kami adalah ruang untuk belajar, berkolaborasi, berinovasi, dan terhubung dengan komunitas pengetahuan.
        </p>

        <h3 class="text-2xl font-bold mb-4 text-[#00425A]">Visi Kami</h3>
        <div class="bg-[#00425A] bg-opacity-5 border-l-4 border-[#00425A] p-6 mb-8 rounded">
          <p class="text-sm text-white text-lg font-semibold leading-relaxed">
            Menjadi pusat pengetahuan yang inklusif, inovatif, dan relevan untuk mendukung literasi dan kreativitas seluruh warga Jakarta, sehingga perpustakaan menjadi jantung komunitas yang hidup dan dinamis.
          </p>
        </div>

        <h3 class="text-2xl font-bold mb-4 text-[#00425A]">Misi Kami</h3>
        <ul class="space-y-4">
          <li class="flex gap-4">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-0.5"></i>
            </div>
            <div>
              <p class="text-gray-700 text-lg"><strong>Menyediakan akses informasi berkualitas:</strong> Memastikan semua orang dapat mengakses sumber daya pembelajaran tanpa hambatan finansial atau geografis.</p>
            </div>
          </li>
          <li class="flex gap-4">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-0.5"></i>
            </div>
            <div>
              <p class="text-gray-700 text-lg"><strong>Mendorong budaya baca dan inovasi:</strong> Mengembangkan program yang menginspirasi masyarakat untuk membaca, belajar, dan berinovasi.</p>
            </div>
          </li>
          <li class="flex gap-4">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-0.5"></i>
            </div>
            <div>
              <p class="text-gray-700 text-lg"><strong>Menciptakan ekosistem pembelajaran:</strong> Menyediakan ruang dan program yang mendukung pembelajaran seumur hidup untuk semua kalangan.</p>
            </div>
          </li>
          <li class="flex gap-4">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-0.5"></i>
            </div>
            <div>
              <p class="text-gray-700 text-lg"><strong>Memberdayakan masyarakat:</strong> Membantu masyarakat mengembangkan keterampilan dan pengetahuan untuk meningkatkan kualitas hidup mereka.</p>
            </div>
          </li>
        </ul>
      </div>

      <div>
        <div class="sticky top-24">
          <div class="image-container mb-8 rounded-2xl overflow-hidden shadow-xl">
            <img src="{{ asset('images/library.jpg') }}" alt="Perpustakaan Jakarta" class="w-full h-96 object-cover">
          </div>

          <h3 class="text-2xl font-bold mb-4 text-[#00425A]">Nilai Inti Kami</h3>
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-gradient-to-br from-[#00425A] to-[#003144] text-white p-6 rounded-xl">
              <i class="fas fa-handshake text-3xl text-[#f85e38] mb-3 block"></i>
              <h4 class="font-bold  text-white">Integritas</h4>
              <p class="text-sm text-white text-opacity-90">Memperlakukan semua orang dengan kejujuran dan transparansi.</p>
            </div>
            <div class="bg-gradient-to-br from-[#f85e38] to-[#d94e2e] text-white p-6 rounded-xl">
              <i class="fas fa-lightbulb text-3xl text-white mb-3 block"></i>
              <h4 class="font-bold  text-white">Inovasi</h4>
              <p class="text-sm text-white text-opacity-90">Terus berkembang dan mengadopsi teknologi terbaru.</p>
            </div>
            <div class="bg-gradient-to-br from-[#00425A] to-[#003144] text-white p-6 rounded-xl">
              <i class="fas fa-star text-3xl text-[#f85e38] mb-3 block"></i>
              <h4 class="font-bold  text-white">Kualitas Layanan</h4>
              <p class="text-sm text-white text-opacity-90">Memberikan layanan terbaik untuk kepuasan pelanggan.</p>
            </div>
            <div class="bg-gradient-to-br from-[#f85e38] to-[#d94e2e] text-white p-6 rounded-xl">
              <i class="fas fa-shield-alt text-3xl text-white mb-3 block"></i>
              <h4 class="font-bold text-white">Kepercayaan Publik</h4>
              <p class="text-sm text-white text-opacity-90">Menjadi lembaga yang dapat diandalkan masyarakat.</p>
            </div>
          </div>

          <div class="mt-8 bg-blue-50 border-l-4 border-[#00425A] p-6 rounded">
            <h4 class="font-bold text-[#00425A] mb-3">
              <i class="fas fa-info-circle mr-2"></i>Informasi Kontak
            </h4>
            <p class="text-gray-700 text-sm mb-2">
              <strong>Alamat:</strong> Jl. Cikini Raya No. 73, Jakarta Pusat
            </p>
            <p class="text-gray-700 text-sm mb-2">
              <strong>Telepon:</strong> <a href="tel:+62214706295" class="text-[#00425A] hover:text-[#f85e38]">(+62 21) 4706-295</a>
            </p>
            <p class="text-gray-700 text-sm">
              <strong>Email:</strong> <a href="mailto:info@perpustakaan.jakarta.go.id" class="text-[#00425A] hover:text-[#f85e38]">info@perpustakaan.jakarta.go.id</a>
            </p>
          </div>

          <a href="{{ route('contact') }}" class="mt-8 block text-center px-6 py-3 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300">
            <i class="fas fa-envelope mr-2"></i>Hubungi Kami
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
