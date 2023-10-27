<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{asset('img/clinicLogo.png')}}" style="width: 70px;border-radius: 10px;">
        </x-slot>

        <div class="row  col-offset-6">
            <div class="col">
                <h1 class="text-center fs-5 text-danger font-weight-bold" style="font-family: Snell Roundhand, cursive;">Dr. Lucas's Clinic</h1>
            </div>
        </div>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>


        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif


        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
