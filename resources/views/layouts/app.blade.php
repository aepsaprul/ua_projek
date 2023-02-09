<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Utak Atik</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">

  @vite('resources/css/app.css')
</head>
<body>
  <div class="flex">
    <div class="w-72 min-h-screen bg-slate-100 border-r border-slate-200 relative">
      <div class="border-b">
        <div class="border border-emerald-400 rounded-sm m-3 flex items-center">
          <img src="{{ asset('assets/logo_ua.png') }}" alt="logo" class="w-10 p-2 mr-3">          
          <span class="uppercase font-semibold">Utak Atik</span>
        </div>
      </div>
      <div class="m-3">
        <a href="{{ route('dashboard') }}">
          <div class="p-2 my-2 {{ request()->is(['dashboard', 'dashboard/*']) ? 'bg-emerald-500 text-white' : 'bg-emerald-200' }}">
            <i class="fa fa-home w-6"></i> Dashboard
          </div>
        </a>
        <a href="{{ route('transaksi') }}">
          <div class="p-2 my-2 {{ request()->is(['transaksi', 'transaksi/*']) ? 'bg-emerald-500 text-white' : 'bg-emerald-200' }}">
            <i class="fa fa-pencil-alt w-6"></i> Transaksi
          </div>
        </a>
      </div>
      <div class="w-full h-10 bottom-0 bg-slate-300 absolute flex justify-between items-center">
        <div class="font-bold ml-3 capitalize">
          {{ Auth::user()->name }}
        </div>
        <div class="mr-3">
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:font-bold"><i class="fa fa-sign-out text-xl text-slate-500"></i></a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
          </form>
        </div>
      </div>
    </div>
    <div class="w-full min-h-screen">
      <div class="m-5">
        @yield('content')
      </div>
    </div>
  </div>
</body>
</html>