<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <!-- Logo Kantin -->
        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Jika ingin pakai gambar logo, tinggal buka komen baris bawah -->
        <!-- <img src="assets/img/logo-kantin.png" alt="Logo Kantin"> -->
        <h1 class="sitename">KantinKu</h1>
        </a>

        <!-- Navigasi Utama -->
        <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="#hero" class="active">Beranda</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#menu">Menu Hari Ini</a></li>
            <li><a href="{{ url('/order') }}">Pesanan Saya</a></li>
            <li><a href="#notifikasi">Notifikasi</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <!-- Tombol Mulai -->
        <a class="btn-getstarted" href="{{ url('/register') }}">Pesan Sekarang</a>

    </div>
</header>