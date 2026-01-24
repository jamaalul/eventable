@extends('layouts.auth')

@section('auth-content')
    <div>
        <flux:heading size="lg">Create Account</flux:heading>

        <form method="POST" action="{{ route('register') }}" class="space-y-4 mt-6">
            @csrf

            <flux:input label="Name" name="name" />

            <flux:input label="Email" name="email" type="email" />

            <flux:input label="Password" name="password" type="password" />

            <flux:input label="Confirm Password" name="password_confirmation" type="password" />

            <flux:button type="submit" variant="primary" class="w-full">
                Register
            </flux:button>
        </form>
    </div>
@endsection

