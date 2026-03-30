<!DOCTYPE html>
<html lang="en" class="scroll-smooth" x-data="{ dark: false, filter: 'All', menuOpen: false }" :class="{ 'dark': dark }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Soth Pich Panha — Full Stack Developer. Building scalable modern web apps." />
    <title>Soth Pich Panha — Portfolio</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js for minimal interactivity --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Google Fonts: Editorial aesthetic --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet" />

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        serif:  ['DM Serif Display', 'Georgia', 'serif'],
                        sans:   ['DM Sans', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        accent: {
                            DEFAULT: '#0066FF',
                            dark:    '#3385FF',
                        },
                    },
                    animation: {
                        'fade-up':   'fadeUp 0.6s ease forwards',
                        'fade-in':   'fadeIn 0.5s ease forwards',
                        'shimmer':   'shimmer 1.5s infinite',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%':   { opacity: 0, transform: 'translateY(24px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%':   { opacity: 0 },
                            '100%': { opacity: 1 },
                        },
                        shimmer: {
                            '0%':   { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        },
                    },
                }
            }
        }
    </script>

    <style>
        /* Base font */
        body { font-family: 'DM Sans', system-ui, sans-serif; }
        h1, h2, .font-display { font-family: 'DM Serif Display', Georgia, serif; }

        /* Noise texture overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* Smooth transitions */
        *, *::before, *::after {
            transition-property: background-color, border-color, color, box-shadow;
            transition-duration: 200ms;
            transition-timing-function: ease;
        }
        a, button { transition-duration: 150ms; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
        .dark ::-webkit-scrollbar-thumb { background: #374151; }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #0066FF 0%, #6B7FFF 50%, #A855F7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Card hover lift */
        .card-hover {
            transition: transform 200ms ease, box-shadow 200ms ease !important;
        }
        .card-hover:hover {
            transform: translateY(-4px);
        }

        /* Skill badge */
        .skill-badge {
            transition: transform 150ms ease, box-shadow 150ms ease !important;
        }
        .skill-badge:hover {
            transform: scale(1.05);
        }

        /* Staggered animation delays */
        .delay-100 { animation-delay: 100ms; opacity: 0; }
        .delay-200 { animation-delay: 200ms; opacity: 0; }
        .delay-300 { animation-delay: 300ms; opacity: 0; }
        .delay-400 { animation-delay: 400ms; opacity: 0; }
        .delay-500 { animation-delay: 500ms; opacity: 0; }

        /* Nav blur */
        .nav-blur {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        /* Underline link */
        .link-underline {
            position: relative;
        }
        .link-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: currentColor;
            transition: width 200ms ease;
        }
        .link-underline:hover::after { width: 100%; }

        /* Hero grid decoration */
        .hero-grid {
            background-image:
                linear-gradient(rgba(0,102,255,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,102,255,0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .dark .hero-grid {
            background-image:
                linear-gradient(rgba(0,102,255,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,102,255,0.08) 1px, transparent 1px);
        }

        /* Language dot */
        .lang-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    </style>
</head>

<body class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 relative z-10">

    {{-- ────────────── NAVBAR ────────────── --}}
    <header class="fixed top-0 left-0 right-0 z-50 nav-blur bg-white/80 dark:bg-gray-950/80 border-b border-gray-100 dark:border-gray-800">
        <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

            {{-- Logo --}}
            <a href="#hero" class="font-serif text-xl text-gray-900 dark:text-white tracking-tight">
                zenocoder<span class="text-accent">.</span>
            </a>

            {{-- Desktop links --}}
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600 dark:text-gray-400">
                <a href="#about"    class="link-underline hover:text-gray-900 dark:hover:text-white">About</a>
                <a href="#projects" class="link-underline hover:text-gray-900 dark:hover:text-white">Projects</a>
                <a href="#skills"   class="link-underline hover:text-gray-900 dark:hover:text-white">Skills</a>
                <a href="#contact"  class="link-underline hover:text-gray-900 dark:hover:text-white">Contact</a>
            </div>

            {{-- Right controls --}}
            <div class="flex items-center gap-3">
                {{-- Dark mode toggle --}}
                <button
                    @click="dark = !dark"
                    class="w-9 h-9 rounded-full flex items-center justify-center border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:border-accent hover:text-accent dark:hover:border-accent-dark dark:hover:text-accent-dark"
                    :aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'"
                >
                    <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                {{-- CTA --}}
                <a href="#contact" class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-medium hover:bg-accent dark:hover:bg-accent-dark dark:hover:text-white">
                    Hire Me
                </a>

                {{-- Mobile menu btn --}}
                <button @click="menuOpen = !menuOpen" class="md:hidden w-9 h-9 flex items-center justify-center text-gray-600 dark:text-gray-300">
                    <svg x-show="!menuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="menuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </nav>

        {{-- Mobile menu --}}
        <div x-show="menuOpen" x-transition class="md:hidden border-t border-gray-100 dark:border-gray-800 bg-white/95 dark:bg-gray-950/95 px-6 py-4 flex flex-col gap-4 text-sm font-medium text-gray-600 dark:text-gray-400">
            <a @click="menuOpen=false" href="#about"    class="hover:text-gray-900 dark:hover:text-white">About</a>
            <a @click="menuOpen=false" href="#projects" class="hover:text-gray-900 dark:hover:text-white">Projects</a>
            <a @click="menuOpen=false" href="#skills"   class="hover:text-gray-900 dark:hover:text-white">Skills</a>
            <a @click="menuOpen=false" href="#contact"  class="hover:text-gray-900 dark:hover:text-white">Contact</a>
        </div>
    </header>

    <main>

        {{-- ────────────── HERO ────────────── --}}
        <section id="hero" class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden hero-grid pt-16">

            {{-- Decorative blobs --}}
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500/10 dark:bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-1/3 right-1/4 w-80 h-80 bg-purple-500/10 dark:bg-purple-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">

                {{-- Badge --}}
                <div class="animate-fade-up inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 text-xs font-medium text-gray-500 dark:text-gray-400 mb-8">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                    Available for freelance & full-time roles
                </div>

                {{-- Name --}}
                <h1 class="animate-fade-up delay-100 font-serif text-5xl sm:text-7xl md:text-8xl text-gray-900 dark:text-white leading-[0.95] tracking-tight mb-6">
                    Soth<br/>
                    <span class="italic">Pich Panha</span>
                </h1>

                {{-- Title --}}
                <p class="animate-fade-up delay-200 text-lg sm:text-xl font-light text-gray-500 dark:text-gray-400 mb-4 tracking-wide uppercase">
                    Full Stack Developer
                </p>

                {{-- Tagline --}}
                <p class="animate-fade-up delay-300 text-base sm:text-lg text-gray-600 dark:text-gray-300 max-w-xl mx-auto mb-10 leading-relaxed">
                    Building <span class="gradient-text font-medium">scalable modern web apps</span> with clean architecture and pixel-perfect UIs.
                </p>

                {{-- CTA buttons --}}
                <div class="animate-fade-up delay-400 flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="#projects"
                       class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium hover:bg-accent dark:hover:bg-accent-dark dark:hover:text-white text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                        View Projects
                    </a>
                    <a href="#contact"
                       class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium hover:border-accent hover:text-accent dark:hover:border-accent-dark dark:hover:text-accent-dark text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Contact Me
                    </a>
                </div>

                {{-- Stats --}}
                <div class="animate-fade-up delay-500 mt-16 grid grid-cols-3 gap-6 max-w-sm mx-auto text-center">
                    <div>
                        <p class="font-serif text-3xl text-gray-900 dark:text-white">{{ count($repos) }}+</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Repositories</p>
                    </div>
                    <div class="border-x border-gray-100 dark:border-gray-800">
                        <p class="font-serif text-3xl text-gray-900 dark:text-white">3+</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Years Exp.</p>
                    </div>
                    <div>
                        <p class="font-serif text-3xl text-gray-900 dark:text-white">{{ count($languages) }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Languages</p>
                    </div>
                </div>
            </div>

            {{-- Scroll indicator --}}
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-400 dark:text-gray-600">
                <span class="text-xs tracking-widest uppercase">Scroll</span>
                <svg class="w-4 h-4 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </section>

        {{-- ────────────── ABOUT ────────────── --}}
        <section id="about" class="py-28 bg-gray-50 dark:bg-gray-900/50">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-16 items-center">

                    {{-- Text --}}
                    <div>
                        <p class="text-xs font-medium tracking-widest uppercase text-accent dark:text-accent-dark mb-4">About</p>
                        <h2 class="font-serif text-4xl md:text-5xl text-gray-900 dark:text-white leading-tight mb-6">
                            Crafting digital<br/><span class="italic">experiences</span> that scale
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                            I'm a Full Stack Developer based in Cambodia with a passion for building clean, performant web applications.
                            I specialize in backend systems and love the challenge of making complex problems simple and elegant.
                        </p>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-8">
                            My stack is production-hardened — from RESTful APIs in Laravel and NestJS to containerized deployments with Docker.
                            I care deeply about code quality, developer experience, and shipping things that actually work.
                        </p>

                        <div class="flex flex-wrap gap-2">
                            @foreach(['Laravel', 'NestJS', 'Vue.js', 'Docker', 'MySQL', 'PostgreSQL', 'Redis', 'Git'] as $tech)
                            <span class="skill-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 cursor-default">
                                {{ $tech }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Card --}}
                    <div class="relative">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-serif text-lg">SP</div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white text-sm">Soth Pich Panha</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Full Stack Developer</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                @foreach([
                                    ['Backend',  'Laravel, NestJS, PHP, Node.js',      'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300'],
                                    ['Frontend', 'Vue.js, Tailwind CSS, Alpine.js',    'bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300'],
                                    ['DevOps',   'Docker, GitHub Actions, Linux',       'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300'],
                                    ['Database', 'MySQL, PostgreSQL, Redis',            'bg-orange-100 dark:bg-orange-900/40 text-orange-700 dark:text-orange-300'],
                                ] as [$label, $value, $cls])
                                <div class="flex items-start gap-3">
                                    <span class="inline-block px-2 py-0.5 rounded text-xs font-medium {{ $cls }} min-w-[72px] text-center flex-shrink-0">{{ $label }}</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $value }}</span>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center gap-4 text-xs text-gray-500 dark:text-gray-500">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Phnom Penh, Cambodia
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                    Open to work
                                </span>
                            </div>
                        </div>

                        {{-- Decorative element --}}
                        <div class="absolute -bottom-4 -right-4 w-24 h-24 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl -z-10"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ────────────── PROJECTS ────────────── --}}
        <section id="projects" class="py-28">
            <div class="max-w-6xl mx-auto px-6">

                {{-- Header --}}
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
                    <div>
                        <p class="text-xs font-medium tracking-widest uppercase text-accent dark:text-accent-dark mb-4">Projects</p>
                        <h2 class="font-serif text-4xl md:text-5xl text-gray-900 dark:text-white leading-tight">
                            GitHub<br/><span class="italic">Repositories</span>
                        </h2>
                    </div>

                    {{-- Language filter --}}
                    <div class="flex flex-wrap gap-2">
                        <button
                            @click="filter = 'All'"
                            :class="filter === 'All'
                                ? 'bg-gray-900 dark:bg-white text-white dark:text-gray-900 border-transparent'
                                : 'bg-transparent border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:border-gray-400 dark:hover:border-gray-500'"
                            class="px-3 py-1.5 rounded-full text-xs font-medium border transition-all"
                        >
                            All
                        </button>
                        @foreach($languages as $lang)
                        <button
                            @click="filter = '{{ $lang }}'"
                            :class="filter === '{{ $lang }}'
                                ? 'bg-gray-900 dark:bg-white text-white dark:text-gray-900 border-transparent'
                                : 'bg-transparent border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:border-gray-400 dark:hover:border-gray-500'"
                            class="px-3 py-1.5 rounded-full text-xs font-medium border transition-all"
                        >
                            {{ $lang }}
                        </button>
                        @endforeach
                    </div>
                </div>

                {{-- Empty state --}}
                @if(empty($repos))
                <div class="text-center py-20 text-gray-400 dark:text-gray-600">
                    <svg class="w-12 h-12 mx-auto mb-4 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-sm">Unable to load repositories. Please try again later.</p>
                </div>
                @else

                {{-- Repo grid --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @php
                        $langColors = [
                            'PHP'        => '#6366f1',
                            'JavaScript' => '#f59e0b',
                            'TypeScript' => '#3b82f6',
                            'Python'     => '#10b981',
                            'Vue'        => '#06b6d4',
                            'CSS'        => '#ec4899',
                            'HTML'       => '#f97316',
                            'Shell'      => '#84cc16',
                            'Go'         => '#0ea5e9',
                            'Rust'       => '#b45309',
                            'Unknown'    => '#6b7280',
                        ];
                    @endphp

                    @foreach($repos as $repo)
                    @php
                        $color = $langColors[$repo['language']] ?? '#6b7280';
                        $langSlug = str_replace([' ', '.', '#'], '-', strtolower($repo['language']));
                    @endphp
                    <div
                        x-show="filter === 'All' || filter === '{{ $repo['language'] }}'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="card-hover group relative bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-6 flex flex-col gap-4 shadow-sm hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600"
                    >
                        {{-- Top: icon + stars --}}
                        <div class="flex items-start justify-between">
                            <div class="w-9 h-9 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                </svg>
                            </div>
                            @if($repo['stars'] > 0)
                            <span class="flex items-center gap-1 text-xs text-amber-500 dark:text-amber-400 font-medium">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                                {{ $repo['stars'] }}
                            </span>
                            @endif
                        </div>

                        {{-- Name + description --}}
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900 dark:text-white text-sm mb-1.5 group-hover:text-accent dark:group-hover:text-accent-dark truncate">
                                {{ $repo['name'] }}
                            </h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed line-clamp-2">
                                {{ $repo['description'] }}
                            </p>
                        </div>

                        {{-- Footer: language + link --}}
                        <div class="flex items-center justify-between pt-2 border-t border-gray-50 dark:border-gray-800">
                            <div class="flex items-center gap-2">
                                <span class="lang-dot" style="background-color: {{ $color }}"></span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $repo['language'] }}</span>
                            </div>
                            <a
                                href="{{ $repo['url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-accent dark:hover:text-accent-dark"
                            >
                                View
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- GitHub link --}}
                <div class="mt-10 text-center">
                    <a href="https://github.com/SothPichPanha" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-accent dark:hover:text-accent-dark link-underline">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                        </svg>
                        See all repositories on GitHub
                    </a>
                </div>

            </div>
        </section>

        {{-- ────────────── SKILLS ────────────── --}}
        <section id="skills" class="py-28 bg-gray-50 dark:bg-gray-900/50">
            <div class="max-w-6xl mx-auto px-6">

                <div class="mb-12">
                    <p class="text-xs font-medium tracking-widest uppercase text-accent dark:text-accent-dark mb-4">Skills</p>
                    <h2 class="font-serif text-4xl md:text-5xl text-gray-900 dark:text-white leading-tight">
                        Tools &amp; <span class="italic">Technologies</span>
                    </h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    @php
                    $skillGroups = [
                        [
                            'label' => 'Backend',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />',
                            'color' => 'blue',
                            'items' => ['PHP 8.x', 'Laravel', 'NestJS', 'Node.js', 'REST APIs', 'GraphQL'],
                        ],
                        [
                            'label' => 'Frontend',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
                            'color' => 'purple',
                            'items' => ['Vue.js', 'Tailwind CSS', 'Alpine.js', 'JavaScript', 'TypeScript', 'Inertia.js'],
                        ],
                        [
                            'label' => 'DevOps',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />',
                            'color' => 'green',
                            'items' => ['Docker', 'Docker Compose', 'GitHub Actions', 'Linux', 'Nginx', 'CI/CD'],
                        ],
                        [
                            'label' => 'Database',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />',
                            'color' => 'orange',
                            'items' => ['MySQL', 'PostgreSQL', 'Redis', 'SQLite', 'Eloquent ORM', 'Query Builder'],
                        ],
                    ];
                    $colorMap = [
                        'blue'   => ['bg' => 'bg-blue-50 dark:bg-blue-900/20',   'text' => 'text-blue-600 dark:text-blue-400',   'badge' => 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300'],
                        'purple' => ['bg' => 'bg-purple-50 dark:bg-purple-900/20','text' => 'text-purple-600 dark:text-purple-400','badge' => 'bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300'],
                        'green'  => ['bg' => 'bg-green-50 dark:bg-green-900/20',  'text' => 'text-green-600 dark:text-green-400',  'badge' => 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300'],
                        'orange' => ['bg' => 'bg-orange-50 dark:bg-orange-900/20','text' => 'text-orange-600 dark:text-orange-400','badge' => 'bg-orange-100 dark:bg-orange-900/40 text-orange-700 dark:text-orange-300'],
                    ];
                    @endphp

                    @foreach($skillGroups as $group)
                    @php $c = $colorMap[$group['color']]; @endphp
                    <div class="card-hover bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-6 shadow-sm">
                        <div class="w-10 h-10 rounded-xl {{ $c['bg'] }} {{ $c['text'] }} flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                {!! $group['icon'] !!}
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900 dark:text-white text-sm mb-3">{{ $group['label'] }}</h3>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($group['items'] as $item)
                            <span class="skill-badge inline-block px-2 py-0.5 rounded text-xs {{ $c['badge'] }}">{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ────────────── CONTACT ────────────── --}}
        <section id="contact" class="py-28">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-16 items-start">

                    {{-- Left --}}
                    <div>
                        <p class="text-xs font-medium tracking-widest uppercase text-accent dark:text-accent-dark mb-4">Contact</p>
                        <h2 class="font-serif text-4xl md:text-5xl text-gray-900 dark:text-white leading-tight mb-6">
                            Let's build<br/><span class="italic">something great</span>
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-8">
                            Have a project in mind or looking for a developer to join your team? I'd love to hear from you.
                            Reach out via email or connect on social media.
                        </p>

                        <div class="space-y-4">
                            <a href="mailto:pichpanha@example.com"
                               class="card-hover flex items-center gap-4 p-4 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-accent dark:hover:border-accent-dark group bg-white dark:bg-gray-900">
                                <div class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-800 flex items-center justify-center text-gray-400 group-hover:text-accent dark:group-hover:text-accent-dark">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-500">Email</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">pichpanha@example.com</p>
                                </div>
                            </a>

                            <a href="https://github.com/SothPichPanha" target="_blank" rel="noopener noreferrer"
                               class="card-hover flex items-center gap-4 p-4 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-accent dark:hover:border-accent-dark group bg-white dark:bg-gray-900">
                                <div class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-800 flex items-center justify-center text-gray-400 group-hover:text-accent dark:group-hover:text-accent-dark">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-500">GitHub</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">@SothPichPanha</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- Right: contact form (UI only) --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-8 shadow-sm"
                         x-data="{ sent: false, name: '', email: '', message: '' }">

                        <div x-show="!sent" x-transition>
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Name</label>
                                    <input
                                        x-model="name"
                                        type="text"
                                        placeholder="Your name"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-gray-900 dark:text-white text-sm placeholder-gray-400 dark:placeholder-gray-600 focus:outline-none focus:border-accent dark:focus:border-accent-dark"
                                    />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Email</label>
                                    <input
                                        x-model="email"
                                        type="email"
                                        placeholder="you@example.com"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-gray-900 dark:text-white text-sm placeholder-gray-400 dark:placeholder-gray-600 focus:outline-none focus:border-accent dark:focus:border-accent-dark"
                                    />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Message</label>
                                    <textarea
                                        x-model="message"
                                        rows="4"
                                        placeholder="Tell me about your project..."
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-gray-900 dark:text-white text-sm placeholder-gray-400 dark:placeholder-gray-600 focus:outline-none focus:border-accent dark:focus:border-accent-dark resize-none"
                                    ></textarea>
                                </div>
                                <button
                                    @click="if(name && email && message) { sent = true }"
                                    class="w-full py-3.5 rounded-xl bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-medium hover:bg-accent dark:hover:bg-accent-dark dark:hover:text-white transition-colors"
                                >
                                    Send Message
                                </button>
                            </div>
                        </div>

                        <div x-show="sent" x-transition class="text-center py-12">
                            <div class="w-14 h-14 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-7 h-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-1">Message sent!</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">I'll get back to you as soon as possible.</p>
                            <button @click="sent=false; name=''; email=''; message=''" class="mt-4 text-xs text-accent dark:text-accent-dark hover:underline">Send another</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- ────────────── FOOTER ────────────── --}}
    <footer class="border-t border-gray-100 dark:border-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-gray-400 dark:text-gray-600">
                &copy; {{ date('Y') }} Soth Pich Panha. Built with Laravel &amp; Tailwind CSS.
            </p>
            <div class="flex items-center gap-1 text-xs text-gray-400 dark:text-gray-600">
                <span>Cached</span>
                <span class="w-1.5 h-1.5 rounded-full bg-green-400 mx-1"></span>
                <span>GitHub data refreshes every 15 min</span>
            </div>
        </div>
    </footer>

</body>
</html>