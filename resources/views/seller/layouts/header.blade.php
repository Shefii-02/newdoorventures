<header class="d-flex justify-content-between align-items-center mb-3 bg-dark rounded-2xl">

    <div class="logo p-2 w-20 ms-2">
        <img src="{{ asset('images/general/logo-light-3.png') }}" alt="New Door Ventures">
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

            <div class="ps-block__right text-white">
                <p class="text-white">Hello, {{ auth('account')->user()->name }}</p>
                <small>Last login at {{ date('M d, Y h:i:',strtotime(auth('account')->user()->last_login)) }}</small>
            </div>


            <div class="relative" x-data="{ isOpen: false }">
                <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false" class="flex items-center">
                    <div class="ps-block__left ms-3">
                        <img src="data:image/png;base64,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"
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
