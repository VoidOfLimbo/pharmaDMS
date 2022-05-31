<x-guest-layout>
    <section class="h-full gradient-form bg-gray-200 md:h-screen">
        <div class="py-12 px-6 h-full w-full">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="xl:w-10/12">
                    <div class="block bg-white shadow-lg rounded-lg">
                        <div class="lg:flex lg:flex-no-wrap g-0">
                            <div class="lg:w-6/12 px-4 md:px-0">
                                <div class="lg:px-12 py-10 md:mx-6">
                                    <div class="text-center md:mt-10">
                                        <x-logo.authentication-card-logo />
                                        <x-jet-validation-errors class="mb-4" />

                                        @if (session('status'))
                                            <div class="mb-4 font-medium text-sm text-green-600">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <h4 class="text-xl font-semibold my-12 pb-1">Staff and Partners Login</h4>
                                    </div>

                                    {{-- The login form --}}
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <p class="mb-4">Please login to your account</p>

                                        {{-- Email input --}}
                                        <div class="mb-4">
                                            <x-jet-input
                                                class="form-control block mt-1 w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                type="email" id="email" name="email" :value="old('email')"
                                                placeholder="{{ __('Email') }}" required autofocus />
                                        </div>

                                        {{-- Password input --}}
                                        <div class="mb-4">
                                            <x-jet-input
                                                class="form-control block mt-1 w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                type="password" id="password" name="password"
                                                placeholder="{{ __('Password') }}" required
                                                autocomplete="current-password" />
                                        </div>

                                        {{-- Remember me checkbox --}}
                                        <div class="block mb-4">
                                            <label for="remember_me" class="flex items-center">
                                                <x-jet-checkbox id="remember_me" name="remember" />
                                                <span
                                                    class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>

                                        {{-- Login button --}}
                                        <div class="text-center pt-1 mb-6 pb-1">
                                            <x-jet-button
                                                class="inline-block px-6 py-2.5 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:shadow-indigo-500
                                                    hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out"
                                                data-mdb-ripple="true" data-mdb-ripple-color="light" style="
                                                background: linear-gradient(
                                                    to left,
                                                    #590761,
                                                    #8f36d8,
                                                    #e452e4,
                                                    #b44593
                                                    );
                                                    ">
                                                {{ __('Log in') }}
                                            </x-jet-button>

                                        </div>
                                        <p class="mb-8 mr-2"> {{__('If you forgot your password or don`t have an account please')}}
                                            {{-- Link to contact admin page --}}
                                            <a class=" underline text-gray-500 text-gray-600 hover:text-gray-900"
                                                href="#!"> {{__('contact')}} </a>
                                            {{__('our admin')}}
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <div class="lg:w-6/12 flex items-center lg:rounded-r-lg rounded-b-lg lg:rounded-bl-none bg-contain lg:bg-auto bg-no-repeat bg-center"
                                style="
                                    background-image:
                                    url({{ asset('img/pharmacy_cross.png') }}) ,
                                    linear-gradient(to left, #590761, #8f36d8, #e452e4, #b44593);
                                    ">
                                <div
                                    class="text-black backdrop-blur-sm backdrop-brightness-150 bg-purple-500/25 px-4 py-6 md:p-12 md:mx-6">
                                    <h4 class="text-2xl font-bold mb-6">{{__('We are more than just a company')}}</h4>
                                    <p class="text-xl font-semibold">
                                        {{__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat.')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
