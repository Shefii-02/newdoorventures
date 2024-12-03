    <footer class="relative mt-48 bg-slate-900 dark:bg-slate-800">
            <div class="container">
                <div class="grid grid-cols-1">
                    <div class="relative py-16">
                        <div class="relative w-full">
                            <div
                                class="relative px-6 py-10 overflow-hidden bg-white shadow-lg -top-40 dark:bg-slate-900 lg:px-8 rounded-xl dark:shadow-gray-700">
                                <div class="grid md:grid-cols-2 grid-cols-1 items-center gap-[30px]">
                                    <div class="text-center md:text-start z-1">
                                        <h3
                                            class="text-2xl font-medium leading-normal text-black md:text-3xl md:leading-normal dark:text-white">
                                            Subscribe to Newsletter.</h3>
                                        <p class="max-w-xl mx-auto text-slate-400">Subscribe to get latest updates and
                                            information.</p>
                                    </div>

                                    <div class="subcribe-form z-1">
                                        <form action="{{ route('newsletter.subscribe') }}"
                                            method="post"
                                            class="relative max-w-lg form-newsletter subscribe-form newsletter-form md:ms-auto">
                                            <input type="hidden" name="_token"
                                                value="Z4zygvQdVaeEzuBI4pXvgSaPnUrDD9Mq1NKN8XaN" autocomplete="off">
                                            <input type="text" id="subcribe" name="email"
                                                class="bg-white rounded-full shadow input-newsletter dark:bg-slate-900 dark:shadow-gray-700"
                                                placeholder="Enter your email:">
                                            <button type="submit"
                                                class="text-white rounded-full bg-primary btn hover:bg-secondary">Subscribe</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="absolute -top-5 -start-5">
                                    <div
                                        class="mdi mdi-email-outline lg:text-[150px] text-7xl text-black/5 dark:text-white/5 ltr:-rotate-45 rtl:rotate-45">
                                    </div>
                                </div>

                                <div class="absolute -bottom-5 -end-5">
                                    <div
                                        class="mdi mdi-pencil-outline lg:text-[150px] text-7xl text-black/5 dark:text-white/5 rtl:-rotate-90">
                                    </div>
                                </div>
                            </div>


                            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] -mt-24">
                                <div class="lg:col-span-4 md:col-span-12">
                                    <a href="/" class="text-[22px] focus:outline-none">
                                        <img src="{{asset('/images/general/logo-light-3.png')}}"
                                            alt="New Door Ventures" style="height:130px">
                                    </a>
                                    <p class="mt-6 text-gray-300">Welcome to Bangalore's unparalleled real estate
                                        destination,
                                        the premier hub with exclusive listings for your dream home or investment.</p>
                                </div>
                                <div class="lg:col-span-2 md:col-span-3">
                                    <div class="tracking-[1px] text-gray-100 font-semibold">Company</div>
                                    <ul class="mx-0 mt-6 mb-0 list-none footer-list">
                                        <li class="my-2.5">
                                            <a href="{{ route('public.index') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                                Home
                                            </a>
                                        </li>
                                        <li class="my-2.5">
                                            <a href="{{ route('public.page','about-us') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                                About Us
                                            </a>
                                        </li>
                                        <li class="my-2.5">
                                            <a href="{{ route('public.news') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                                News
                                            </a>
                                        </li>
                                        <li class="my-2.5">
                                            <a href="{{ route('user.login') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                               Login
                                            </a>
                                        </li>
                                        <li class="my-2.5">
                                            <a href="{{ route('user.register') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class="0 me-1"></i>
                                               Register
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="lg:col-span-2 md:col-span-3">
                                    <div class="tracking-[1px] text-gray-100 font-semibold">Useful Links</div>
                                    <ul class="mx-0 mt-6 mb-0 list-none footer-list">
                                        <li class="my-2.5">
                                            <a href="{{ route('public.projects') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                                Projects
                                            </a>
                                        </li>
                                        <li class="my-2.5">
                                            <a href="{{ route('public.properties') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                                Properties
                                            </a>
                                        </li>
                                        <li class="my-2.5">
                                            <a href="{{ route('public.page','terms-of-services') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                                Terms of Services
                                            </a>
                                        </li>
                                        <li class="my-2.5">
                                            <a href="{{ route('public.page','privacy-policy') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                                Privacy Policy
                                            </a>
                                        </li>
                                        <li class="my-2.5">
                                            <a href="{{ route('public.page','contact') }}"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">
                                                <i class=" me-1"></i>
                                                Contact
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="lg:col-span-3 md:col-span-4">
                                    <div class="tracking-[1px] text-gray-100 font-semibold">Contact Details</div>
                                    <div class="flex mt-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-map-pin w-5 h-5 text-primary me-2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <div>
                                            <span class="block mb-2 text-gray-300">#516, SOL ARCADE 8th Cross Phase 1
                                                80ft, Jakkur Road, MCECHS Layout, Bengaluru, Karnataka 560077</span>
                                            <a href="https://maps.google.com/maps?q=https://maps.app.goo.gl/Pb5jLAZGXUsNe2KF6&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                                                data-type="iframe" data-group="contact-information"
                                                class="duration-500 ease-in-out text-primary hover:text-secondary lightbox">
                                                View on Google map
                                            </a>
                                        </div>
                                    </div>

                                    <div class="flex mt-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-mail w-5 h-5 text-primary me-2">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <div>
                                            <a href="mailto:support@newdoorventures.in"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">support@newdoorventures.in</a>
                                        </div>
                                    </div>

                                    <div class="flex mt-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-phone w-5 h-5 text-primary me-2">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                            </path>
                                        </svg>
                                        <div>
                                            <a href="tel:+91 9686 607 663" dir="ltr"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">+91
                                                9686 607 663</a> <br>
                                            <a href="tel:+91 9686366086" dir="ltr"
                                                class="duration-500 ease-in-out text-slate-300 hover:text-slate-400">+91
                                                9686 366 086</a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-[30px] px-0 border-t border-gray-800 dark:border-gray-700">
                <div class="container text-center">
                    <div class="grid items-center gap-6 md:grid-cols-2">
                        <div class="text-center md:text-start">
                            <p class="mb-0 text-gray-300">
                                © 2024 New Door Ventures. All right reserved.
                            </p>
                        </div>

                        <ul class="p-0 m-0 space-x-1 text-center list-none md:text-end">

                            <li class="inline">
                                <a href="https://www.facebook.com/NewDoorVenturesPvt.Ltd/" title="Facebook"
                                    target="_blank"
                                    class="text-gray-400 border border-gray-800 rounded-md btn btn-icon btn-sm hover:text-white dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary dark:hover:bg-primary">
                                    <i class="mdi mdi-facebook"></i>
                                </a>
                            </li>
                            <li class="inline">
                                <a href="https://www.instagram.com/newdoorventures_/" title="Instagram"
                                    target="_blank"
                                    class="text-gray-400 border border-gray-800 rounded-md btn btn-icon btn-sm hover:text-white dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary dark:hover:bg-primary">
                                    <i class="mdi mdi-instagram"></i>
                                </a>
                            </li>
                            <li class="inline">
                                <a href="https://twitter.com/DoorVentures" title="Twitter" target="_blank"
                                    class="text-gray-400 border border-gray-800 rounded-md btn btn-icon btn-sm hover:text-white dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary dark:hover:bg-primary">
                                    <i class="mdi mdi-twitter"></i>
                                </a>
                            </li>
                            <li class="inline">
                                <a href="https://www.linkedin.com//in/new-door-ventures-572701207/" title="LinkedIn"
                                    target="_blank"
                                    class="text-gray-400 border border-gray-800 rounded-md btn btn-icon btn-sm hover:text-white dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary dark:hover:bg-primary">
                                    <i class="mdi mdi-linkedin"></i>
                                </a>
                            </li>
                            <li class="inline">
                                <a href="https://www.youtube.com/channel/UC6hcIUA5xme5DsDdQfZIVnA" title="Youtube"
                                    target="_blank"
                                    class="text-gray-400 border border-gray-800 rounded-md btn btn-icon btn-sm hover:text-white dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary dark:hover:bg-primary">
                                    <i class="mdi mdi-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
