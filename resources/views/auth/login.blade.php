<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-6">
        <div class="bg-white shadow-lg rounded-lg max-w-md w-full p-8 transform transition-all duration-500 ease-in-out hover:scale-105">
            <!-- Logo -->
            <div class="text-center mb-6 animate-fade-in">
                <a href="/" class="text-4xl font-bold text-indigo-600 hover:text-indigo-700 transition duration-300">Momento</a>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4 animate-fade-in-up">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="block w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" 
                        placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="password" type="password" name="password" required
                        class="block w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                        placeholder="Enter your password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" 
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                               name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                           class="text-sm text-indigo-600 hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Buttons -->
                <div>
                    <button type="submit" 
                            class="w-full px-4 py-2 text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-1">
                        {{ __('Log in') }}
                    </button>
                </div>

                <div class="text-center">
                    <span class="text-sm text-gray-600">{{ __('Don’t have an account?') }}</span>
                    <a href="{{ route('register') }}" 
                       class="ml-2 text-sm font-medium text-indigo-600 hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                        {{ __('Register here') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Animations */
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-in-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-in-out;
        }
    </style>
</x-guest-layout>
