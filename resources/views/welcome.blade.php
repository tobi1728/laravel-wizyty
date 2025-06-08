<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center lg:justify-center min-h-screen flex-col">

        
<nav class="bg-white dark:bg-gray-900 sticky w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="./index.php" class="flex items-center">
            <img src="{{ asset('images/yourcure-logo.svg') }}" class="h-8" alt="Logo" />
        </a>
        
        <!-- Menu -->
        <ul class="flex flex-row font-medium space-x-8 text-sm">
            <li><a href="#" class="text-gray-900 dark:text-white hover:underline">Oferta</a></li>
            <li><a href="#" class="text-gray-900 dark:text-white hover:underline">Specjaliści</a></li>
            <li><a href="#" class="text-gray-900 dark:text-white hover:underline">O klinice</a></li>
            <li><a href="#" class="text-gray-900 dark:text-white hover:underline">FAQ</a></li>
            <li><a href="#" class="text-gray-900 dark:text-white hover:underline">Opinie</a></li>
            <li><a href="#" class="text-gray-900 dark:text-white hover:underline">Kontakt</a></li>
        </ul>

        <!-- Buttony -->
        <div class="flex items-center space-x-4"> 

            @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-md bg-blue-500 px-3.5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Panel główny</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md bg-green-500 px-3.5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Zaloguj się</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-md bg-blue-500 px-3.5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Zarejestruj się</a>
                        @endif
                    @endauth
            @endif
            
        </div>
    </div>
</nav>

<section>
    <div class="h-screen absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true" >
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#2096F3] to-[#fff] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-3xl py-32 sm:py-48 lg:py-56">

        <div class="text-center" >

        <h1 class="text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Poczuj najlepszą jakość opieki medycznej</h1>
        <p class="mt-8 text-pretty text-lg font-normal text-gray-500 sm:text-xl/8">
            Zapewniamy kompleksową opiekę zdrowotną dostosowaną do indywidualnych potrzeb każdego pacjenta. 
        <br/>
            Zdrowie Twoje i Twojej rodziny jest dla nas priorytetem.
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="./register.php" class="rounded-md bg-blue-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Zostań naszym pacjentem</a>
            <a href="#" class="text-sm/6 font-semibold text-gray-900">Dowiedz się więcej <span aria-hidden="true">→</span></a>
        </div>
        </div>
    </div>
    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#2096F3] to-[#fff] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
</section>

<section>
  <div class="h-auto max-w-screen-lg mx-auto p-8 border-2 bg-white border-blue-300 rounded-lg">
  <h2 class="text-2xl font-medium mb-4">Specjaliści</h2>
  <div class="grid grid-cols-4 gap-6 text-sm px-4 mx-auto py-4">
    <!-- Kolumna A -->
    <div>
      <h3 class="text-blue-600 font-bold">A</h3>
      <ul class="mt-2 space-y-1">
        <li>Alergolog</li>
        <li>Anestezjolog</li>
        <li>Angiolog</li>
        <li>Androlog</li>
      </ul>
    </div>
    <!-- Kolumna B -->
    <div>
      <h3 class="text-blue-600 font-bold">B</h3>
      <ul class="mt-2 space-y-1">
        <li>Balneolog</li>
        <li>Bioetyk</li>
        <li>Bakterolog</li>
        <li>Bariatria</li>
      </ul>
    </div>
    <!-- Kolumna C -->
    <div>
      <h3 class="text-blue-600 font-bold">C</h3>
      <ul class="mt-2 space-y-1">
        <li>Chirurg ogólny</li>
        <li>Chirurg plastyczny</li>
        <li>Chirurg dziecięcy</li>
        <li>Chirurgia klatki piersiowej</li>
      </ul>
    </div>
    <!-- Kolumna D -->
    <div>
      <h3 class="text-blue-600 font-bold">D</h3>
      <ul class="mt-2 space-y-1">
        <li>Dermatolog</li>
        <li>Diabetolog</li>
        <li>Dietetyka</li>
        <li>Diagnostyka obrazowa</li>
      </ul>
    </div>
    <!-- Kolumna G -->
    <div>
      <h3 class="text-blue-600 font-bold">G</h3>
      <ul class="mt-2 space-y-1">
        <li>Ginekolog</li>
        <li>Gastrolog</li>
        <li>Genetyk kliniczny</li>
        <li>Geriatra</li>
      </ul>
    </div>
    <!-- Kolumna K -->
    <div>
      <h3 class="text-blue-600 font-bold">K</h3>
      <ul class="mt-2 space-y-1">
        <li>Kardiolog</li>
        <li>Kardiochirurg</li>
        <li>Kliniczna farmakologia</li>
        <li>Kliniczna neurofizjologia</li>
      </ul>
    </div>
    <!-- Kolumna L -->
    <div>
      <h3 class="text-blue-600 font-bold">L</h3>
      <ul class="mt-2 space-y-1">
        <li>Laryngolog</li>
        <li>Logopedia</li>
        <li>Leczenie oparzeń</li>
        <li>Lekarz wojskowy</li>
      </ul>
    </div>
    <!-- Kolumna N -->
    <div>
      <h3 class="text-blue-600 font-bold">N</h3>
      <ul class="mt-2 space-y-1">
        <li>Neurolog</li>
        <li>Neurochirurg</li>
        <li>Neonatolog</li>
        <li>Nefrolog</li>
      </ul>
    </div>
    <!-- Kolumna O -->
    <div>
      <h3 class="text-blue-600 font-bold">O</h3>
      <ul class="mt-2 space-y-1">
        <li>Okulista</li>
        <li>Ortopeda</li>
        <li>Onkolog kliniczny</li>
        <li>Otolaryngolog</li>
      </ul>
    </div>
    <!-- Kolumna P -->
    <div>
      <h3 class="text-blue-600 font-bold">P</h3>
      <ul class="mt-2 space-y-1">
        <li>Pediatra</li>
        <li>Psychiatra</li>
        <li>Psycholog</li>
        <li>Pulmonolog</li>
      </ul>
    </div>
    <!-- Kolumna R -->
    <div>
      <h3 class="text-blue-600 font-bold">R</h3>
      <ul class="mt-2 space-y-1">
        <li>Radiolog</li>
        <li>Reumatolog</li>
        <li>Rehabilitant</li>
        <li>Radioterapeuta</li>
      </ul>
    </div>
    <!-- Kolumna S -->
    <div>
      <h3 class="text-blue-600 font-bold">S</h3>
      <ul class="mt-2 space-y-1">
        <li>Stomatolog</li>
        <li>Seksuolog</li>
        <li>Sportowa medycyna</li>
        <li>Senolog</li>
      </ul>
    </div>
  </div>
  </div>

</section>

<section >
    <div class="max-w-screen-xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 content-center h-1/2">
        <!-- Text Content -->
        <div class="flex flex-col justify-center space-y-4 ">
            <h2 class="text-base/7 font-semibold text-blue-500">O nas</h2>  
            <h2 class="mt-2 text-balance text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Witaj w naszej klinice</h2>
            <p class="mt-8 text-pretty text-lg font-normal text-gray-500 sm:text-xl/12">
                Nasza klinika to miejsce, w którym zdrowie i dobro pacjentów są na pierwszym miejscu. 
                Oferujemy szeroki zakres usług medycznych, od konsultacji po zaawansowane procedury diagnostyczne 
                i lecznicze. Nasz zespół doświadczonych lekarzy oraz specjalistów dokłada wszelkich starań, aby zapewnić 
                najwyższą jakość opieki w przyjaznym i komfortowym środowisku.
            </p>
            <a href="#" class="text-sm/12 font-semibold text-gray-900">Dowiedz się więcej <span aria-hidden="true">→</span></a>
        </div>
        <div class="content-start">
            <p class="mt-8 text-pretty text-lg font-normal text-gray-900 sm:text-xl/12">FAQ</p>
    
            <!-- Accordion Item 1 -->
            <div class="border-b border-gray-200">
                <button onclick="toggleAccordion(1)" class="w-full flex justify-between items-center py-4 text-gray-800">
                <span>Jakie usługi oferuje klinika?</span>
                <span id="icon-1" class="text-gray-800 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M11.78 9.78a.75.75 0 0 1-1.06 0L8 7.06 5.28 9.78a.75.75 0 0 1-1.06-1.06l3.25-3.25a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                </span>
                </button>
                <div id="content-1" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="pb-4 text-sm text-gray-600">
                    Oferujemy pełen zakres usług medycznych, w tym konsultacje specjalistyczne, diagnostykę obrazową i badania laboratoryjne.
                </div>
                </div>
            </div>

            <!-- Accordion Item 2 -->
            <div class="border-b border-gray-200">
            <button onclick="toggleAccordion(2)" class="w-full flex justify-between items-center py-4 text-gray-800">
                <span>Czy mogę zapisać się na wizytę online?</span>
                <span id="icon-2" class="text-gray-800 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M11.78 9.78a.75.75 0 0 1-1.06 0L8 7.06 5.28 9.78a.75.75 0 0 1-1.06-1.06l3.25-3.25a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                </svg>
                </span>
            </button>
            <div id="content-2" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="pb-4 text-sm text-gray-600">
                Tak, umożliwiamy łatwe umawianie wizyt online za pomocą naszego systemu rezerwacji.
                </div>
            </div>
            </div>

            <!-- Accordion Item 3 -->
            <div>
            <button onclick="toggleAccordion(3)" class="w-full flex justify-between items-center py-4 text-gray-800">
                <span>Jakie są godziny otwarcia kliniki?</span>
                <span id="icon-3" class="text-gray-800 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M11.78 9.78a.75.75 0 0 1-1.06 0L8 7.06 5.28 9.78a.75.75 0 0 1-1.06-1.06l3.25-3.25a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                </svg>
                </span>
            </button>
            <div id="content-3" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="pb-4 text-sm text-gray-600">
                    Klinika jest otwarta od poniedziałku do piątku w godzinach 8:00-18:00 oraz w soboty od 9:00-14:00.
                </div>
            </div>
            </div>

        </div>
    </div>
</section>

<section>
  <div class="relative isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
    <div class="mx-auto max-w-4xl text-center">
      <h2 class="text-base/7 font-semibold text-blue-500">Oferta</h2>
      <p class="mt-2 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-6xl">Wybierz plan dopasowany do Twoich potrzeb zdrowotnych</p>
    </div>
    <p class="mx-auto mt-6 text-pretty max-w-2xl  font-normal text-gray-500 sm:text-xl/8">Oferujemy elastyczne plany dostosowane do Twoich potrzeb zdrowotnych, zapewniając opiekę najwyższej jakości i dostęp do najlepszych specjalistów.</p>

    <div class="mx-auto mt-16 grid max-w-lg grid-cols-1 items-center gap-y-6 sm:mt-20 sm:gap-y-0 lg:max-w-4xl lg:grid-cols-2">
      <div class="rounded-3xl rounded-t-3xl bg-white/60 p-8 ring-1 ring-gray-900/10 sm:mx-8 sm:rounded-b-none sm:p-10 lg:mx-0 lg:rounded-bl-3xl lg:rounded-tr-none">
        <h3 id="tier-hobby" class="text-base/7 font-semibold text-blue-500">Podstawowy Plan Zdrowotny</h3>
        <p class="mt-4 flex items-baseline gap-x-2">
          <span class="text-5xl font-semibold tracking-tight text-gray-900">199 zł</span>
          <span class="text-base text-gray-500">/miesiąc</span>
        </p>
        <p class="mt-6 text-base/7 text-gray-600">The perfect plan if you&#039;re just getting started with our product.</p>
        <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
          <li class="flex gap-x-3">
            <svg class="h-6 w-5 flex-none text-blue-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
            </svg>
            3 wizyty kontrolne
          </li>
          <li class="flex gap-x-3">
            <svg class="h-6 w-5 flex-none text-blue-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
            </svg>
            Dostęp do podstawowych badań laboratoryjnych
          </li>
          <li class="flex gap-x-3">
            <svg class="h-6 w-5 flex-none text-blue-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
            </svg>
            Konsultacje online z lekarzem
          </li>
          <li class="flex gap-x-3">
            <svg class="h-6 w-5 flex-none text-blue-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
            </svg>
            Czas odpowiedzi wsparcia: 24 godziny
          </li>
        </ul>
        <a href="#" aria-describedby="tier-hobby" class="mt-8 block rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-blue-500 ring-1 ring-inset ring-blue-300 hover:ring-blue-500  hover:bg-blue-500 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:mt-10">Wybierz plan</a>
      </div>

      <div class="relative rounded-3xl bg-blue-900 p-8 shadow-2xl ring-1 ring-gray-900/10 sm:p-10">
      <img src="{{ asset('images/diamond.svg') }}" width="50px" class="mx-auto mb-2">

    <h3 id="tier-enterprise" class="text-base/7 font-semibold text-white col-span-2">Rozszerzony Plan Zdrowotny</h3>

      <p class="mt-4 flex items-baseline gap-x-2 col-span-7">
      <span class="text-5xl font-semibold tracking-tight text-white">399 zł</span>
      <span class="text-base text-white">/miesiąc</span>
      </p>
    

    <p class="mt-6 text-base/7 text-white">Dedykowana opieka zdrowotna dla całej rodziny.</p>
    <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-300 sm:mt-10">
      <li class="flex gap-x-3 text-white">
        <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
        </svg>
        Nieograniczona liczba wizyt kontrolnych
      </li>
      <li class="flex gap-x-3 text-white">
        <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
        </svg>
        Dostęp do zaawansowanych badań diagnostycznych
      </li>
      <li class="flex gap-x-3 text-white">
        <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
        </svg>
        Konsultacje online z lekarzem
      </li>
      <li class="flex gap-x-3 text-white">
        <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
        </svg>
        Dedykowany lekarz prowadzący
      </li>
      <li class="flex gap-x-3 text-white">
        <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
        </svg>
        Kompleksowe wsparcie medyczne
      </li>
      <li class="flex gap-x-3 text-white">
        <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
        </svg>
        Indywidualne podejście do pacjenta
      </li>
    </ul>
    <a href="#" aria-describedby="tier-enterprise" class="mt-8 block rounded-md bg-blue-500 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 sm:mt-10">Wybierz plan</a>
  </div>

    </div>
  </div>

</section>

<section class="max-w-screen-xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
  <!-- Text Content -->
  <div class="flex flex-col justify-center space-y-4">
  <h2 class="text-base/7 font-semibold text-blue-500">Zespół</h2>  
  <h2 class="mt-2 text-balance text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Nasi specjaliści</h2>
  <p class="mt-8 text-pretty text-small font-normal text-gray-500 sm:text-xl/12">
  
      Poznaj naszych doświadczonych lekarzy, którzy dbają o Twoje zdrowie i dobre samopoczucie.
      Zespół ekspertów składa się z wybitnych specjalistów w różnych dziedzinach medycyny, gotowych Ci pomóc.
    </p>
    <a href="#" class="text-sm/12 font-semibold text-gray-900">Dowiedz się więcej <span aria-hidden="true">→</span></a>
  </div>

  <!-- Team Members -->
  <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
  <!-- Team Member -->
  <div class="relative group">
  <img src="{{ asset('images/doctors/anna-nowicka.jpg') }}" class="rounded-lg w-64 object-cover">
  <h3 class="font-medium text-small">dr. Anna Nowicka</h3>
  <p class="text-sm">Kardiolog</p>
  </div>

  <!-- Team Member -->
  <div class="relative group">
  <img src="{{ asset('images/doctors/andrzej-krzywda.jpg') }}" class="rounded-lg w-64 object-cover">
  <h3 class="font-medium text-small">lek. Andrzej Krzywda</h3>
  <p class="text-sm">Pulmunolog</p>
  </div>

  <!-- Team Member -->
  <div class="relative group">
  <img src="{{ asset('images/doctors/lana-byrd.jpg') }}" class="rounded-lg w-64 object-cover">
  <h3 class="font-medium text-small">prof. Lana Byrd</h3>
  <p class="text-sm">Neurochirurg</p>
  </div>

  <!-- Team Member -->
  <div class="relative group">
  <img src="{{ asset('images/doctors/jan-zrodlo.jpg') }}" class="rounded-lg w-64 object-cover">
  <h3 class="font-medium text-small">dr. n. med. Jan Źródło</h3>
  <p class="text-sm">Okulista</p>
  </div>

  <!-- Team Member -->
  <div class="relative group">
  <img src="{{ asset('images/doctors/maria-zarebska.jpg') }}" class="rounded-lg w-64 object-cover">
  <h3 class="font-medium text-small">lek. Maria Zarebska</h3>
  <p class="text-sm">Pediatra</p>
  </div>

  <!-- Team Member -->
  <div class="relative group">
  <img src="{{ asset('images/doctors/jadwiga-zielen.jpg') }}" class="rounded-lg w-64 object-cover">
  <h3 class="font-medium text-small">prof. Jadwiga Zieleń</h3>
  <p class="text-sm">Laryngolog</p>
  </div>

  </div>
    
</section>

<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-12 mx-auto h-3/4 content-center">
        <div class="text-center">
        <h2 class="text-base/7 font-semibold text-blue-500">Napisz do nas</h2>
        <h2 class="mt-2 text-balance text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Skontaktuj się</h2>

            

        <p class="mt-8 text-pretty text-lg font-normal text-gray-500 sm:text-xl/12">Nasz zespół chętnie odpowie na wszystkie Twoje pytania.</p>
        </div>

        <div class="grid grid-cols-1 gap-12 mt-10 md:grid-cols-2 lg:grid-cols-3">
            <div class="flex flex-col items-center justify-center text-center">
                <span class="p-3 text-blue-500 rounded-full bg-blue-100/80 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </span>

                <h2 class="mt-4 text-lg font-medium text-gray-800 dark:text-white">Email</h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Nasz zespół pomoże Ci w każdej sprawie.</p>
                <p class="mt-2 text-blue-500 dark:text-blue-400">kontakt@yourcure.com</p>
            </div>

            <div class="flex flex-col items-center justify-center text-center">
                <span class="p-3 text-blue-500 rounded-full bg-blue-100/80 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </span>
                
                <h2 class="mt-4 text-lg font-medium text-gray-800 dark:text-white">Biura</h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Zajrzyj do jednego z naszych oddziałów</p>
                <p class="mt-2 text-blue-500 dark:text-blue-400">Kacza 12/56, 02-200 Warszawa</p>
                <p class="mt-2 text-blue-500 dark:text-blue-400">Przepiórcza 144, 15-110 Białystok</p>

            </div>
            

            <div class="flex flex-col items-center justify-center text-center">
                <span class="p-3 text-blue-500 rounded-full bg-blue-100/80 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                </span>
                
                <h2 class="mt-4 text-lg font-medium text-gray-800 dark:text-white">Infolinia</h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Pn.- Pt. 8:00 to 17:00.</p>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Sob. 8:00 to 12:00.</p>
                <p class="mt-2 text-blue-500 dark:text-blue-400">+48 550-414-222</p>
            </div>
        </div>
    </div>
</section>




        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>  

<footer class="bg-white rounded-lg  dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/yourcure-logo.svg') }}" class="h-8" alt="YourCure Logo" />
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-400  sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">O nas</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Polityka prywatności</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Regulamin</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Kontakt</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© <?php echo date("Y "); ?><a href="#" class="hover:underline">YourCure</a>. All Rights Reserved.</span>
    </div>
</footer>

<script>
    function toggleAccordion(index) {
        const content = document.getElementById(`content-${index}`);
        const icon = document.getElementById(`icon-${index}`);

        // SVG for Down icon
        const downSVG = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        `;

        // SVG for Up icon
        const upSVG = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd" d="M11.78 9.78a.75.75 0 0 1-1.06 0L8 7.06 5.28 9.78a.75.75 0 0 1-1.06-1.06l3.25-3.25a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
            </svg>
        `;

        // Toggle the content's max-height for smooth opening and closing
        if (content.style.maxHeight && content.style.maxHeight !== '0px') {
            content.style.maxHeight = '0';
            icon.innerHTML = upSVG;
        } else {
            content.style.maxHeight = content.scrollHeight + 'px';
            icon.innerHTML = downSVG;
        }
    }
</script>

</html>

