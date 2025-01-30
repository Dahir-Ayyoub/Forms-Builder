<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiZi Mark Pro - Solutions Publicitaires Innovantes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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


@if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end gap-2">
        @auth
            <a
                href="{{ url('/dashboard') }}"
                class="flex items-center gap-1.5 rounded-lg px-4 py-2 text-sm font-medium text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:ring-offset-2 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800"
            >
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                Dashboard
            </a>

            <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                @csrf
                <button
                    type="submit"
                    class="flex items-center gap-1.5 rounded-lg px-4 py-2 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:text-red-400 dark:hover:bg-red-800/30 dark:focus:ring-offset-gray-800"
                >
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Logout
                </button>
            </form>
        @else
            <!-- Existing login/register links with matching style -->
            <a
                href="{{ route('login') }}"
                class="rounded-lg px-4 py-2 text-sm font-medium text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:ring-offset-2 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800"
            >
                Log in
            </a>

            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="rounded-lg bg-[#FF2D20] px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-[#E6261C] focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                >
                    Get Started
                </a>
            @endif
        @endauth
    </nav>
@endif
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-green-600">HiZi Mark Pro</a>
            <div class="hidden md:flex space-x-6">
                <a href="#services" class="text-gray-700 hover:text-green-600 transition duration-300">Services</a>
                <a href="#about" class="text-gray-700 hover:text-green-600 transition duration-300">À Propos</a>
                <a href="#solutions" class="text-gray-700 hover:text-green-600 transition duration-300">Solutions</a>
                <a href="#contact" class="text-gray-700 hover:text-green-600 transition duration-300">Contact</a>
            </div>
            <button class="md:hidden focus:outline-none">
                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Dynamic Image Slider -->
    <div class="slider-container">
        <div class="slide active"
            style="background-image: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80'); background-size: cover; background-position: center;">
            <div class="slide-content">
                <h1 class="text-5xl font-bold mb-4">Bienvenue chez HiZi Mark Pro</h1>
                <p class="text-xl mb-8">Des solutions publicitaires innovantes pour votre entreprise</p>
                <button
                    class="bg-green-500 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                    Commencer
                </button>
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
    <section id="services" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in">Nos Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="service-card bg-white p-6 rounded-lg shadow-md text-center animate-fade-in">
                    <div class="bg-green-100 rounded-full p-4 inline-block mb-4">
                        <i class="fas fa-ad text-4xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Publicité</h3>
                    <p class="text-gray-600">
                        Des solutions publicitaires innovantes pour vous démarquer de la concurrence et atteindre
                        efficacement votre audience cible.
                    </p>
                </div>
                <div class="service-card bg-white p-6 rounded-lg shadow-md text-center animate-fade-in">
                    <div class="bg-green-100 rounded-full p-4 inline-block mb-4">
                        <i class="fas fa-users text-4xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Relation Client</h3>
                    <p class="text-gray-600">
                        Restez à l'écoute de vos clients pour améliorer constamment vos services et fidéliser votre
                        clientèle.
                    </p>
                </div>
                <div class="service-card bg-white p-6 rounded-lg shadow-md text-center animate-fade-in">
                    <div class="bg-green-100 rounded-full p-4 inline-block mb-4">
                        <i class="fas fa-search text-4xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Prospection</h3>
                    <p class="text-gray-600">
                        Identifiez et attirez de nouveaux clients potentiels pour développer votre activité et élargir
                        votre part de marché.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Form -->
    <section class="py-20 gradient-bg text-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8 animate-fade-in">Abonnez-vous à Notre Newsletter</h2>
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
                    <div class="text-6xl font-bold text-green-500 mb-2" id="clientsCount">0</div>
                    <div class="text-xl text-gray-600">Clients Satisfaits</div>
                </div>
                <div class="animate-fade-in">
                    <div class="text-6xl font-bold text-green-500 mb-2" id="citiesCount">0</div>
                    <div class="text-xl text-gray-600">Villes Couvertes</div>
                </div>
                <div class="animate-fade-in">
                    <div class="text-6xl font-bold text-green-500 mb-2" id="yearsCount">0</div>
                    <div class="text-xl text-gray-600">Années d'Expérience</div>
                </div>
            </div>
        </div>
    </section>

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
                        <div class="mb-4">
                            <input type="text" placeholder="Votre Nom"
                                class="w-full px-4 py-3 rounded-lg border text-gray-800 border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div class="mb-4">
                            <input type="email" placeholder="Votre E-mail"
                                class="w-full px-4 py-3 rounded-lg border text-gray-800 border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div class="mb-6">
                            <textarea placeholder="Votre Message" rows="4"
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
    <section id="solutions" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in">Nos Solutions Publicitaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-md animate-fade-in">
                    <h3 class="text-2xl font-bold mb-4">Sac à Pain Publicitaire</h3>
                    <p class="text-gray-600 mb-6">
                        Communiquez efficacement avec des sacs à pain personnalisés. Idéal pour les boulangeries, cette
                        solution permet d'apposer votre message publicitaire sur des sacs remis gratuitement aux
                        clients. Mesurez l'impact de votre campagne sur une zone géographique précise.
                    </p>
                    <button
                        class="w-full bg-green-500 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                        En Savoir Plus
                    </button>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md animate-fade-in">
                    <h3 class="text-2xl font-bold mb-4">Campagnes d'Influence</h3>
                    <p class="text-gray-600 mb-6">
                        Bénéficiez de notre réseau de centaines d'influenceurs et de nos outils informatiques développés
                        en interne. Idéal pour les entreprises souhaitant lancer rapidement des campagnes d'influence de
                        qualité, ou pour celles qui n'ont pas encore internalisé ces processus dans leur stratégie
                        marketing.
                    </p>
                    <button
                        class="w-full bg-green-500 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105">
                        Découvrir
                    </button>
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
                    <p class="text-gray-400">Téléphone: +33 1 23 45 67 89</p>
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
