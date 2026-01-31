<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('components.partials.header')
    @livewireStyles
</head>
<body class="index-page">

 <!-- navigation -->
  @hasSection('nav')
      @yield('nav')
  @else
      @if (!request()->is('register') && !request()->is('login'))
          @include('components.partials.nav') {{-- Navbar hanya jika bukan halaman /register --}}
      @endif
  @endif
  <!-- /navigation -->

{{ $slot }}

  @if (!request()->is('register') && !request()->is('login'))
      @include('components.partials.footer') {{-- Footer juga tidak ditampilkan di halaman /register --}}
  @endif

@include('components.partials.script')
    @livewireScripts
</body>

</html>