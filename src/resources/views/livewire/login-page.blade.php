<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center text-primary mb-4">Login</h3>

    <form wire:submit.prevent="login">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input wire:model="email" type="email" id="email" class="form-control" required>
        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input wire:model="password" type="password" id="password" class="form-control" required>
        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>
