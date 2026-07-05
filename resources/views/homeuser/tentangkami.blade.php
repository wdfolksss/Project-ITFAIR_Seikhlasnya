<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tentang Kami</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
    @include('navbar')
    
<section class="font-montserrat py-20 px-6 bg-[#ecf5ee]">

    <div class="text-center mb-16 max-w-2xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight leading-tight">
            Empowering People. Inspiring Real Change.
        </h1>
        <p class="text-gray-600 mt-4 text-base font-medium">
            Every initiative is designed with communities, not just for them.
        </p>
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">

        <div class="bg-white rounded-[2rem] p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition duration-300">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold text-gray-900 leading-snug">Frontend Developer</h2>
                </div>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">
                    Responsible for building and designing the user interface of the system.
                </p>
            </div>
            <div class="overflow-hidden rounded-2xl h-52">
                <img src="{{ asset('img/wada.jpg') }}" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="bg-[#092b52f6] rounded-[2rem] p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition duration-300">
            <div class="overflow-hidden rounded-2xl h-64 mb-8">
                <img src="{{ asset('img/paus.jpeg') }}" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="flex justify-between items-end">
                    <div>
                        <h2 class="text-xl font-bold text-gray-200 leading-snug">Backend Developer</h2>
                        <p class="text-xs text-gray-300 mt-2 leading-relaxed">
                            Handles database management and application logic development.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition duration-300">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold text-gray-900 leading-snug">UI/UX Designer</h2>
                </div>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">
                    Designs user experiences to make the system more intuitive and user-friendly.
                </p>
            </div>
            <div class="overflow-hidden rounded-2xl h-52">
                <img src="{{ asset('img/ucup.jpeg') }}" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>
    @include('footer')
</body>
</html>