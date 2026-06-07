<!DOCTYPE html>
<html>
<head>
    <title>Sukabumi OpenBudget</title>
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
    #about {
      scroll-margin-top: 100px;
    }
    #project {
      scroll-margin-top: 100px;
    }

    #myskill {
      scroll-margin-top: 100px;
    }

    button {
      @apply font-plus-jakarta !important
    }

    .bg-active {
      background-color: #90CB92 !important;
    }

    .active {
      color: black;
      font-weight: bolder;
    }

    .card-content {
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    nav ul li a:hover,
    nav ul li a.active {
      color: black;
      font-weight: bold;
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
    <header class="w-full p-4 sticky top-0 z-50 bg-[#C4E1E6]">
    <div class="container mx-auto flex items-center justify-between px-[10px] sm:px-[10px] md:px-[30px] lg:px-[30px] xl:px-[12px]  ">
      <div class="flex items-center space-x-3">
        <img src="code.svg" alt="Logo" class="w-[38px] h-[38px] sm:w-[30px] sm:h-[35px] md:w-[45px] md:h-[50px] lg:w-[63px] lg:h-[58px] xl:w-[63px] xl:h-[48px] object-contain">
        <span class="text-[15px] sm:text-[15px] md:text-[18px] lg:text-[25px] xl:text-[25px] text-black font-medium">Sukabumi-OpenBudget</span>
      </div>

      <!-- Dekstop Navbar  -->
      <nav class="navbar-menu hidden sm:flex">
        <ul class="flex font-medium gap-[20px] sm:gap-[55px] md:gap-[40px] lg:gap-[63px] xl:gap-[73px]">
          <li><a href="{{ route('homeuser') }}"
              class="text-black text-[10px] sm:text-[12px] md:text-[14px] lg:text-[15px] xl:text-[20px]">Home</a>
          </li>
          <li><a href="#about"
              class="text-black text-[10px] sm:text-[12px] md:text-[14px] lg:text-[15px] xl:text-[20px]">About</a>
            </li>
          <li><a href="#myskill"
              class="text-black text-[10px] sm:text-[12px] md:text-[14px] lg:text-[15px] xl:text-[20px]">My Skill</a>
          </li>
          <li><a href="#project"
              class="text-black text-[10px] sm:text-[12px] md:text-[14px] lg:text-[15px] xl:text-[20px]">Project</a>
          </li>
          <!-- <li>
            <button onclick="document.documentElement.classList.toggle('dark')">Toggle Dark Mode</button>
          </li> -->
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
        <ul id="dropdownMenu" data-aos="fade-right" class="hidden flex flex-col absolute gap-6 right-0 z-10 w-full h-[100vh] pb-36 mt-auto bg-[#C4E1E6] shadow-md">
          <li><a href="#home" class="block px-5 py-2 text-[#070707] mt-4 text-sm leading-normal hover:font-semibold hover:text-black duration-300">Home
              <div class="w-full h-[0.5px] bg-[#000000]">
              </div>
            </a>
          </li>
          <li><a href="#about" class="block px-5 py-2 text-[#070707] text-sm leading-normal hover:font-semibold hover:text-black duration-300">About
              <div class="w-full h-[0.5px] bg-[#000000]">
              </div>
            </a>
          </li>
          <li><a href="#myskill" class="block px-5 py-2 text-[#070707] text-sm leading-normal hover:font-semibold hover:text-black duration-300">My Skill
              <div class="w-full h-[0.5px] bg-[#000000]">
              </div>
            </a>
          </li>
          <li><a href="#project" class="block px-5 py-2 text-[#070707] text-sm leading-normal hover:font-semibold hover:text-black duration-300">Project
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

    // img
    function changeMainImage(imageName, cardElement) {
      let mainContent = document.querySelectorAll("#mainImage");
      mainContent.forEach(item => {
        if (item.classList.contains(imageName)) {
          mainContent.forEach(element => {
            element.classList.remove('imageActive');
          });
          item.classList.add('imageActive');
        }
      })

      document.querySelectorAll(".card-content").forEach(card => {
        card.classList.remove("bg-active");
      });
      cardElement.querySelector(".card-content").classList.add("bg-active");
    }

    // dropdown
    const menuButton = document.getElementById("menuButton");
    const dropdownMenu = document.getElementById("dropdownMenu");
    const dropdownLinks = dropdownMenu.querySelectorAll("a");

    window.addEventListener("load", () => {
      setTimeout(() => {
        dropdownMenu.classList.remove("hidden");
      }, 0);
    });

    menuButton.addEventListener("click", () => {
      menuButton.classList.toggle("open");
    });

    dropdownLinks.forEach(link => {
      link.addEventListener("click", () => {
        menuButton.classList.remove("open");
      });
    });

    // Cek apakah menu item bisa diklik
    document.querySelectorAll("nav ul li a").forEach(navItem => {
      navItem.addEventListener("click", function (event) {
        event.preventDefault();
        console.log("Navbar item clicked:", this.textContent);
        const targetSection = document.querySelector(this.getAttribute("href"));
        targetSection.scrollIntoView({ behavior: "smooth" });

        document.querySelectorAll("nav ul li a").forEach(link => {
          link.classList.remove("active");
        });
        this.classList.add("active");
      });
    });

    // Navbar 1 
    document.querySelectorAll("nav ul li a").forEach(navItem => {
      navItem.addEventListener("click", function (event) {
        event.preventDefault();

        const targetSection = document.querySelector(this.getAttribute("href"));
        targetSection.scrollIntoView({ behavior: "smooth" });

        document.querySelectorAll("nav ul li a").forEach(link => {
          link.classList.remove("active");
        });

        this.classList.add("active");

        if (this.getAttribute('href') === '#product') {
          document.querySelector('a[href="#all"]').classList.add('active');
        }
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