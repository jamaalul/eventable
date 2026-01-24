@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-zinc-900 min-h-screen">
        <div class="flex flex-col justify-center items-center p-6 sm:p-10 min-h-screen">
            <div class="w-full max-w-sm">
                @yield('auth-content')
            </div>
        </div>
    </div>
@endsection

