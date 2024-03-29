<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta
        http-equiv="X-UA-Compatible"
        content="ie=edge"
    >
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-800">
<div class="flex flex-col min-h-screen justify-between">
    @section('navbar')
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a
                    href="/"
                    class="flex items-center">
                    <img
                        src="../logo.png"
                        class="h-8 mr-3 rounded-lg"
                        alt="I-Bank Logo"
                    />
                    <span
                        class="self-center text-black text-2xl font-semibold whitespace-nowrap dark:text-white"
                    >
                        I-Bank
                    </span>
                </a>
                <button
                    data-collapse-toggle="navbar-default"
                    type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default"
                    aria-expanded="false"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg
                        class="w-6 h-6"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"
                        >
                        </path>
                    </svg>
                </button>

                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        @auth()
                            <li>
                                <a href="/dashboard"
                                   class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-black md:hover:text-blue-500 md:p-0 md:dark:text-white"
                                   aria-current="page">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <button id="paymentDropdownLink"
                                        data-dropdown-toggle="paymentDropdown"
                                        class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
                                >
                                    Payments
                                    <svg
                                        class="w-5 h-5 ml-1"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"
                                        >
                                        </path>
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div
                                    id="paymentDropdown"
                                    class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                                >
                                    <ul
                                        class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                        aria-labelledby="dropdownLargeButton"
                                    >
                                        <li>
                                            <a
                                                href="/payment"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-gray-100 dark:text-white"
                                            >New / local payment
                                            </a>
                                        </li>
                                </div>
                            </li>
                            <li>
                                <button
                                    id="cardDropdownLink"
                                    data-dropdown-toggle="cardDropdown"
                                    class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
                                >
                                    Cards
                                    <svg
                                        class="w-5 h-5 ml-1"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div
                                    id="cardDropdown"
                                    class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                                >
                                    <ul
                                        class="py-2 text-sm text-gray-700 dark:text-white"
                                        aria-labelledby="dropdownLargeButton"
                                    >
                                        <li>
                                            <a
                                                href="/add-card"
                                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            >
                                                Add
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                href="/cards"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            >
                                                Show
                                            </a>
                                        </li>
                                </div>
                            </li>
                            <li>
                                <button
                                    id="investDropdownLink"
                                    data-dropdown-toggle="investDropdown"
                                    class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
                                >
                                    Invest
                                    <svg
                                        class="w-5 h-5 ml-1"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div
                                    id="investDropdown"
                                    class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                                >
                                    <ul
                                        class="py-2 text-sm text-gray-700 dark:text-white"
                                        aria-labelledby="dropdownLargeButton"
                                    >
                                        <li>
                                            <a
                                                href="/customize-investment-account"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            >
                                                Create account
                                            </a>
                                        </li>

                                    @can('invest')
                                        <li>
                                            <a
                                                href="/coins"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            >
                                                Coins
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                href="/invest"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            >
                                                Balance
                                            </a>
                                        </li>
                                        @else
                                    @endcan
                                </div>
                            </li>
                            <li>
                                <a
                                    href="/settings"
                                    class="block py-2 pl-3 pr-4 text-white rounded md:bg-transparent md:text-black md:hover:text-blue-500 md:p-0 dark:text-white md:dark:text-white"
                                    aria-current="page"
                                >
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a
                                    href="/logout"
                                    class="block py-2 pl-3 pr-4 text-red bg-red-500 rounded md:bg-transparent md:text-red-500 md:hover:text-red-600 md:p-0 dark:text-red md:dark:text-red-500"
                                    aria-current="page"
                                >
                                    Logout
                                </a>
                            </li>
                        @endauth
                        @guest
                            <li>
                                <a
                                    href="/login"
                                    class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-500 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                >
                                    Login
                                </a>
                            </li>
                            <li>
                                <a
                                    href="/register"
                                    class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-500 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                >
                                    Register
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    @show

    @yield('content')

    @section('footer')
        <footer class="bg-white dark:bg-gray-900">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a
                        href="/"
                        class="flex items-center mb-4 sm:mb-0"
                    >
                        <img
                            src="logo.png"
                            class="h-8 mr-3 rounded-lg"
                            alt="I-Bank Logo"
                        />
                        <span class="self-center text-black text-2xl font-semibold whitespace-nowrap dark:text-white">
                            I-Bank
                        </span>
                    </a>
                    <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-black sm:mb-0 dark:text-white">
                        <li>
                            <a href="#" class="mr-4 hover:underline hover:text-blue-500 md:mr-6 ">About</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline hover:text-blue-500 md:mr-6">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline hover:text-blue-500 md:mr-6 ">Licensing</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline hover:text-blue-500">Contact</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8"/>
                <span
                    class="block text-sm sm:text-center dark:text-white text-black">© 2023 <a
                    href="#"
                    class="hover:underline"
                    >
                        I-Bank™
                    </a>
                    . All Rights Reserved.
                </span>
            </div>
        </footer>
    @show
</div>

</body>
</html>
