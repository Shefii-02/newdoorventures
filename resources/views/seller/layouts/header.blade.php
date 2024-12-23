<header class="d-flex justify-content-between align-items-center mb-3 bg-dark rounded-2xl">

    <div class="logo p-2 w-20 ms-2">
        <a href="{{ route('user.dashboard') }}">
            <img src="{{ asset('images/general/logo-light-3.png') }}" alt="New Door Ventures">
        </a>
    </div>

    <div class="d-flex align-items-center gap-4 ">

        <a href="{{ route('public.index') }}" target="_blank" class="text-uppercase btn btn-dark fs-6 p-1 ">
            <span class="ps-2">Go to homepage</span>
            <span class="icon-tabler-wrapper ms-2 fs-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M13 18l6 -6"></path>
                    <path d="M13 6l6 6"></path>
                </svg>


            </span>
        </a>
        <div class="ps-block--user-wellcome">

            <div class="ps-block__right text-white d-none d-lg-block">
                <p class="text-white">Hello, {{ auth('account')->user()->name }}</p>
                <small>Last login at {{ date('M d, Y h:i:',strtotime(auth('account')->user()->last_login)) }}</small>
            </div>


            <div class="relative" x-data="{ isOpen: false }">
                <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false" class="flex items-center">
                    <div class="ps-block__left ms-3">
                        <img src="{{ auth('account')->user()->avatar_url }}"
                            alt="Shefii Km" class="avatar avatar-lg">
                    </div>
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24">
                        <path
                            d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"
                            class="heroicon-ui"></path>
                    </svg>
                </button>
                <ul x-show="isOpen" @click.away="isOpen = false"
                    class="absolute font-normal bg-white shadow overflow-hidden rounded w-48 border mt-2 py-1 right-0 z-20"
                    style="display: none;">
                    <ul class="menu">
                        <li class="dashboard">
                            <a href="{{ route('user.dashboard') }}" class="">
                                <span class="icon-tabler-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>


                                </span>
                                Dashboard
                            </a>
                        </li>

                        <li class="properties">
                            <a href="{{ route('user.properties.index') }}" class="active">
                                <span class="icon-tabler-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bed"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M22 17v-3h-20"></path>
                                        <path d="M2 8v9"></path>
                                        <path d="M12 14h10v-2a3 3 0 0 0 -3 -3h-7v5z"></path>
                                    </svg>


                                </span>
                                Properties
                            </a>
                        </li>

                        <li class="settings">
                            <a href="{{ route('user.settings') }}" class="">
                                <span class="icon-tabler-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-settings" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                        </path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg>


                                </span>
                                Settings
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('user.logout') }}" title="Logout"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="Logout">
                                <form action="{{ route('user.logout') }}" id="logout-form" method="POST">@method('POST') @csrf</form>
                                <span class="icon-tabler-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                                        </path>
                                        <path d="M9 12h12l-3 -3"></path>
                                        <path d="M18 15l3 -3"></path>
                                    </svg>


                                </span>
                                <span class="ml-2">Logout</span>
                            </a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</header>
