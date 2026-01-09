<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mavuno | System Portal</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                blue: '#1e3a8a',  /* Royal Blue */
                                dark: '#1f2937',  /* Charcoal */
                                tea: '#16a34a',   /* Tea Leaf Green */
                            }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="antialiased bg-gray-50 text-slate-600">

        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-2">
                        <div class="bg-brand-tea text-white p-1.5 rounded-lg">
                            <i class="fa-solid fa-leaf text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold text-brand-blue tracking-tight">Mavuno</span>
                    </div>

                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-brand-dark hover:text-brand-blue transition">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="hidden md:block text-sm font-medium text-slate-500 hover:text-brand-blue transition">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-brand-blue hover:bg-blue-800 text-white text-sm font-medium rounded-lg shadow-sm transition-all hover:shadow-md">
                                        Get Started
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative overflow-hidden bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-20 px-4 sm:px-6 lg:px-8">
                    <main class="mt-10 mx-auto max-w-7xl sm:mt-12 md:mt-16 lg:mt-20 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-brand-blue text-xs font-semibold uppercase tracking-wide mb-4">
                                <span class="w-2 h-2 rounded-full bg-brand-tea"></span>
                                System Operational
                            </div>
                            <h1 class="text-4xl tracking-tight font-extrabold text-brand-dark sm:text-5xl md:text-6xl">
                                <span class="block xl:inline">Modern management for</span>
                                <span class="block text-brand-blue">Tea Factories.</span>
                            </h1>
                            <p class="mt-3 text-base text-slate-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Streamline your workforce, track green leaf production in real-time, and automate payroll. Mavuno brings clarity to your factory's operations.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start gap-3">
                                <div class="rounded-md shadow">
                                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-brand-blue hover:bg-blue-900 md:py-4 md:text-lg transition-all">
                                        Access Portal
                                    </a>
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-brand-blue bg-white hover:bg-gray-50 md:py-4 md:text-lg transition-all">
                                        View Documentation
                                    </a>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-50 flex items-center justify-center">
                <div class="relative w-full h-64 sm:h-72 md:h-96 lg:h-full flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100">
                    <div class="absolute w-96 h-96 bg-brand-tea/10 rounded-full blur-3xl -top-10 -right-10"></div>
                    <div class="absolute w-96 h-96 bg-brand-blue/10 rounded-full blur-3xl bottom-0 left-0"></div>
                    
                    <div class="relative bg-white p-6 rounded-xl shadow-xl w-80 border border-gray-100 transform -rotate-3 hover:rotate-0 transition duration-500">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gray-200"></div>
                            <div>
                                <div class="h-3 w-32 bg-gray-200 rounded"></div>
                                <div class="h-2 w-20 bg-gray-100 rounded mt-1"></div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="h-2 w-full bg-gray-100 rounded"></div>
                            <div class="h-2 w-5/6 bg-gray-100 rounded"></div>
                            <div class="h-2 w-4/6 bg-gray-100 rounded"></div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <div class="h-8 w-20 bg-brand-blue rounded-md"></div>
                            <div class="h-8 w-20 bg-gray-100 rounded-md"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-base text-brand-tea font-semibold tracking-wide uppercase">System Modules</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-brand-dark sm:text-4xl">
                        Everything you need to run operations
                    </p>
                </div>

                <div class="mt-12">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        
                        <div class="pt-6">
                            <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-sm hover:shadow-md transition border border-gray-100 h-full">
                                <div class="-mt-6">
                                    <div class="inline-flex items-center justify-center p-3 bg-brand-blue rounded-md shadow-lg">
                                        <i class="fa-solid fa-users text-white text-xl"></i>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-brand-dark tracking-tight">Human Resources</h3>
                                    <p class="mt-5 text-base text-gray-500">
                                        Manage employee profiles, shift schedules, and casual laborer contracts in one secure database.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-sm hover:shadow-md transition border border-gray-100 h-full">
                                <div class="-mt-6">
                                    <div class="inline-flex items-center justify-center p-3 bg-brand-tea rounded-md shadow-lg">
                                        <i class="fa-solid fa-scale-balanced text-white text-xl"></i>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-brand-dark tracking-tight">Production & Weighing</h3>
                                    <p class="mt-5 text-base text-gray-500">
                                        Record green leaf weight intake directly from the field and track factory processing output.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-sm hover:shadow-md transition border border-gray-100 h-full">
                                <div class="-mt-6">
                                    <div class="inline-flex items-center justify-center p-3 bg-slate-700 rounded-md shadow-lg">
                                        <i class="fa-solid fa-file-invoice-dollar text-white text-xl"></i>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-brand-dark tracking-tight">Payroll & Finance</h3>
                                    <p class="mt-5 text-base text-gray-500">
                                        Automate payouts via M-Pesa B2C integration and generate statutory compliance reports.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-400">
                    &copy; {{ date('Y') }} Mavuno Systems. All rights reserved.
                </p>
            </div>
        </footer>

    </body>
</html>