@if (Route::has('login'))
    <div class="button hidden fixed top-0 right-0 px-6 py-4 sm:block" style="z-index: 99">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="text-sm text-gray-100 dark:text-white">
                    <button
                        type="button"
                        data-mdb-ripple="true"
                        data-mdb-ripple-color="light"
                        class="inline-block px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        {{__('Dashboard')}}
                    </button>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500">
                    <button
                        type="button"
                        data-mdb-ripple="true"
                        data-mdb-ripple-color="light"
                        class="inline-block px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        {{__('Log in')}}
                    </button>
                </a>
            @endauth
    </div>
@endif
