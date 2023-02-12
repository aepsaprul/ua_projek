<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Utak Atik</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
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

  {{-- notifikasi --}}
  <div id="notifikasi" class="fixed z-30 w-1/4 right-0 bottom-10 shadow-2xl transition-all delay-150 duration-700 hidden">
    <div class="w-full bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-l-full relative" role="alert">
      <strong class="font-bold">Sukses!</strong>
      <span class="block sm:inline">Data berhasil diperbaharui.</span>
      <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <i class="fa fa-check"></i>
      </span>
    </div>
  </div>

  <script>
    function afPagination(tampilData) {
      const paginationNumbers = document.getElementById("pagination-numbers");
      const paginatedList = document.getElementById("paginated-list");
      const listItems = paginatedList.querySelectorAll("tbody tr");

      const paginationLimit = tampilData;
      const pageCount = Math.ceil(listItems.length / paginationLimit);
      let currentPage = 1;

      const appendPageNumber = (index) => {
        const pageNumber = document.createElement("button");
        pageNumber.className = "pagination-number px-3 m-0.5 border border-slate-600";
        pageNumber.innerHTML = index;
        pageNumber.setAttribute("page-index", index);
        pageNumber.setAttribute("aria-label", "Page " + index);

        paginationNumbers.appendChild(pageNumber);
      };

      const getPaginationNumbers = () => {
        for (let i = 1; i <= pageCount; i++) {
          appendPageNumber(i);
        }
      };

      const handleActivePageNumber = () => {
        document.querySelectorAll(".pagination-number").forEach((button) => {
          button.classList.remove("active", "bg-emerald-400");
          const pageIndex = Number(button.getAttribute("page-index"));
          if (pageIndex == currentPage) {
            button.classList.add("active", "bg-emerald-400");
          }
        });
      };

      const setCurrentPage = (pageNum) => {
        currentPage = pageNum;
        handleActivePageNumber();

        const prevRange = (pageNum - 1) * paginationLimit;
        const currRange = pageNum * paginationLimit;

        listItems.forEach((item, index) => {
          item.classList.add("hidden");
          if (index >= prevRange && index < currRange) {
            item.classList.remove("hidden");
          }
        });
      };

      loadPage()
      function loadPage() {
        getPaginationNumbers();
        setCurrentPage(1);

        document.querySelectorAll(".pagination-number").forEach((button) => {
          const pageIndex = Number(button.getAttribute("page-index"));

          if (pageIndex) {
            button.addEventListener("click", () => {
              setCurrentPage(pageIndex);
            });
          }
        });
      }

      const btn_page = document.getElementById('pagination-numbers').onclick = function() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      };
    }
  </script>
  @yield('script')
</body>
</html>