<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    @include('navbar')
    <!-- AI PRIORITY ANALYSIS -->
<section class="px-5 py-8 sm:px-8 lg:px-12 bg-gray-50 font-montserrat">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                🧠 AI Priority Analysis
            </h1>

            <p class="text-gray-500 mt-1">
                Road maintenance recommendations based on AI analysis.
            </p>
        </div>

        <button
            class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">
            Export Report
        </button>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-blue-50">

            <tr>

                <th class="text-left p-4">Rank</th>
                <th class="text-left">Road</th>
                <th class="text-left">District</th>
                <th class="text-left">Reports</th>
                <th class="text-left">Risk</th>
                <th class="text-left">AI Score</th>
                <th class="text-left">Action</th>

            </tr>

            </thead>

            <tbody>

            @foreach([
                ['🥇','Jalan Raya Cibadak','Cibadak',127,'High',90],
                ['🥈','Jalan Cisaat','Cisaat',94,'High',88],
                ['🥉','Jalan Parungkuda','Parungkuda',72,'Medium',81],
                ['4','Jalan Sukaraja','Sukaraja',56,'Medium',74],
                ['5','Jalan Warudoyong','Warudoyong',42,'Low',63],
            ] as $road)

            <tr class="border-t hover:bg-gray-50">

                <td class="p-4">{{ $road[0] }}</td>

                <td class="font-semibold">{{ $road[1] }}</td>

                <td>{{ $road[2] }}</td>

                <td>{{ $road[3] }}</td>

                <td>

                    <span class="px-3 py-1 rounded-full text-xs
                        {{ $road[4]=='High' ? 'bg-red-100 text-red-600' :
                           ($road[4]=='Medium' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-600') }}">

                        {{ $road[4] }}

                    </span>

                </td>

                <td>

                    <div class="flex items-center gap-3">

                        <div class="w-24 h-2 bg-gray-200 rounded-full">

                            <div
                                class="bg-blue-600 h-2 rounded-full"
                                style="width:{{ $road[5] }}%">
                            </div>

                        </div>

                        {{ $road[5] }}%

                    </div>

                </td>

                <td>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">

                        View

                    </button>

                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</section>
@include('footer')
</body>
</html>