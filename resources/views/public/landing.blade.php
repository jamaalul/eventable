@extends('layouts.app')

@section('content')
    <div class="flex flex-row w-screen md:h-screen plus-jakarta-sans" style="background-color: {{ $event['base_color'] }}">
        <div class="flex-1 p-12 md:p-24 lg:p-32 grow">
            <div class="flex flex-col gap-6 md:gap-8 lg:gap-12 h-full">
                @if ($event['logo_url'])
                    <div class="max-h-24 md:max-h-28 lg:max-h-32">
                        <img src="storage/{{ $event['logo_url'] }}" alt="Logo">
                    </div>
                @endif
                <div class="flex flex-col gap-4 md:gap-6 lg:gap-8">
                    <h1 class="font-semibold text-3xl lg:text-5xl tracking-tight">{{ $event['title'] }}</h1>
                    <p class="font-regular text-black/70 text-base md:text-lg lg:text-lg">{{ $event['description'] }}</p>
                </div>
                <div class="flex md:flex-row flex-col md:justify-between gap-2 md:gap-0 mt-2 md:mt-0">
                    <div class="flex flex-col gap-1">
                        <p class="font-medium text-black/50 text-sm">Registration opens</p>
                        <p class="font-medium text-2xl">
                            {{ $event['registration_start']->translatedFormat('d M,') }}
                            <span
                                class="text-black/60 text-sm">{{ $event['registration_start']->translatedFormat('Y') }}</span>
                        </p>
                    </div>
                    <flux:separator vertical class="hidden md:block" />
                    <flux:separator class="md:hidden" />
                    <div class="flex flex-col gap-1">
                        <p class="font-medium text-black/50 text-sm">Registration closes</p>
                        <p class="font-medium text-2xl">
                            {{ $event['registration_end']->translatedFormat('d M,') }}
                            <span
                                class="text-black/60 text-sm">{{ $event['registration_end']->translatedFormat('Y') }}</span>
                        </p>
                    </div>
                    <flux:separator vertical class="hidden md:block" />
                    <flux:separator class="md:hidden" />
                    <div class="flex flex-col gap-1">
                        <p class="font-medium text-black/50 text-sm">Event date</p>
                        <p class="font-medium text-2xl">
                            {{ $event['registration_end']->translatedFormat('d M,') }}
                            <span
                                class="text-black/60 text-sm">{{ $event['registration_end']->translatedFormat('Y') }}</span>
                        </p>
                    </div>
                </div>
                <button onclick="window.location.href = '{{ route('public.event.register', $slug = $event['slug']) }}'"
                    class="flex justify-center items-center gap-2 hover:opacity-95 hover:shadow-md mt-12 md:mt-auto py-3 md:py-4 rounded-full w-full font-medium text-base md:text-lg hover:scale-101 active:scale-[99%] transition-all duration-150 cursor-pointer"
                    style="background-color: {{ $event['accent_color'] }}; color: {{ $event['base_color'] }};">
                    Register Now
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 md:size-7 lg:size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="hidden md:block bg-red h-screen aspect-square overflow-hidden">
            <img src="storage/{{ $event['cover_url'] }}" alt="Cover">
        </div>
    </div>
    <div class="md:hidden bg-red w-screen aspect-square overflow-hidden">
        <img src="storage/{{ $event['cover_url'] }}" alt="Cover">
    </div>
@endsection
