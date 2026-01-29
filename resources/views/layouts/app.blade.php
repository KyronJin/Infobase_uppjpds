<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'INFOBASE') }}</title>

    <!-- Fonts (brand: Cairo for logo, Inter main, Source Serif 4 italic accents) -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Inter:wght@200;300;400;500;600;700;800;900&family=Source+Serif+4:ital,wght@1,400;1,600;1,700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
    <!-- Fallback plain CSS so pages look correct before Tailwind/Vite build runs -->
    <link rel="stylesheet" href="{{ asset('css/fallback.css') }}">
  </head>
  <body class="bg-white text-gray-900 antialiased">
    <div id="app">
      @includeIf('components.navbar')

      <main class="pt-20"> <!-- reserve space for fixed navbar -->
        <div class="container mx-auto px-4 lg:px-8">
          @yield('content')
        </div>
      </main>

      <footer class="bg-gray-100 border-t mt-12">
        <div class="container mx-auto px-6 lg:px-8 py-8 text-center text-sm text-gray-600">
          © {{ date('Y') }} Perpustakaan Jakarta — INFOBASE. Semua hak dilindungi.
        </div>
      </footer>
    </div>
  </body>
</html>
