    <!-- Navigation Bar -->
    <nav class="flex px-4 border-b shadow-lg items-center relative px-16 z-[1000]">
        <div class="text-lg font-bold py-4">
            Data Provinsi Aceh
        </div>

        <!-- Hamburger Menu -->
        <div id="hamburger" class="ml-auto md:hidden text-gray-500 cursor-pointer">
            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 7L4 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M20 12L4 12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M20 17L4 17" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </div>

        <!-- Navigation Menu -->
        <ul id="menu" class="lg:ml-auto hidden md:flex md:space-x-4 absolute md:relative top-full left-0 right-0 bg-white shadow-lg md:shadow-none md:bg-transparent md:p-0">
            <li>
                <a href="/" class="flex justify-between md:inline-flex p-4 items-center hover:bg-gray-50 space-x-2">
                    Home
                </a>
            </li>
            <li class="relative parent">
                <!-- Parent Menu Item -->
                <a href="" class="flex justify-between md:inline-flex p-4 items-center hover:bg-gray-50 space-x-2">
                    <span>Peta</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 fill-current" viewBox="0 0 24 24">
                        <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
                    </svg>
                </a>
                <!-- Dropdown Menu -->
                <ul class="child transition duration-300 md:absolute top-full right-0 md:w-48 bg-white md:shadow-lg md:rounded-b">
                    <li>
                        <a href="/populasi" class="block px-4 py-2 hover:bg-gray-100">
                            Populasi per Kab/Kota
                        </a>
                    </li>
                    <li>
                        <a href="/kecamatan" class="block px-4 py-2 hover:bg-gray-100">
                            Total kecamatan
                        </a>
                    </li>
                    <li>
                        <a href="/desa" class="block px-4 py-2 hover:bg-gray-100">
                            Total desa
                        </a>
                    </li>
                    <li>
                        <a href="/agama" class="block px-4 py-2 hover:bg-gray-100">
                            Persentase agama
                        </a>
                    </li>
                    <li>
                        <a href="/pekerjaan" class="block px-4 py-2 hover:bg-gray-100">
                            Persebaran pekerjaan terbanyak
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- JavaScript for Hamburger -->
    <script>
        const hamburger = document.getElementById('hamburger');
        const menu = document.getElementById('menu');

        hamburger.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
