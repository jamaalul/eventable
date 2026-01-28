@extends('layouts.app')

@section('content')
    <div class="min-h-screen plus-jakarta-sans" style="background-color: {{ $event['base_color'] }}">
        <div class="mx-auto px-6 py-14 md:py-24 max-w-2xl">

            <!-- Navigation -->
            <div class="flex justify-between items-center mb-14">
                <a href="/{{ $event['slug'] }}"
                    class="group inline-flex items-center gap-2 font-medium text-black/50 hover:text-black text-sm transition">
                    <flux:icon.arrow-left class="w-4 h-4" />
                    <span>Back to event</span>
                </a>

                @if ($event['logo_url'])
                    <img src="/storage/{{ $event['logo_url'] }}" alt="Event logo" class="w-auto h-8 object-contain">
                @endif
            </div>

            <!-- Header -->
            <div class="space-y-4 mb-14 text-center">
                <h1 class="font-semibold text-zinc-900 text-3xl md:text-4xl tracking-tight">
                    You're all set!
                </h1>
                <p class="text-black/70 text-base md:text-lg">
                    Your registration was successful.
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-10 text-center">
                <p class="mx-auto max-w-md text-black/60 text-sm md:text-base text-balance leading-relaxed">
                    We’ve sent your ticket and confirmation details to your email.<br>
                    Thank you for joining <span class="font-semibold">{{ $event['title'] }}</span>.<br> See you there!
                </p>

                <!-- Share Button -->
                <div class="pt-4">
                    <button
                        onclick="
                            navigator.share
                                ? navigator.share({
                                    title: '{{ $event['title'] }}',
                                    text: 'Join me for {{ $event['title'] }}!',
                                    url: window.location.origin + '/{{ $event['slug'] }}'
                                })
                                : window.open(
                                    'https://www.facebook.com/sharer/sharer.php?u=' +
                                    encodeURIComponent(window.location.origin + '/{{ $event['slug'] }}'),
                                    '_blank'
                                )
                        "
                        class="inline-flex justify-center items-center gap-2 bg-white/60 hover:bg-white hover:shadow-md px-6 py-3 border border-black/20 rounded-full font-medium text-black/80 text-sm hover:scale-[1.01] active:scale-[0.99] transition-all duration-150 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>
                        Share and invite your friends
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
