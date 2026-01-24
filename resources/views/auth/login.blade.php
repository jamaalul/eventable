@extends('layouts.auth')

@section('auth-content')
    <div>
        <flux:heading size="lg">Login</flux:heading>

        <form method="POST" action="{{ route('login') }}" class="space-y-4 mt-6">
            @csrf

            <flux:input label="Email" name="email" type="email" required />

            <flux:input label="Password" name="password" type="password" required />

            <flux:checkbox name="remember">
                Remember me
            </flux:checkbox>

            <flux:button type="submit" variant="primary" class="w-full">
                Login
            </flux:button>
        </form>
    </div>
@endsection
