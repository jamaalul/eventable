@extends('layouts.app')

@section('content')
    <div class="min-h-screen plus-jakarta-sans" style="background-color: {{ $event->base_color }}">
        <!-- Main Layout Container -->
        <div class="mx-auto px-6 py-12 md:py-20 max-w-2xl">

            <!-- Navigation -->
            <div class="flex justify-between items-center mb-12">
                <a href="/{{ $event->slug }}"
                    class="group flex items-center gap-2 font-medium text-black/50 hover:text-black transition-colors">
                    <flux:icon.arrow-left class="w-4 h-4" />
                    <span class="text-sm">Back</span>
                </a>

                @if ($event->logo_url)
                    <img src="/storage/{{ $event->logo_url }}" alt="Logo" class="w-auto max-h-8">
                @endif
            </div>

            <!-- Page Header -->
            <div class="space-y-4 mb-12 text-center">
                <h1 class="font-semibold text-zinc-900 text-3xl md:text-4xl tracking-tight">
                    Confirm Your Registration
                </h1>
                <p class="font-regular text-black/70 text-lg">
                    Join us for <span class="font-semibold text-black">{{ $event->title }}</span>. Please provide your
                    details below.
                </p>
            </div>

            <!-- Registration Form Area -->
            <div class="space-y-8">
                <form action="#" method="POST" class="space-y-8">
                    @csrf

                    <div class="space-y-8">
                        @foreach ($event->registrationFields->sortBy('id') as $field)
                            <div class="space-y-3">
                                <flux:label class="font-medium text-black/60 text-sm">
                                    {{ $field->label }}</flux:label>

                                @if ($field->type === 'text')
                                    <flux:input name="field_{{ $field->id }}"
                                        required="{{ $field->is_required || $field->is_mandatory }}"
                                        placeholder="Type here..." />
                                @elseif($field->type === 'email')
                                    <flux:input type="email" name="field_{{ $field->id }}"
                                        required="{{ $field->is_required || $field->is_mandatory }}"
                                        placeholder="your@email.com" />
                                @elseif($field->type === 'textarea')
                                    <flux:textarea name="field_{{ $field->id }}"
                                        required="{{ $field->is_required || $field->is_mandatory }}"
                                        placeholder="Tell us..." />
                                @elseif($field->type === 'select')
                                    <flux:select name="field_{{ $field->id }}"
                                        required="{{ $field->is_required || $field->is_mandatory }}">
                                        @foreach ($field->options as $option)
                                            <flux:select.option>{{ $option }}</flux:select.option>
                                        @endforeach
                                    </flux:select>
                                @elseif($field->type === 'checkbox')
                                    <div class="gap-4 grid grid-cols-1 sm:grid-cols-2">
                                        @foreach ($field->options as $option)
                                            <label
                                                class="flex items-center gap-3 bg-white/50 hover:bg-white shadow-sm p-4 border border-zinc-200 rounded-lg transition-all cursor-pointer">
                                                <flux:checkbox name="field_{{ $field->id }}[]"
                                                    value="{{ $option }}" />
                                                <span class="font-medium text-black/80 text-sm">{{ $option }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @elseif($field->type === 'radio')
                                    <flux:radio.group name="field_{{ $field->id }}"
                                        required="{{ $field->is_required || $field->is_mandatory }}">
                                        <div class="gap-4 grid grid-cols-1 sm:grid-cols-2">
                                            @foreach ($field->options as $option)
                                                <label
                                                    class="flex items-center gap-3 bg-white/50 hover:bg-white shadow-sm p-4 border border-zinc-200 rounded-lg transition-all cursor-pointer">
                                                    <flux:radio value="{{ $option }}" />
                                                    <span
                                                        class="font-medium text-black/80 text-sm">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </flux:radio.group>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-6">
                        <button type="submit"
                            class="flex justify-center items-center gap-2 hover:opacity-95 hover:shadow-md py-4 rounded-full w-full font-medium text-lg hover:scale-[101%] active:scale-[99%] transition-all duration-150 cursor-pointer"
                            style="background-color: {{ $event->accent_color }}; color: {{ $event->base_color }};">
                            Complete Registration
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
