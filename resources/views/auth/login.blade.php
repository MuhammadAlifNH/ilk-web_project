<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Inventaris Lab Komputer</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('/images/background.jpg') no-repeat center center fixed;
      background-size: cover;
      background-position: center top;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
  </style>
</head>
<div style="background: white; padding:20px;">
  <h2 class="text-2xl font-bold text-red-600 mb-6 text-center">Login to the Platform</h2>
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <!-- Input Email -->
      <div class="mb-4">
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" id="email" name="email" required
               class="w-full mt-1 p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400" />
      </div>
      
      <!-- Input Password -->
      <div class="mb-6">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full mt-1 p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400" />
      </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <!-- Tombol Login -->
        <button type="submit" class="w-full py-3 bg-red-500 text-white rounded-full text-lg font-semibold hover:bg-red-600">
            Login
        </button>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
    </div>  
    
    </form>
    
    <!-- Link ke halaman Register -->
    <p class="mt-4 text-center text-gray-600">
      Belum Punya Akun?  
      <a href="{{ route('register') }}" class="text-red-600 font-bold">Buat Akun</a>
    </p>
</div>
</html>