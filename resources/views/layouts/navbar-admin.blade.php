<nav class="flex top-0 h-16 fixed w-full bg-blue-800" style="z-index: 99;">
    <div class="flex justify-between w-full items-center ">
        <div class="px-1 py-1 lg:px-5 lg:pl-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <div class="hidden lg:flex items-center w-72 gap-4">
                        <img src="{{ url('img/pdam.png') }}" alt="" class="w-10">
    
                        <h1 class="font-bold text-white">
                            PERUSAHAAN AIR MINUM KABUPATEN SRAGEN
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative mr-6">
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                class="flex items-center justify-between w-full py-2 px-3 rounded hover:bg-gray-300 md:hover:bg-transparent md:border-0  md:p-0 md:w-auto dark:text-white">
                <img class="h-8 w-8 rounded-full"
                        src="{{ asset('img/' . auth()->user()->foto) }}"
                        alt="">
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar"
                class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                    @if(Auth::user()->role->nama == 'superadmin')
                    <li>
                        <a href="/profil-admin/{{ auth()->user()->id }}"
                            class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Pengaturan Superadmin</a>
                    </li>
                    @elseif(Auth::user()->role->nama == 'unit')
                    <li>
                        <a href="/profil-unit/{{ auth()->user()->id }}"
                            class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Unit</a>
                    </li>
                    @elseif(Auth::user()->role->nama == 'pegawai')
                    <li>
                        <a href="/profil-pegawai/{{ auth()->user()->id }}"
                            class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Pegawai</a>
                    </li>
                    @endif
                </ul>
                <div class="py-1">
                    <a href="{{ url('/logout') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Keluar</a>
                </div>
            </div>
        </div>
    </div>
</nav>
