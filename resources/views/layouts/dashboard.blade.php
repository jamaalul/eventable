@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');

        .plus-jakarta-sans {
            font-family: "Plus Jakarta Sans", sans-serif;
            font-optical-sizing: auto;
        }
    </style>

    <div class="bg-white dark:bg-zinc-800 min-h-screen antialiased">
        <flux:sidebar sticky collapsible="mobile"
            class="bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700 border-r">
            <flux:sidebar.header>
                <img src="{{ asset('logo.svg') }}" alt="Logo" class="w-[70%]">
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>
            <flux:sidebar.search placeholder="Search..." />
            <flux:sidebar.nav>
                <flux:sidebar.item icon="home" href="{{ route('dashboard.overview') }}"
                    :current="Route::is('dashboard.overview')">Overview
                </flux:sidebar.item>
                <flux:sidebar.item icon="calendar" href="{{ route('dashboard.event') }}"
                    :current="Route::is('dashboard.event')">Event</flux:sidebar.item>
                <flux:sidebar.item icon="user-group" href="{{ route('dashboard.attendees') }}"
                    :current="Route::is('dashboard.attendees')">Attendees</flux:sidebar.item>
            </flux:sidebar.nav>
            <flux:sidebar.spacer />
            <flux:sidebar.nav>
                <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
                <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
            </flux:sidebar.nav>
            <flux:dropdown position="top" align="start" class="max-lg:hidden">
                <flux:sidebar.profile avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin" />
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                        <flux:menu.radio>Truly Delta</flux:menu.radio>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" alignt="start">
                <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                        <flux:menu.radio>Truly Delta</flux:menu.radio>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:header>
        <flux:main class="flex flex-col gap-4">
            @yield('dashboard-content')
        </flux:main>
    </div>
@endsection
