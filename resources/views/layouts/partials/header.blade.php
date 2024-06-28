<header class="bg-gray-100">
    <div class="container mx-auto">
        <nav class="flex items-center justify-between py-4">
            <div class="flex items-center">
                <button class="text-gray-600 md:hidden" id="menu-toggle">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path d="M4 5h16M4 12h16m-7 7h7"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden md:flex md:items-center md:w-auto w-full" id="menu">
                <ul class="flex flex-col md:flex-row md:ml-auto mt-3 md:mt-0">
                    @guest
                        <li class="nav-item"><a class="nav-link text-gray-600 px-4 py-2 hover:text-gray-900"
                                href="/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link text-gray-600 px-4 py-2 hover:text-gray-900"
                                href="/register">Register</a></li>
                        <li class="nav-item"><a class="nav-link text-gray-600 px-4 py-2 hover:text-gray-900"
                                href="/password/reset">Reset Password</a></li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-gray-600 px-4 py-2 hover:text-gray-900" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-gray-600 px-4 py-2 hover:text-gray-900" href="#"
                                id="logoutLink">Logout</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</header>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('menu');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    });
</script>
