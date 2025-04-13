<!DOCTYPE html>
<html class="h-full bg-[#F09057]" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Manejemen Kost | {{ $title }}</title>
</head>

<body class="h-full">
    <div class="flex h-screen flex-col justify-center items-center">
        <!-- Login Form -->
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-lg bg-white p-8 rounded-xl shadow-xl">
            <h1 class="text-4xl font-semibold text-[#000000] mb-10">Sign In</h1>
            <!-- Session Alert -->
            @if (session()->has('register_success'))
                <div id="register_alert" class="absolute top-10 right-0 p-4 mb-4 font-semibold text-sm max-w-sm bg-[#6B5B95] text-white rounded-s-2xl flex items-center" role="alert">
                    {{ session('register_success') }}
                    <button type="button" class="ms-3 -mx-1.5 -my-1.5 text-white rounded-full hover:bg-white hover:text-[#6B5B95] p-1.5 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#register_alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                    </button>
                </div>
            @endif
            @if (session()->has('login_error'))
                <div id="login_alert" class="absolute top-10 right-0 p-4 mb-4 font-semibold text-sm max-w-sm bg-[#6B5B95] text-white rounded-s-2xl flex items-center" role="alert">
                    {{ session('login_error') }}
                    <button type="button" class="ms-3 -mx-1.5 -my-1.5 text-white rounded-full hover:bg-white hover:text-[#6B5B95] p-1.5 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#login_alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                    </button>
                </div>
            @endif
            
            <!-- Form -->
            <form class="space-y-6" action="/login" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-xl font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autofocus required autocomplete="email" value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror block w-full rounded-md bg-[#ffffff] px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623] sm:text-sm">
                    </div>
                </div>
                @error('email')
                <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                    {{ $message }}
                </div>
                @enderror

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xl font-medium text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-gray-900 hover:text--[#F5A623]">Forgot password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" required
                            class="block w-full rounded-md bg-[#ffffff] px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623] sm:text-sm">
                    </div>
                </div>
                @error('password')
                <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                    {{ $message }}
                </div>
                @enderror

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-[#F0801C] px-3 py-1.5 text-lg font-semibold text-white shadow hover:bg-[#F5A623] focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623]">
                        Sign in
                    </button>
                </div>
            </form>
        </div>

        <small class="block text-center mt-3 text-white">Not Registered? <a href="/register" class="font-semibold text-gray-900 hover:text--[#F5A623]">Register Now!</a></small>
    </div>
</body>

</html>
