<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">

  @vite('resources/css/app.css')
</head>
<body>
  <div class="w-full min-h-screen flex justify-center items-center">
    <div>
      <div class="flex justify-center mb-3">
        <img src="{{ asset('assets/logo_ua.png') }}" alt="logo" class="w-44">
      </div>
      <div class="border p-8 shadow-md shadow-emerald-600">
        <h1 class="text-center uppercase font-bold text-2xl text-emerald-600">login</h1>
        <form action="{{ route('login.auth') }}" method="POST">
          @csrf
          <div class="my-5">
            <div>
              <input type="email" name="email" id="email" class="w-72 border-2 p-3 border-emerald-300 @error('email') is-invalid @enderror" placeholder="Email" required>
            </div>
            <em class="text-rose-600">@error('email') {{ $message }} @enderror</em>
          </div>
          <div class="my-5 relative">
            <input type="password" name="password" id="password" class="w-72 border-2 p-3 border-emerald-300" placeholder="Password" required>
            <i class="fa fa-eye-slash absolute right-3 top-4 text-emerald-600 cursor-pointer lihat-password"></i>
            <i class="fa fa-eye absolute right-3 top-4 text-emerald-600 cursor-pointer hidden tutup-password"></i>
          </div>
          <div class="my-5 flex justify-between">
            <label for="remember" class="flex items-center">
              <input type="checkbox" name="remember" id="remember" class="w-5 h-5 mr-3"> <span class="text-emerald-800">Ingat Saya</span>
            </label>
            <button type="submit" class="bg-emerald-600 py-3 px-8 text-white font-bold">Masuk</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    const lihatPassword = document.querySelector(".lihat-password");
    const tutupPassword = document.querySelector('.tutup-password');
    const password = document.querySelector('#password');

    lihatPassword.addEventListener('click', function () {
      password.setAttribute('type', 'text');
      this.style.display = 'none';
      tutupPassword.style.display = 'block';
    })

    tutupPassword.addEventListener('click', function () {
      password.setAttribute('type', 'password');
      this.style.display = 'none';
      lihatPassword.style.display = 'block';
    })
  </script>
</body>
</html>