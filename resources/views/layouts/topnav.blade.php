<nav id="topnav" class="defaultscroll is-sticky nav-sticky">
    <div class="container">
        <a class="logo" href="{{ route('public.index') }}" title="New Door Ventures">
            <div class="logo-bg">

                <img src="{{ asset('images/general/logo-dark.png') }}" class="inline-block dark:hidden"
                    alt="New Door Ventures">
                <img src="{{ asset('images/general/logo-light-3.png')}}"
                    class="hidden dark:inline-block" alt="New Door Ventures">

            </div>
        </a>

        <div class="menu-extras">
            <div class="menu-item">
                <button type="button" class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
            </div>
        </div>

        <ul class="buy-button list-none mb-0">

            <li class="inline mb-0">
                <a href="{{ route('user.login') }}"
                    class="text-white rounded-full btn btn-icon bg-primary hover:bg-secondary border-primary dark:border-primary"
                    aria-label="Sign in">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-user h-4 w-4 stroke-[3]">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            </li>
            <li class="hidden mb-0 sm:inline ps-1">
                <a href="{{ route('user.properties.create') }}"
                    class="text-white rounded-full btn bg-primary hover:bg-secondary border-primary dark:border-primary"
                    aria-label="Add your listing">
                    Post your property for free
                </a>
            </li>
            <li class="inline mb-0 ms-5">
                <a href="tel:+919686607663"><i class="mdi mdi-phone-return fst-normal me-1"></i>+91-9686607663</a>
            </li>
        </ul>

        <div id="navigation">
            <ul class="navigation-menu justify-end">
                <li class="active">
                    <a href="{{ route('public.index') }}" target="_self" class="sub-menu-item active">
                        Home
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('public.news') }}" target="_self" class="sub-menu-item">
                        News
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('public.contact') }}" target="_self" class="sub-menu-item">
                        Contact
                    </a>
                </li>
            </ul>

            <ul class="navigation-menu">

            </ul>
        </div>
    </div>
</nav>
