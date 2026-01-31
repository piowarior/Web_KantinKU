<main class="d-flex align-items-center justify-content-center vh-100 bg-light">
  <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
    <h2 class="text-center mb-4">Registrasi Pengguna</h2>

    @if (session()->has('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
    @endif

    <form wire:submit.prevent="submit">
      <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input wire:model="name" type="text" class="form-control" id="name" required>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input wire:model="email" type="email" class="form-control" id="email" required>
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
      </div>


      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input wire:model="password" type="password" class="form-control" id="password" required>
        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
        <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Daftar</button>

      <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </form>
  </div>
</main>
