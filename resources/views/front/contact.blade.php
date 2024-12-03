@extends('layouts.app')

@section('content')
    <section class="relative table w-full py-32 bg-center bg-no-repeat breadcrumb lg:py-36 page_speed_48133614">
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="container">
            <div class="grid grid-cols-1 mt-10 text-center">
                <h3 class="text-3xl font-medium leading-normal text-white md:text-4xl md:leading-normal">Contact </h3>
            </div>
        </div>
    </section>
    <div class="ck-content">
        <div class="relative google-map container-fluid">
            <div class="grid grid-cols-1">
                <div class="w-full leading-[0] border-0">
                    <iframe
                        src="https://maps.google.com/maps?q=New Door Ventures | Best Real estate agency in Bengaluru%20&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                        class="border-none w-full h-[500px]" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
        <section class="relative py-16 lg:py-24">
            <div class="container">
                <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                    <div class="lg:col-span-7 md:col-span-6">
                        <img src="{{asset('themes/hously/images/svg/contact.svg')}}"
                            alt="Get in touch!">
                    </div>

                    <div class="lg:col-span-5 md:col-span-6">
                        <div class="lg:ms-5">
                            <div class="p-6 bg-white rounded-md shadow dark:bg-slate-900 dark:shadow-gray-700">
                                <h3 class="mb-6 text-2xl font-medium leading-normal">Get in touch!</h3>

                                <form method="post" action="https://stage.newdoorventures.in/contact/send"
                                    class="contact-form">
                                    <input type="hidden" name="_token" value="zk1WhKvRljtFrnxiXtFjE7b6iUP7vd46Zo1GgXPX"
                                        autocomplete="off">
                                    <p class="mb-0" id="error-msg"></p>
                                    <div id="simple-msg"></div>
                                    <div class="grid lg:grid-cols-12 lg:gap-6">
                                        <div class="mb-5 lg:col-span-6">
                                            <label class="form-label" for="name">Your Name:</label>
                                            <input name="name" id="name" type="text" class="mt-2 form-input"
                                                placeholder="Name:">
                                        </div>

                                        <div class="mb-5 lg:col-span-6">
                                            <label class="form-label" for="email">Your Email:</label>
                                            <input name="email" id="email" type="email" class="mt-2 form-input"
                                                placeholder="Email:">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1">
                                        <div class="mb-5">
                                            <label class="form-label" for="subject">Your Question:</label>
                                            <input name="subject" id="subject" class="mt-2 form-input"
                                                placeholder="Subject:">
                                        </div>

                                        <div class="mb-5">
                                            <label class="form-label" for="content">Your Comment:</label>
                                            <textarea name="content" id="content" class="mt-2 form-input textarea" placeholder="Message:"></textarea>
                                        </div>
                                    </div>





                                    <div class="contact-mb-3">
                                        <div class="contact-message contact-success-message" style="display: none"></div>
                                        <div class="contact-message contact-error-message" style="display: none"></div>
                                    </div>
                                    <br>
                                    <button type="submit" id="submit"
                                        class="text-white rounded-md btn bg-primary hover:bg-secondary">Send
                                        Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>&lt;
        </section>
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-[30px]">
                <div class="px-6 text-center">
                    <div class="relative -m-3 overflow-hidden text-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-32 h-32 mx-auto feather feather-hexagon fill-primary/5">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                        </svg>
                        <div
                            class="absolute start-0 end-0 flex items-center justify-center mx-auto text-4xl align-middle transition-all duration-500 ease-in-out top-2/4 -translate-y-2/4 text-primary rounded-xl">
                            <i class="mdi mdi-phone-outline"></i>
                        </div>
                    </div>

                    <div class="content mt-7">
                        <h5 class="text-xl font-medium title h5">Phone</h5>
                        <p class="mt-3 text-slate-400">Reach Out Contact Us Directly</p>

                        <div class="mt-5">
                            <a href="tel:+91 9686 607 663" dir="ltr"
                                class="transition duration-500 btn btn-link text-primary hover:text-primary after:bg-primary">+91
                                9686 607 663</a>
                        </div>
                    </div>
                </div>

                <div class="px-6 text-center">
                    <div class="relative -m-3 overflow-hidden text-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-32 h-32 mx-auto feather feather-hexagon fill-primary/5">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                        </svg>
                        <div
                            class="absolute start-0 end-0 flex items-center justify-center mx-auto text-4xl align-middle transition-all duration-500 ease-in-out top-2/4 -translate-y-2/4 text-primary rounded-xl">
                            <i class="mdi mdi-email-outline"></i>
                        </div>
                    </div>

                    <div class="content mt-7">
                        <h5 class="text-xl font-medium title h5">Email</h5>
                        <p class="mt-3 text-slate-400">Drop Us a Line “Get in Touch Today”</p>

                        <div class="mt-5">
                            <a href="mailto:support@newdoorventures.in "
                                class="transition duration-500 btn btn-link text-primary hover:text-primary after:bg-primary">support@newdoorventures.in
                            </a>
                        </div>
                    </div>
                </div>

                <div class="px-6 text-center">
                    <div class="relative -m-3 overflow-hidden text-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-32 h-32 mx-auto feather feather-hexagon fill-primary/5">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                        </svg>
                        <div
                            class="absolute start-0 end-0 flex items-center justify-center mx-auto text-4xl align-middle transition-all duration-500 ease-in-out top-2/4 -translate-y-2/4 text-primary rounded-xl">
                            <i class="mdi mdi-map-marker-outline"></i>
                        </div>
                    </div>

                    <div class="content mt-7">
                        <h5 class="text-xl font-medium title h5">Location</h5>
                        <p class="mt-3 text-slate-400">#516, SOL ARCADE 8th Cross Phase 1 80ft, Jakkur Road, MCECHS Layout,
                            Bengaluru, Karnataka 560077</p>

                        <div class="mt-5">
                            <a href="https://maps.google.com/maps?q=New Door Ventures | Best Real estate agency in Bengaluru&amp;ie=UTF8"
                                class="transition duration-500 read-more btn btn-link text-primary hover:text-primary after:bg-primary"
                                target="_blank">View on Google map</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
