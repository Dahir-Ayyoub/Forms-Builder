<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiZi Mark Pro - Solutions Publicitaires Innovantes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 100vh;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .slide-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 10;
        }

        .slider-nav {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            z-index: 10;
        }

        .slider-nav-btn {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .slider-nav-btn.active {
            background-color: white;
        }

        .animate-fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .animate-fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

<!-- Nav -->

<nav class="bg-white shadow-md fixed w-full z-50" aria-label="main navigation">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">

        {{-- <a href="#" class="text-2xl font-bold text-green-600">HiZi Mark Pro</a> --}}
        <a href="#" class="block">
            <img src="{{ asset('logo.png') }}" alt="HiZi Mark Pro Logo" class="h-8" />
        </a>

        <div class="flex justify-end items-center gap-6">
            <div class="hidden md:flex space-x-6">
                    <a href="#services">Services</a>
                    <a href="#about">À Propos</a>
                    <a href="#solutions">Solutions</a>
                    <a href="#contact">Contact</a>
            </div>

            <div class="-mx-3 flex flex-1 justify-end gap-2">
                @auth
               
                <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                    @csrf
                    <button
                        type="submit"
                        aria-label="logout"
                        class="flex items-center gap-1.5 rounded-lg px-4 py-2 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:text-red-400 dark:hover:bg-red-800/30 dark:focus:ring-offset-gray-800"
                    >
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                        Logout
                    </button>
                </form>
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-black transition-colors hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:ring-offset-2 dark:text-black dark:hover:bg-gray-800 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800"
                >
                    Log in
                </a>
                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-lg bg-[#16a34a] px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-[#E6261C] focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                    >
                        Get Started
                    </a>
                @endif
            @endauth
            </div>
        </div>
        <button class="md:hidden focus:outline-none">
            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z" />
            </svg>
        </button>
    </div>
</nav>
    
<!-- Nav -->


    <!-- Dynamic Image Slider -->
    <div class="slider-container">
        <div class="slide active"
            style="background-image: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80'); background-size: cover; background-position: center;">
            <div class="slide-content">
                <h1 class="text-5xl font-bold mb-4">Bienvenue chez HiZi Mark Pro</h1>
                <p class="text-xl mb-8">Des solutions publicitaires innovantes pour votre entreprise</p>
                <a href="{{ route('forms.index') }}"
                    class="bg-green-500 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                    Commencer
                </a>
            </div>
        </div>
        <div class="slide"
            style="background-image: url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80'); background-size: cover; background-position: center;">
            <div class="slide-content">
                <h1 class="text-5xl font-bold mb-4">Développez Votre Entreprise</h1>
                <p class="text-xl mb-8">Laissez-nous vous aider à atteindre de nouveaux sommets</p>
                <button
                    class="bg-green-500 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                    En Savoir Plus
                </button>
            </div>
        </div>
        <div class="slide"
            style="background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80'); background-size: cover; background-position: center;">
            <div class="slide-content">
                <h1 class="text-5xl font-bold mb-4">Solutions Innovantes</h1>
                <p class="text-xl mb-8">Technologie de pointe pour votre réussite</p>
                <button
                    class="bg-green-500 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                    Explorer
                </button>
            </div>
        </div>
        <div class="slider-nav"></div>
    </div>

    <!-- Service Cards -->
    <section id="services" class="bg-gray-50 py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800 animate-fade-in">
                Nos Services
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden animate-slide-up">
                    <div class="px-6 py-4 bg-gray-100 flex items-center gap-3">
                        <i class="fas fa-bullhorn text-2xl text-green-500"></i>
                        <h3 class="text-lg font-semibold text-gray-700">Publicité</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 leading-relaxed">
                            Des solutions publicitaires innovantes pour vous démarquer de la concurrence et atteindre
                            efficacement votre audience cible.
                        </p>
                    </div>
                </div>
                 <div class="bg-white rounded-lg shadow-md overflow-hidden animate-slide-up">
                    <div class="px-6 py-4 bg-gray-100 flex items-center gap-3">
                        <i class="fas fa-headset text-2xl text-green-500"></i>
                         <h3 class="text-lg font-semibold text-gray-700">Relation Client</h3>
                    </div>
                    <div class="p-6">
                         <p class="text-gray-600 leading-relaxed">
                            Restez à l'écoute de vos clients pour améliorer constamment vos services et fidéliser votre
                            clientèle.
                        </p>
                    </div>
                </div>
                  <div class="bg-white rounded-lg shadow-md overflow-hidden animate-slide-up">
                     <div class="px-6 py-4 bg-gray-100 flex items-center gap-3">
                         <i class="fas fa-search-plus text-2xl text-green-500"></i>
                          <h3 class="text-lg font-semibold text-gray-700">Prospection</h3>
                    </div>
                    <div class="p-6">
                         <p class="text-gray-600 leading-relaxed">
                           Identifiez et attirez de nouveaux clients potentiels pour développer votre activité et élargir
                            votre part de marché.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Form -->
    <section class="py-20 gradient-bg text-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8 animate-fade-in">Abonnez-vous</h2>
            <form class="max-w-md mx-auto animate-fade-in">
                <div class="flex">
                    <input type="email" placeholder="Votre adresse e-mail"
                        class="flex-grow px-4 py-3 rounded-l-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500" />
                    <button type="submit"
                        class="px-6 py-3 rounded-r-full bg-white text-green-500 font-semibold hover:bg-gray-100 transition duration-300">
                        S'abonner
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Large Numbers Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="animate-fade-in">
                    <div class="text-6xl font-bold text-green-500 mb-2 count-up" data-count="2" id="clientsCount">0</div>
                     <div class="text-xl text-gray-600">Clients Heureux</div>
                </div>
                <div class="animate-fade-in">
                    <div class="text-6xl font-bold text-green-500 mb-2 count-up" data-count="2" id="studiesCount">0</div>
                     <div class="text-xl text-gray-600">Études de Marchés</div>
                </div>
                <div class="animate-fade-in">
                    <div class="text-6xl font-bold text-green-500 mb-2 count-up" data-count="9658" id="dataCount">0</div>
                     <div class="text-xl text-gray-600">Inscription dans la DATA</div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.count-up');
    
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                let count = 0;
                 // Using a simple step to ensure it reaches the target
                const increment = Math.max(1, Math.ceil(target / 250));
                function updateCounter() {
                    count += increment;
                    if(count > target){
                       counter.textContent = target;
                        return;
                    }
                    counter.textContent = Math.round(count);
                    requestAnimationFrame(updateCounter);
                }
    
                updateCounter();
            });
        });
    </script>
    <!-- Two-column Layout -->
    <section id="about" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0 animate-fade-in">
                    <h2 class="text-4xl font-bold mb-6">La Solution HiZi Mark Pro</h2>
                    <p class="text-gray-600 mb-4">
                        Démarquez-vous en offrant une publicité innovante qui vous distingue de tous vos concurrents.
                        Montrez que vous êtes en avance sur votre temps avec HiZi Mark Pro, notre solution de street
                        marketing combinant branding et digital.
                    </p>
                    <p class="text-gray-600">
                        HiZi Mark Pro vous permet de diffuser des annonces sur les objets du quotidien, de mesurer
                        l'impact de vos campagnes, et d'analyser les interactions avec votre cible. Générez des avis,
                        évaluez votre positionnement, et prospectez directement auprès d'une population intéressée par
                        vos produits ou services.
                    </p>
                </div>
                <div class="w-full md:w-1/2 px-4 animate-fade-in">
                    <form id="contact" class="bg-white p-8 rounded-lg shadow-md">
                        <h3 class="text-2xl font-bold mb-6">Demande d'Information</h3>
                         <div class="relative mb-4">
                             <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                             </div>
                             <input type="text" placeholder="Nom"
                                class="w-full pl-10 px-4 py-3 rounded-lg border text-gray-800 border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div class="relative mb-4">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.077 1.936l-8.474 4.785a1.5 1.5 0 01-1.449 0l-8.474-4.785A2.25 2.25 0 012.25 6.993V6.75" />
                                </svg>
                             </div>
                            <input type="email" placeholder="E-mail"
                                class="w-full pl-10 px-4 py-3 rounded-lg border text-gray-800 border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div class="relative mb-4">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                 </svg>
                            </div>
                            <input type="tel" placeholder="Téléphone"
                                class="w-full pl-10 px-4 py-3 rounded-lg border text-gray-800 border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div class="relative mb-4">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-15.5l-1.1-1.1a2.25 2.25 0 00-3.182 0l-5.636 5.636C10.283 9.29 9.91 9.29 9.71 9.09L5.25 4.636m15.773 1.136a2.25 2.25 0 010 3.182l-1.1 1.1" />
                                 </svg>
    
                            </div>
                            <input type="text" placeholder="Sujet"
                                    class="w-full pl-10 px-4 py-3 rounded-lg border text-gray-800 border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                         <div class="mb-6">
                            <textarea placeholder="Message" rows="4"
                                class="w-full px-4 py-3 rounded-lg border text-gray-800 border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-green-500 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                            Envoyer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Offer Cards -->
    <section id="solutions" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16 text-gray-800 animate-fade-in">
                Nos Solutions Publicitaires
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-up">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                            Sac à Pain Publicitaire
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Communiquez efficacement avec des sacs à pain personnalisés. Idéal pour les boulangeries,
                            cette solution permet d'apposer votre message publicitaire sur des sacs remis gratuitement
                            aux clients. Mesurez l'impact de votre campagne sur une zone géographique précise.
                        </p>
                        <div class="flex justify-end">
                          <button
                                class="bg-green-500 text-white px-5 py-2 rounded-md text-sm font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                                 En Savoir Plus
                          </button>
                        </div>
                    </div>
                </div>
                 <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-up">
                    <div class="p-6">
                       <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                            Campagnes d'Influence
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                           Bénéficiez de notre réseau de centaines d'influenceurs et de nos outils informatiques
                            développés en interne. Idéal pour les entreprises souhaitant lancer rapidement des
                            campagnes d'influence de qualité, ou pour celles qui n'ont pas encore internalisé ces
                            processus dans leur stratégie marketing.
                        </p>
                         <div class="flex justify-end">
                          <button
                                class="bg-green-500 text-white px-5 py-2 rounded-md text-sm font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                                 Découvrir
                          </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Content Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in">La Solution HiZi Mark Pro en Détail</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-md animate-fade-in">
                    <h3 class="text-2xl font-bold mb-4">Analyse de Performance</h3>
                    <p class="text-gray-600 mb-6">
                        HiZi Mark Pro vous offre des outils d'analyse avancés pour mesurer l'impact de vos campagnes
                        publicitaires. Suivez en temps réel les interactions avec votre public cible et ajustez vos
                        stratégies pour maximiser votre retour sur investissement.
                    </p>
                    <ul class="list-disc list-inside text-gray-600">
                        <li>Suivi en temps réel des interactions</li>
                        <li>Analyse démographique de l'audience</li>
                        <li>Rapports détaillés sur l'engagement</li>
                    </ul>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md animate-fade-in">
                    <h3 class="text-2xl font-bold mb-4">Personnalisation Avancée</h3>
                    <p class="text-gray-600 mb-6">
                        Adaptez vos campagnes publicitaires à votre audience avec une précision inégalée. Notre
                        plateforme utilise l'intelligence artificielle pour optimiser le ciblage et le contenu de vos
                        annonces, garantissant un impact maximal.
                    </p>
                    <ul class="list-disc list-inside text-gray-600">
                        <li>Ciblage géographique précis</li>
                        <li>Personnalisation basée sur les comportements</li>
                        <li>Optimisation automatique des campagnes</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-2xl font-bold mb-4">HiZi Mark Pro</h3>
                    <p class="text-gray-400">Solutions publicitaires innovantes pour votre entreprise</p>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h4 class="text-lg font-semibold mb-4">Liens Rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#services"
                                class="text-gray-400 hover:text-white transition duration-300">Services</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition duration-300">À
                                Propos</a></li>
                        <li><a href="#solutions"
                                class="text-gray-400 hover:text-white transition duration-300">Solutions</a></li>
                        <li><a href="#contact"
                                class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h4 class="text-lg font-semibold mb-4">Nous Contacter</h4>
                    <p class="text-gray-400">Email: contact@hizimarkpro.com</p>
                    <p class="text-gray-400">Téléphone:  +212 6 62 87 11 44</p>
                </div>
                <div class="w-full md:w-1/4">
                    <h4 class="text-lg font-semibold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; 2023 HiZi Mark Pro. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Dynamic Image Slider
        const slides = document.querySelectorAll('.slide');
        const sliderNav = document.querySelector('.slider-nav');
        let currentSlide = 0;

        // Create navigation buttons
        slides.forEach((_, index) => {
            const btn = document.createElement('div');
            btn.classList.add('slider-nav-btn');
            btn.addEventListener('click', () => goToSlide(index));
            sliderNav.appendChild(btn);
        });

        const navBtns = document.querySelectorAll('.slider-nav-btn');

        function goToSlide(n) {
            slides[currentSlide].classList.remove('active');
            navBtns[currentSlide].classList.remove('active');
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            navBtns[currentSlide].classList.add('active');
        }

        function nextSlide() {
            goToSlide(currentSlide + 1);
        }

        function prevSlide() {
            goToSlide(currentSlide - 1);
        }

        // Auto-advance slides every 5 seconds
        setInterval(nextSlide, 5000);

        // Initialize first slide
        goToSlide(0);

        // Animate fade-in elements
        function animateFadeIn() {
            const fadeElements = document.querySelectorAll('.animate-fade-in');
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (elementTop < windowHeight - 100) {
                    element.classList.add('visible');
                }
            });
        }

        // Animate number counters
        function animateNumbers() {
            const numberElements = document.querySelectorAll('[id$="Count"]');
            numberElements.forEach(element => {
                const target = parseInt(element.textContent);
                const increment = target / 100;
                let current = 0;

                const updateNumber = () => {
                    if (current < target) {
                        current += increment;
                        element.textContent = Math.round(current);
                        requestAnimationFrame(updateNumber);
                    } else {
                        element.textContent = target;
                    }
                };

                updateNumber();
            });
        }

        // Initialize animations
        window.addEventListener('load', () => {
            animateFadeIn();
            animateNumbers();
        });

        window.addEventListener('scroll', animateFadeIn);

        // Initialize GSAP ScrollTrigger
        gsap.registerPlugin(ScrollTrigger);

        // Animate service cards
        gsap.utils.toArray('.service-card').forEach((card, index) => {
            gsap.from(card, {
                y: 50,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                },
                delay: index * 0.2
            });
        });

        // Animate offer cards
        gsap.utils.toArray('#solutions .animate-fade-in').forEach((card, index) => {
            gsap.from(card, {
                x: index % 2 === 0 ? -50 : 50,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            });
        });
    </script>
</body>

</html>
