@extends('layouts.app')
@section('content')
    <section class="relative flex items-center overflow-hidden md:h-screen py-36 zoom-image">
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat image-wrap z-1"
            style="background-image: url('https://hously.archielite.com/storage/backgrounds/02.jpg')"></div>

        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black z-2" id="particles-snow"><canvas
                class="particles-js-canvas-el"  style="width: 100%; height: 100%;"></canvas></div>
        <div class="container z-3">
            <div class="flex justify-center">
                <div
                    class="login-form max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-700 rounded-md">
                    <a href="{{ route('public.index') }}"><img
                            src="{{ asset('/images/general/logo-authentication-page.png') }}"
                            class="mx-auto" width="64" height="64" alt="New Door Ventures"></a>
                    <h5 class="my-6 text-xl font-semibold text-center">Admin Login Panel</h5>
                    <form class="text-start" action="{{ route('admin.login.submit') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-1">
                            <div class="mb-4">
                                <label class="fs-6" for="email">Email Address:</label>
                                <input id="email" name="email" type="email"
                                    class="form-control form-input dark:bg-slate-800 mt-1" placeholder="name@example.com">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                    
                            </div>

                            <div class="mb-4">
                                <label class="fs-6" for="password">Password:</label>
                                <input id="password" name="password" type="password"
                                    class="form-control form-input dark:bg-slate-800 mt-1" placeholder="Password">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex justify-between mb-4">
                                <div class="flex items-center mb-0 form-checkbox">
                                    <input class="me-2 border border-inherit w-[16px] h-[16px] mb-[3px]" type="checkbox"
                                        name="remember" value="" id="RememberMe">
                                    <label class="text-slate-400" for="RememberMe">Remember me?</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="submit"
                                    class="w-full text-white rounded-md btn bg-primary hover:bg-secondary">Login</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>


    <script src="themes/hously/plugins/particles.js/particles.js"></script>
@endsection
