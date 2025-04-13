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
        <!-- Registration Form -->
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-lg bg-white p-8 rounded-xl shadow-xl">
            <h1 class="text-4xl font-semibold text-[#000000] mb-5">Create an Account</h1>
            
            <!-- Session Alert (if any) -->
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

            <!-- Registration Form -->
            <form class="space-y-6" action="/register" method="POST">
                @csrf
                <!-- Email address -->
                <div>
                    <label for="email" class="block text-xl font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror block w-full rounded-md bg-[#ffffff] px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623] sm:text-sm">
                    </div>
                </div>
                @error('email')
                <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                    {{ $message }}
                </div>
                @enderror

                <!-- First and Last Name -->
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="first_name" class="block text-xl font-medium text-gray-900">First name</label>
                        <input type="text" name="first_name" id="first_name" required
                            class="block w-full mt-2 px-3 py-1.5 border border-gray-300 rounded-md bg-[#ffffff] text-gray-900 focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623] sm:text-sm">
                    </div>

                    <div class="flex-1">
                        <label for="last_name" class="block text-xl font-medium text-gray-900">Last name</label>
                        <input type="text" name="last_name" id="last_name" required
                            class="block w-full mt-2 px-3 py-1.5 border border-gray-300 rounded-md bg-[#ffffff] text-gray-900 focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623] sm:text-sm">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xl font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password" required
                        class="block w-full mt-2 px-3 py-1.5 border border-gray-300 rounded-md bg-[#ffffff] text-gray-900 focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623] sm:text-sm">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xl font-medium text-gray-900">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="block w-full mt-2 px-3 py-1.5 border border-gray-300 rounded-md bg-[#ffffff] text-gray-900 focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623] sm:text-sm">
                </div>

                <!-- Sign Up Button -->
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-[#F0801C] px-3 py-1.5 text-lg font-semibold text-white shadow hover:bg-[#F5A623] focus:outline-[#F5A623] focus:ring-2 focus:ring-[#F5A623]">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>

        <small class="block text-center mt-3 text-white">Already Registered? <a href="/login" class="font-semibold text-gray-900 hover:text-[#F5A623]">Sign In!</a></small>
    </div>
</body>

</html>
