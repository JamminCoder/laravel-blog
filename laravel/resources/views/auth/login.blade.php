@extends('layouts.app')

@section('content')
<div class="center-page">
    <div class="card p=2 shadow">
        <h1 class="text=center mb=1">Login</h1>
        <!-- Session Status -->
        <x-auth-session-status class="mb=4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="color=red mb=2" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt=0.1 w=100%" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt=1">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt=0.1 w=100%"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="d=block mt=4">
                <label for="remember_me" class="d=flex align=center">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex align=center justify=end mt=4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml=3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </div>
    </div>
    

@endsection

        
