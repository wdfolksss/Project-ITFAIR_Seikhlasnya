<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home User</title>
        @include('navbar')
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
<body class="overflow-x-hidden bg-whi te text-black dark:bg-black dark:text-white">
    <section id="myskill" class="w-full bg-[#ffffff] bg-gradient-to-b from-transparent to-[#e9f4f7] py-[1rem] px-[2rem] sm:py-[2rem] sm:px-[1rem] md:py-[2rem] md:px-6 lg:py-[5rem] lg:px-[30px] xl:py-[8rem] xl:px-[50px] ">
  <div class="container mx-auto px-4 flex flex-col gap-[50px] xl:gap-[50px]">
    
    <!-- Judul & Deskripsi -->
    <div data-aos="fade-up" class="w-full flex flex-col gap-4">
      <h2 class="text-[#000000] text-start font-semibold text-[28px] md:text-4xl xl:text-[80px] xl:leading-[6rem]">
        <strong data-aos="fade-right" class="[background:linear-gradient(transparent_40%,#2899f5_40%)] px-1">My Skills</strong><br>
        Tools & Tech Stack
      </h2>
      <p class="text-[#000000b3] text-start text-[12px] sm:text-[12px] md:text-[12px] lg:text-base xl:text-[20px] md:leading-[18px] lg:leading-[24px] xl:leading-[2rem] leading-relaxed">
        Passionate about building responsive, user-friendly, and <br>
        visually appealing websites using modern frontend technologies.
      </p>
    </div>

    <!-- Grid Skills -->
    <div data-aos="fade-up" class="grid grid-cols-1 md:grid-cols-6 gap-5 xl:gap-[60px]">
      <!-- React -->
      <a href="https://wordpress.org/" class="no-underline">
        <div data-aos="fade-up" class="text-center text-black py-10 xl:py-[8rem] 
              transition duration-300 ease-in-out">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/98/WordPress_blue_logo.svg" 
          alt="WordPress Logo" 
          class="mx-auto h-24 w-24 mb-4" />
        <h3 class="mt-3 text-xl font-semibold">WordPress</h3>
        </div>
      </a>
      <!-- Laravel -->
       <a href="https://laravel.com/" class="no-underline">
        <div data-aos="fade-up" class="text-center text-black py-10 xl:py-[8rem] 
              transition duration-300 ease-in-out">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" 
         alt="Laravel Logo" 
         class="mx-auto h-24 w-24 mb-4" />
         <h3 class="mt-3 text-xl font-semibold">Laravel</h3>
        </div>
      </a>
      <!-- Tailwind -->
      <a href="https://tailwindcss.com/" class="no-underline">
        <div data-aos="fade-up" class="text-center text-black py-10 xl:py-[8rem] 
              transition duration-300 ease-in-out">
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" 
         alt="Tailwind Logo" 
         class="mx-auto h-24 w-24 mb-4" />
         <h3 class="mt-3 text-xl font-semibold">Tailwind CSS</h3>
        </div>
      </a>
      <!-- JavaScript -->
    <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" class="no-underline">
      <div data-aos="fade-up" 
          class="text-center text-black py-10 xl:py-[8rem] 
                  transition duration-300 ease-in-out">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6a/JavaScript-logo.png" 
            alt="JavaScript Logo" 
            class="mx-auto h-24 w-24 mb-4" />
        <h3 class="mt-3 text-xl font-semibold">JavaScript</h3>
      </div>
    </a>

    <!-- Python -->
    <a href="https://www.python.org/" class="no-underline">
      <div data-aos="fade-up" 
          class="text-center text-black py-10 xl:py-[8rem] 
                  transition duration-300 ease-in-out">
        <img src="python.png"  
            alt="Python Logo" 
            class="mx-auto h-24 w-24 mb-4" />
        <h3 class="mt-3 text-xl font-semibold">Python</h3>
      </div>
    </a>

    <!-- Adobe Lightroom -->
    <a href="https://www.adobe.com/products/photoshop-lightroom.html" class="no-underline">
      <div data-aos="fade-up" 
          class="text-center text-black py-10 xl:py-[8rem] 
                  transition duration-300 ease-in-out">
        <img src="lr.png" 
            alt="Adobe Lightroom Logo" 
            class="mx-auto h-24 w-24 mb-4" />
        <h3 class="mt-3 text-xl font-semibold">Lightroom</h3>
      </div>
    </a>
  </div>
</section>
</body>
</html>