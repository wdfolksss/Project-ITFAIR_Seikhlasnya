<!DOCTYPE html>
<html>
<head>
    <title>Kelawar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    a,
    h1,
    h2,
    h3,
    p,
    span {
      @apply font-instrument !important
    }

    /* Dropdown Mobile */
    #menuButton .rotate-45 {
      transform: rotate(45deg);
    }

    #menuButton .rotate--45 {
      transform: rotate(-45deg);
    }

    #menuButton.open #line1 {
      transform: rotate(-45deg) translateY(12px);
    }

    #menuButton.open #line2 {
      opacity: 0;
    }

    #menuButton.open #line3 {
      transform: rotate(45deg) translateY(-12px);
    }

    #dropdownMenu {
      position: fixed;
      top: 60px;
      transition: 0.5s ease;
      transform: translatex(100%);
      visibility: hidden;
    }

    #menuButton.open~#dropdownMenu {
      transform: translatex(0);
      transition: 0.5 ease;
      visibility: visible;
    }

    #home {
      scroll-margin-top: 100px;
    }

    #beranda {
      scroll-margin-top: 100px;
    }
    #petaInfrastruktur {
      scroll-margin-top: 100px;
    }

    #laporanPublik {
      scroll-margin-top: 100px;
    }

    button {
      @apply font-plus-jakarta !important
    }

    .bg-active {
      background-color: #90CB92 !important;
    }

    /* .active {
      color: black;
      font-weight: bolder;
    } */

    .card-content {
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    nav ul li a:hover,
    nav ul li a.active {
      color: black;
      font-weight: bold;
    }

      .nav-link {
      position: relative;
      transition: .3s;
  }


  .nav-link::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -6px;
      width: 0;
      height: 2px;
      background: #081f85;
      transition: .3s;
  }


  /* Hover */
  .nav-link:hover::after {
      width: 100%;
  }


  /* Menu aktif tetap hijau */
  .nav-link.active {
      color: #081f85;
      font-weight: 700;
  }


  .nav-link.active::after {
      width: 100%;
  }
    
    html {
      scroll-behavior: smooth;
    }

    @keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(200px);
        -webkit-transform: translateY(200px);
        -moz-transform: translateY(200px);
        -ms-transform: translateY(200px);
        -o-transform: translateY(200px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }
</style>
<body>
    <header class="w-full p-4 sticky top-0 z-50 bg-white font-montserrat backdrop-blur-md">
    <div class="container mx-auto flex items-center justify-between px-[10px] sm:px-[10px] md:px-[30px] lg:px-[30px] xl:px-[12px]  ">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('img/bridge.svg') }}" alt="Logo" class="w-[38px] h-[38px] sm:w-[30px] sm:h-[35px] md:w-[45px] md:h-[50px] lg:w-[63px] lg:h-[58px] xl:w-[63px] xl:h-[48px] object-contain">
        <span class="text-[15px] sm:text-[15px] md:text-[18px] lg:text-[20px] xl:text-[20px] text-[#212124] font-montserrat font-semibold">Kelawar</span>
      </div>

      <!-- Dekstop Navbar  -->
      <nav class="navbar-menu hidden sm:flex">
            <ul class="flex items-center gap-10 font-medium">
                <li><a href="{{ route('homeuser') }}"
              class="nav-link relative text-black text-md font-medium transition duration-300 hover:text-[#081f85] after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-0 after:bg-[#081f85] after:transition-all hover:after:w-full {{ request()->routeIs('homeuser') ? 'active' : '' }}">
              Beranda</a>
          </li>
          {{-- <li><a href="#petaInfrastruktur"
              class="nav-link relative text-black text-md font-medium transition duration-300 hover:text-[#081f85] after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-0 after:bg-[#081f85] after:transition-all hover:after:w-full">
              Peta Infrastruktur</a>
            </li> --}}
          <li><a href="{{ route('laporanPublik') }}"
              class="nav-link relative text-black text-md font-medium transition duration-300 hover:text-[#081f85] after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-0 after:bg-[#081f85] after:transition-all hover:after:w-full {{ request()->routeIs('laporanPublik') ? 'active' : '' }}">
              Laporan Publik</a>
          </li>
          <li><a href="#tentangKami"
              class="nav-link relative text-black text-md font-medium transition duration-300 hover:text-[#081f85] after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-0 after:bg-[#081f85] after:transition-all hover:after:w-full">
             Tentang Kami</a>
          </li>
        </ul>
      </nav>
      <div class="sm:hidden">
        <!-- Button dropdown -->
        <button id="menuButton" class="relative w-6 h-4 focus:outline-none">
          <div id="line1" class="absolute w-full h-[3px] bg-black rounded transition-all duration-300 top-0"></div>
          <div id="line2" class="absolute w-full h-[3px] bg-black rounded transition-all duration-300 top-2"></div>
          <div id="line3" class="absolute w-full h-[3px] bg-black rounded transition-all duration-300 top-4"></div>
          <div id="line3" class="absolute w-full h-[3px] bg-black rounded transition-all duration-300 top-4"></div>
        </button>

        <!--Mobile Menu -->
        <ul id="dropdownMenu" data-aos="fade-right" class="hidden flex flex-col absolute gap-6 right-0 z-10 w-full h-[100vh] pb-36 mt-auto bg-[#ffffff] shadow-md">
          <li><a href="{{ route('homeuser') }}" class="block px-5 py-2 text-[#070707] mt-4 text-sm leading-normal hover:font-semibold hover:text-black duration-300">
              <div class="w-full h-[0.5px] bg-[#000000]">
              </div>
            </a>
          <li><a href="{{ route('laporanPublik') }}" class="block px-5 py-2 text-[#070707] text-sm leading-normal hover:font-semibold hover:text-black duration-300">
            Laporan Publik
              <div class="w-full h-[0.5px] bg-[#000000]">
              </div>
            </a>
          </li>
          <li><a href="#tentangKami" class="block px-5 py-2 text-[#070707] text-sm leading-normal hover:font-semibold hover:text-black duration-300">Tebtang Kami
              <div class="w-full h-[0.5px] bg-[#000000]">
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <script type="module" src="/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    // dropdown
    const menuButton = document.getElementById("menuButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    if (dropdownMenu) {
        const dropdownLinks = dropdownMenu.querySelectorAll("a");

        window.addEventListener("load", () => {
            dropdownMenu.classList.remove("hidden");
        });

        dropdownLinks.forEach(link => {
            link.addEventListener("click", () => {
                menuButton.classList.remove("open");
            });
        });
    }

    const navLinks = document.querySelectorAll('nav ul li a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function () {

            navLinks.forEach(item => {
                item.classList.remove('active');
            });

            this.classList.add('active');
        });
    });

if (menuButton) {
    menuButton.addEventListener("click", () => {
        menuButton.classList.toggle("open");
    });
}

document.querySelectorAll("nav ul li a").forEach(link => {
    link.addEventListener("click", function () {
        document.querySelectorAll("nav ul li a").forEach(item => {
            item.classList.remove("active");
        });

        this.classList.add("active");
    });
});
  </script>

  <!-- aos -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: false,
    });
  </script>
</body>
</html>