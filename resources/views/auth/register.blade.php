@extends('layouts.app')
@section('content')
    <section class="relative flex items-center py-36 zoom-image">
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat image-wrap z-1"
            style="background-image: url('https://hously.archielite.com/storage/backgrounds/01.jpg')"></div>

        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black z-2" id="particles-snow"><canvas
                class="particles-js-canvas-el" width="2880" height="1816" style="width: 100%; height: 100%;"></canvas></div>
        <div class="container z-3">
            <div class="flex justify-center mt-10">
                <div
                    class="login-form max-w-[500px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-700 rounded-md">
                    <a href="{{ route('public.index') }}"><img
                            src="{{ asset('images/general/logo-authentication-page.png') }}" width="64" height="64"
                            class="mx-auto" alt="New Door Ventures"></a>
                    <h5 class="my-2 text-xl font-semibold text-center py-4">Register</h5>
                    <form class="text-start" action="{{ route('user.register') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-1">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="mb-4 text-sm">
                                    <label class="font-medium" for="first_name">First name:</label>
                                    <input id="first_name" value="{{ old('first_name') }}" name="first_name" type="text"
                                        class="form-control form-input dark:bg-slate-800 mt-1" placeholder="First name">
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2 text-sm">
                                    <label class="font-medium text-sm" for="last_name">Last name:</label>
                                    <input id="last_name" value="{{ old('last_name') }}" name="last_name" type="text"
                                        class="form-control form-input dark:bg-slate-800 mt-1" placeholder="Last name">
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-2">
                                <div class="mb-4 d-none text-sm">
                                    <label class="font-medium text-sm" for="username">Username:</label>
                                    <input id="username" value="{{ old('username') }}" name="username" type="text"
                                        class="form-control form-input dark:bg-slate-800 mt-1" placeholder="Username">
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4 text-sm">
                                    <label class="font-medium text-sm" for="email">Email:</label>
                                    <input id="email" value="{{ old('email') }}"  name="email" type="email"
                                        class="form-control form-input dark:bg-slate-800 mt-1" placeholder="Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 text-sm">
                                <label class="font-medium text-sm" for="phone">Phone:</label>
                                <input id="phone" value="{{ old('phone') }}" name="phone" type="number" maxlength="10"
                                    class="form-control form-input dark:bg-slate-800 mt-1" placeholder="Phone">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <div class="mb-4 text-sm">
                                    <label class="font-medium text-sm" for="password">Password:</label>
                                    <input id="password" autocomplete="new-password" name="password" type="password"
                                        class="form-control form-input dark:bg-slate-800 mt-1" placeholder="Password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2 mb-3 text-sm">
                                    <label class="font-medium text-sm" for="password-confirm">Password confirmation:</label>
                                    <input id="password-confirm" type="password" class="mt-1 form-control form-input"
                                        name="password_confirmation" placeholder="Password confirmation">
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-2 mb-4">
                                <button type="submit"
                                    class="w-full text-sm text-white rounded-md btn bg-primary hover:bg-secondary">Register</button>
                            </div>

                            <div class="text-center">
                                <span class="text-slate-400 me-2 text-sm">Already have an account?</span> <a
                                    href="{{ route('user.login') }}" class="font-bold text-black dark:text-white">Login</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
