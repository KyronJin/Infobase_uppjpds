@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-50">
  <div class="container mx-auto px-6 max-w-4xl">
    <div class="text-center mb-10">
      <h1 class="text-3xl font-bold mb-2">Hubungi Kami</h1>
      <p class="text-gray-600">Kirim pertanyaan, saran, atau permintaan informasi melalui formulir berikut.</p>
    </div>

    <div class="bg-white rounded-2xl shadow p-8">
      @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
          <ul class="text-red-700 text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div>
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div>
          <label class="form-label">Pesan</label>
          <textarea name="message" class="form-control" rows="6" required></textarea>
        </div>

        <div>
          <button class="form-submit">Kirim Pesan</button>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection
