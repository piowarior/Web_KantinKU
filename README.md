## 📌 README.md — Sistem Pemesanan Makanan & Kasir Berbasis Web

```markdown
# 🥡 Web KantinKU

**Web KantinKU** adalah aplikasi web untuk sistem pemesanan makanan kantin sekolah (order makanan + kasir) yang dibangun menggunakan:

✔️ Laravel (backend)  
✔️ REST API untuk komunikasi antara frontend & backend  
✔️ Docker & Docker Compose untuk kontainerisasi  
✔️ MySQL sebagai database  
✔️ Nginx sebagai reverse-proxy server  

Aplikasi ini memungkinkan:

- 🧑‍🍳 Pelanggan memesan makanan secara online
- 📱 Pelanggan cek menu dan buat pesanan
- 💳 Pembayaran non-tunai
- 🍽️ Dapur menerima & mengelola pesanan
- 🧾 Kasir / admin lihat pesanan dan riwayat transaksi
- 📊 Dashboard kasir sederhana untuk pemantauan

---

## 🛠️ Fitur Utama

### 🎯 Pelanggan (User)
- Melihat daftar menu makanan
- Menambah item ke keranjang
- Checkout dan pilih metode pembayaran non-tunai
- Dapat nomor pesanan

### 🍳 Dapur / Admin
- Lihat pesanan masuk
- Tandai pesanan sebagai *diproses* / *selesai*
- Melihat detail pesanan

### 💰 Kasir
- Dashboard ringkas penjualan
- Melihat total transaksi harian
- Riwayat pesanan

---

## 🧱 Arsitektur

```

┌───────────────────────────────┐
│          Client Side          │
│  (Browser / Web Interface)   │
│  - HTML / Blade              │
│  - CSS / JavaScript          │
└───────────────┬───────────────┘
                │ HTTP Request
                │ (REST API)
┌───────────────▼───────────────┐
│        Backend Service        │
│           Laravel             │
│  - API Routes                 │
│  - Controllers                │
│  - Business Logic             │
│  - Authentication             │
└───────────────┬───────────────┘
                │ Query / ORM
┌───────────────▼───────────────┐
│           Database            │
│            MySQL              │
│  - User                       │
│  - Menu                       │
│  - Order                      │
│  - Transaction                │
└───────────────────────────────┘


````

---

## 📦 Tools & Teknologi

| Bagian | Teknologi |
|--------|-----------|
| Backend | Laravel (PHP Framework) |
| API | RESTful API (Laravel API Routes) |
| Database | MySQL |
| Dev/Env | Docker, Docker Compose |
| Server | Nginx |
| Frontend | Blade / HTML / JS |
| Version Control | Git + GitHub |

---

## 🚀 Cara Install (Development)

Pastikan sudah install:

✔ Docker  
✔ Docker Compose  
✔ Git  

Lalu:

1. **Clone repository**
   ```bash
   git clone https://github.com/piowarior/Web_KantinKU.git
   cd Web_KantinKU
````

2. **Salin file environment**

   ```bash
   cp .env.example .env
   ```

3. **Sesuaikan konfigurasi .env**

   ```
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=kantinku
   DB_USERNAME=root
   DB_PASSWORD=secret
   ```

4. **Jalankan Docker Compose**

   ```bash
   docker compose up -d
   ```

5. **Install dependencies Laravel**

   ```bash
   docker compose exec app composer install
   ```

6. **Generate Laravel app key**

   ```bash
   docker compose exec app php artisan key:generate
   ```

7. **Migrasi database**

   ```bash
   docker compose exec app php artisan migrate
   ```

8. **Akses aplikasi**

   * Frontend/API: [http://localhost:8000](http://localhost:8000)

---

## 📌 Struktur Folder (umum)

```
/app
  /Http
    /Controllers
/database
  /migrations
/public
  /css
  /js
/docker
  nginx.conf
/docker-compose.yml
/routes
  api.php
  web.php
```

---

## 📝 REST API (Contoh)

| Route             | Method | Deskripsi               |
| ----------------- | ------ | ----------------------- |
| `/api/menu`       | GET    | List semua menu makanan |
| `/api/order`      | POST   | Buat pesanan baru       |
| `/api/order/{id}` | GET    | Detail pesanan          |
| `/api/payment`    | POST   | Proses pembayaran       |

*(API bisa disesuaikan di `routes/api.php`)*

---

## 💡 Catatan

* Sistem dibuat dengan arsitektur yang scalable & organized untuk mudah dikembangkan
* REST API mempermudah integrasi dengan frontend SPA ataupun mobile app
* Docker mempermudah setting development tanpa konflik dependensi

---

## 📁 Lisensi

Project ini bersifat **open-source** (MIT / free to use).


### 🎮
<p align="center">
  <img width="200px" src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExaWNsOWo3N3RpbHJ0cTl3cjE1NHg2ajhsbjlvamcwb29veTlwOXJ4aSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/11lxCeKo6cHkJy/giphy.gif">
</p>

