<div class="divide-y divide-gray-800">
    <nav class="flex items-center bg-black px-3 py-2 shadow-lg">
        <div class="">
            <button class="block h-8 mr-3 text-white hover:text-gray-400 focus:outline-none focus:border-transparent sm:hidden">
                <svg class="w-8 fill-current" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                </svg>
            </button>
        </div>

        <div class="h-12 w-full flex items-center">
            <a href="{{ url('/') }}" class="w-full">
                <img class="h-10" src="{{ url('/img/logo.svg') }}" alt="">
            </a>
        </div>

        <div class="flex justify-end sm:w-8/12">
            <ul class="hidden sm:flex sm:text-left text-white text-xl">
                <a href="{{ url('/login') }}">
                    <li class="cursor-pointer px-4 py-2 hover:underline">Login</li>
                </a>
            </ul>
        </div>
    </nav>

    <div class="sm:flex sm:min-h-screen">
        <aside class="bg-black sm:w-4/12 divide-y divide-dashed divide-gray-700 md:w-3/12 lg:w-2/12">
            <ul class="hidden sm:block sm:text-left text-white">
                <a href="{{ url('/home') }}">
                    <li class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-900 text-xl">Home</li>
                </a>

                <a href="{{ url('/about') }}">
                    <li class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-900 text-xl">About</li>
                </a>

                <a href="{{ url('/contact') }}">
                    <li class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-900 text-xl">Contact</li>
                </a>
            </ul>

            <div class="pb-3 divide-y divide-gray-400 block sm:hidden">
                <ul class="text-white text-xl">
                    <a href="{{ url('/login') }}">
                        <li class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-900">Login</li>
                    </a>

                    <a href="{{ url('/about') }}">
                        <li class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-900">About</li>
                    </a>

                    <a href="{{ url('/home') }}">
                        <li class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-900">Home</li>
                    </a>

                    <a href="{{ url('/contact') }}">
                        <li class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-900">Contact</li>
                    </a>
                </ul>

                {{-- Top Navigation --}}
                <ul class="text-white text-xl">
                    <a href="{{ url('/login') }}">
                        <li class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-900">Login</li>
                    </a>
                </ul>

            </div>
        </aside>

        <main class="p-12 min-h-screen sm:w-8/12 md:w-9/12 lg:w-10/12">
            <section class="divide-y text-black ">
                <h1 class="text-3xl">{{ $title }}</h1>
                <article>
                    <div class="mt-5 text-xl">
                        {!! $content !!}
                    </div>
                </article>
            </section>
        </main>
    </div>
</div>
