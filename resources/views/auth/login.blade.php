@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900">
      <div class="fixed top-0 hidden p-6 lg:block lg:px-12">
        <a href="/" class="flex items-center space-x-2">
          <img class="" src="{{ env('APP_URL') }}/img/logo.png" alt="logo" />
          
        </a>
      </div>
      <div class="hidden w-full place-items-center lg:grid">
        <div class="w-full max-w-lg p-6">
          <img
            class="w-full"
            x-show="!$store.global.isDarkModeEnabled"
            src="{{ env('APP_URL') }}/images/illustrations/dashboard-check.svg"
            alt="image"
          />
          <img
            class="w-full"
            x-show="$store.global.isDarkModeEnabled"
            src="{{ env('APP_URL') }}/images/illustrations/dashboard-check-dark.svg"
            alt="image"
          />
        </div>
      </div>
      <main
        class="flex w-full flex-col items-center bg-white dark:bg-navy-700 lg:max-w-md"
      >
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex w-full max-w-sm grow flex-col justify-center p-5">
            <div class="text-center">
                <img
                class="mx-auto lg:hidden"
                src="{{ env('APP_URL') }}/img/logo.png"
                alt="logo"
                />
                <div class="mt-4">
                <h2
                    class="text-2xl font-semibold text-slate-600 dark:text-navy-100"
                >
                    Welcome Back
                </h2>
                <p class="text-slate-400 dark:text-navy-300">
                    Please sign in to continue
                </p>
                </div>
            </div>
            <div class="mt-10">

                <x-alert />

                <label class="relative flex mt-4">
                <input type="email" name="email" required
                    class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                    placeholder="Email"
                    
                />
                <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                >
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 transition-colors duration-200"
                    fill="none"
                    viewbox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                    </svg>
                </span>
                </label>
                @error('email') 
                <span class="text-tiny+ text-error">
                    {{ $message }}
                </span>
                @enderror
                <label class="relative mt-4 flex">
                <input name="password" required 
                    class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                    placeholder="Password"
                    type="password"
                />
                <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                >
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 transition-colors duration-200"
                    fill="none"
                    viewbox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                    />
                    </svg>
                </span>
                </label>
                <div class="mt-4 flex items-center justify-between space-x-2">
                <label class="inline-flex items-center space-x-2">
                    <input 
                    class="form-checkbox is-outline h-5 w-5 rounded border-slate-400/70 bg-slate-100 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-500 dark:bg-navy-900 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                    type="checkbox"
                    />
                    <span class="line-clamp-1">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="text-xs text-slate-400 transition-colors line-clamp-1 hover:text-slate-800 focus:text-slate-800 dark:text-navy-300 dark:hover:text-navy-100 dark:focus:text-navy-100"
                    >Forgot Password?</a
                >
                @endif
                </div>
                <button
                class="btn mt-10 h-10 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                >
                Sign In
                </button>
                <div class="mt-4 text-center text-xs+">
                <p class="line-clamp-1">
                    <span>Dont have Account?</span>

                    <a
                    class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                    href="/register"
                    >Create account</a
                    >
                </p>
                </div>
                <div class="my-7 flex items-center space-x-3">
                <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
                <p>OR</p>
                <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
                </div>
                <div class="flex space-x-4">
                <a href="/auth/google"
                    class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                >
                    <img
                    class="h-5.5 w-5.5"
                    src="{{ env('APP_URL') }}/img/google.png"
                    alt="logo"
                    />
                    <span>Google</span>
                </a>
                <a href="/auth/facebook"
                    class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                >
                    <img
                    class="h-5.5 w-5.5"
                    src="{{ env('APP_URL') }}/img/facebook.png"
                    alt="logo"
                    />
                    <span>Facebook</span>
                </a >
                </div>
            </div>
            </div>
            <div
            class="my-5 flex justify-center text-xs text-slate-400 dark:text-navy-300"
            >
            <a href="/">Privacy Notice</a>
            <div class="mx-3 my-1 w-px bg-slate-200 dark:bg-navy-500"></div>
            <a href="/">Term of service</a>
            </div>
        </form>
    </main>
</div>
@endsection