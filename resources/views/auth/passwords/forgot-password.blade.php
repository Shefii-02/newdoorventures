@extends('layouts.app')
@section('content')
    <section class="relative flex items-center overflow-hidden md:h-screen py-36 zoom-image">
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat image-wrap z-1"
            style="background-image: url('https://hously.archielite.com/storage/backgrounds/02.jpg')"></div>

        <div class="container z-3">
            <div class="flex justify-center">
                <div
                    class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-700 rounded-md">
                    <a href="/"><img src="{{ asset('images/general/logo-authentication-page.png') }}" width="64"
                            height="64" class="mx-auto" alt="New Door Ventures"></a>
                    <h5 class="my-6 text-xl font-semibold text-center">Forgot password</h5>
                    @if (session('success'))
                        <div class="alert alert-success text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger text-sm">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="grid grid-cols-1">
                        <p class="mb-6 text-slate-400 text-sm text-center">Please enter your email address. You will receive a link to create a
                            new
                            password via email.</p>
                        <form class="text-start" method="POST" action="{{ route('user.forget-password.send') }}">
                            @csrf
                            <div class="grid grid-cols-1">
                                <div class="mb-4">
                                    <label class="font-medium text-sm" for="email">Email Address:</label>
                                    <input id="email" name="email" type="email"
                                        class="form-control form-input dark:bg-slate-800 mt-3"
                                        placeholder="name@example.com">
                                   
                                </div>

                                <div class="mb-4">
                                    <button type="submit"
                                        class="w-full text-white text-sm rounded-md btn bg-primary hover:bg-secondary">Reset
                                        password</button>
                                </div>

                                <div class="text-center">
                                    <a href="{{ route('user.login') }}" class="font-bold text-sm text-black dark:text-white">
                                        Back to login page
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
