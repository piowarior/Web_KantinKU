<main class="main">

    
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                <h2>Selamat Datang di Kantinku</h2>
                <p>Web pemesanan makanan praktis untuk kantin sekolah. Pesan makanan favoritmu langsung dari HP dan ambil saat sudah siap, tanpa antri!</p>
                <div class="hero-btns">
                    <a href="#menu" class="btn btn-primary">Lihat Menu Hari Ini</a>
                </div>
                
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image" style="border-radius: 300px;" data-aos="zoom-out" data-aos-delay="300">
                <img src="{{ asset ('front/assets/img/about/makanan1-img.png') }}" class="img-fluid rounded">
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- /Hero Section -->


    
    <!-- Tentang Section -->
    <section id="tentang" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
        <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="200">
            <div class="about-image">
            <img src="{{ asset ('front/assets/img/about/kantin2.jpeg') }}" 
                alt="Tentang Kantin Sekolah" class="img-fluid main-image">
            <div class="experience-badge">
                <span class="years">10+</span>
                <span class="text">Tahun Melayani</span>
            </div>
            </div>
        </div>

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="about-content">
            <h2>Kantin Digital Sekolah yang Praktis & Higienis</h2>
            <p class="lead">Kami menyediakan platform pemesanan makanan yang cepat, mudah, dan higienis bagi para siswa dan guru di lingkungan sekolah.</p>
            <p>Dengan sistem pemesanan online, pengguna dapat memilih menu harian, memesan makanan, dan mendapatkan notifikasi saat makanan siap diambil tanpa harus antre panjang.</p>

            <div class="row features-row">
                <div class="col-md-6">
                <div class="feature-item">
                    <div class="icon">
                    <i class="bi bi-basket"></i>
                    </div>
                    <h4>Menu Bervariasi</h4>
                    <p>Beragam pilihan makanan sehat dan lezat setiap hari.</p>
                </div>
                </div>

                <div class="col-md-6">
                <div class="feature-item">
                    <div class="icon">
                    <i class="bi bi-phone"></i>
                    </div>
                    <h4>Pemesanan Mudah</h4>
                    <p>Pesan langsung dari web kapan saja sebelum jam istirahat.</p>
                </div>
                </div>

                <div class="col-md-6">
                <div class="feature-item">
                    <div class="icon">
                    <i class="bi bi-bell"></i>
                    </div>
                    <h4>Notifikasi Siap Ambil</h4>
                    <p>Dapatkan pemberitahuan otomatis saat makanan sudah siap.</p>
                </div>
                </div>

                <div class="col-md-6">
                <div class="feature-item">
                    <div class="icon">
                    <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>Higienis & Aman</h4>
                    <p>Proses pengemasan makanan dilakukan sesuai standar kebersihan.</p>
                </div>
                </div>
            </div>

            <div class="cta-button">
                <a href="#menu" class="btn btn-primary">Lihat Menu Hari Ini</a>
            </div>
            </div>
        </div>
        </div>

    </div>
    </section>
    <!-- /Tentang Section -->

    @php
        use Illuminate\Support\Carbon;
        use App\Models\Menu;

        $menus = Menu::whereDate('available_date', Carbon::today())->get();
    @endphp

    
    <!-- Menu Hari Ini Section -->
    <section id="menu" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Menu Hari Ini</h2>
            <div><span>Cek</span> <span class="description-title">Pilihan Makanan</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @foreach ($menus as $menu)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 * $loop->iteration }}">
                        <div class="service-card">
                            <div class="icon-box">
                                <i class="bi bi-egg-fried"></i>
                            </div>
                            <h3>{{ $menu->name }}</h3>
                            <p>{{ $menu->description }}</p>
                            <ul class="service-features">
                                <li><i class="bi bi-check-circle"></i> Tersedia tanggal: {{ \Carbon\Carbon::parse($menu->available_date)->format('d M Y') }}</li>
                                <li><i class="bi bi-check-circle"></i> Harga: Rp {{ number_format($menu->price, 0, ',', '.') }}</li>
                                <li><i class="bi bi-check-circle"></i> Porsi sesuai standar</li>
                            </ul>
                            <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#orderModal" onclick="setMenuId({{ $menu->id }})">
                                Order Sekarang <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- /Menu Hari Ini Section -->



    
 <!-- Modal Pesan Menu -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('orders.store') }}">
      @csrf
      <input type="hidden" name="menu_id" id="menuIdInput">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalLabel">Pesan Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" name="quantity" required>
          </div>
          <div class="mb-3">
            <label for="notes" class="form-label">Catatan (opsional)</label>
            <textarea class="form-control" name="notes" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
        </div>
      </div>
    </form>
  </div>
</div>



  </main>