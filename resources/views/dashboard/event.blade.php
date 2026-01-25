@php
    $colorMaps = [
        'blue' => [
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-100',
            'hover_border' => 'hover:border-blue-4 00',
            'text_900' => 'text-blue-900',
            'text_800' => 'text-blue-800',
            'bg_500' => 'bg-blue-500',
        ],
        'emerald' => [
            'bg' => 'bg-emerald-50',
            'border' => 'border-emerald-100',
            'hover_border' => 'hover:border-emerald-400',
            'text_900' => 'text-emerald-900',
            'text_800' => 'text-emerald-800',
            'bg_500' => 'bg-emerald-500',
        ],
        'violet' => [
            'bg' => 'bg-violet-50',
            'border' => 'border-violet-100',
            'hover_border' => 'hover:border-violet-400',
            'text_900' => 'text-violet-900',
            'text_800' => 'text-violet-800',
            'bg_500' => 'bg-violet-500',
        ],
        'amber' => [
            'bg' => 'bg-amber-50',
            'border' => 'border-amber-100',
            'hover_border' => 'hover:border-amber-400',
            'text_900' => 'text-amber-900',
            'text_800' => 'text-amber-800',
            'bg_500' => 'bg-amber-500',
        ],
        'indigo' => [
            'bg' => 'bg-indigo-50',
            'border' => 'border-indigo-100',
            'hover_border' => 'hover:border-indigo-400',
            'text_900' => 'text-indigo-900',
            'text_800' => 'text-indigo-800',
            'bg_500' => 'bg-indigo-500',
        ],
        'teal' => [
            'bg' => 'bg-teal-50',
            'border' => 'border-teal-100',
            'hover_border' => 'hover:border-teal-400',
            'text_900' => 'text-teal-900',
            'text_800' => 'text-teal-800',
            'bg_500' => 'bg-teal-500',
        ],
        'cyan' => [
            'bg' => 'bg-cyan-50',
            'border' => 'border-cyan-100',
            'hover_border' => 'hover:border-cyan-400',
            'text_900' => 'text-cyan-900',
            'text_800' => 'text-cyan-800',
            'bg_500' => 'bg-cyan-500',
        ],
        'pink' => [
            'bg' => 'bg-pink-50',
            'border' => 'border-pink-100',
            'hover_border' => 'hover:border-pink-400',
            'text_900' => 'text-pink-900',
            'text_800' => 'text-pink-800',
            'bg_500' => 'bg-pink-500',
        ],
        'purple' => [
            'bg' => 'bg-purple-50',
            'border' => 'border-purple-100',
            'hover_border' => 'hover:border-purple-400',
            'text_900' => 'text-purple-900',
            'text_800' => 'text-purple-800',
            'bg_500' => 'bg-purple-500',
        ],
        'sky' => [
            'bg' => 'bg-sky-50',
            'border' => 'border-sky-100',
            'hover_border' => 'hover:border-sky-400',
            'text_900' => 'text-sky-900',
            'text_800' => 'text-sky-800',
            'bg_500' => 'bg-sky-500',
        ],
        'yellow' => [
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-100',
            'hover_border' => 'hover:border-yellow-400',
            'text_900' => 'text-yellow-900',
            'text_800' => 'text-yellow-800',
            'bg_500' => 'bg-yellow-500',
        ],
        'lime' => [
            'bg' => 'bg-lime-50',
            'border' => 'border-lime-100',
            'hover_border' => 'hover:border-lime-400',
            'text_900' => 'text-lime-900',
            'text_800' => 'text-lime-800',
            'bg_500' => 'bg-lime-500',
        ],
    ];
    use Carbon\Carbon;
@endphp


@extends('layouts.dashboard')

@section('dashboard-content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/themes/light.css" />
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="/dashboard" separator="slash">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item separator="slash">Event</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <div class="flex justify-between w-full">
        <h1 class="font-medium text-xl">Your Events</h1>
        <flux:modal.trigger name="create-event">
            <flux:button variant="primary" icon="plus" class="cursor-pointer">New Event</flux:button>
        </flux:modal.trigger>
    </div>
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('success') }}" />
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <flux:callout variant="danger" icon="x-circle" heading="{{ $error }}" />
        @endforeach
    @endif
    <div class="gap-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @php
            $colorNames = array_keys($colorMaps);
        @endphp

        @forelse ($events as $event)
            @php
                $colorName = $colorNames[abs(crc32($event['id'])) % count($colorNames)];
                $c = $colorMaps[$colorName];
            @endphp
            <div
                class="flex flex-col gap-3 bg-zinc-100 p-4 border border-zinc-200 hover:border-blue-300 rounded-md h-56 overflow-hidden hover:scale-[1.02] transition-all duration-150 cursor-pointer">
                <div>
                    <flux:badge size="sm" icon="paper-clip" color="blue">{{ $event['status'] }}
                    </flux:badge>
                </div>
                <div class="flex items-center gap-2 bg-white px-3 py-2 border border-zinc-200 rounded-sm">
                    <flux:icon.tag class="size-5" />
                    <h2 class="font-medium text-md">{{ Str::limit($event->title, 20, '…') }}</h2>
                </div>
                <p class="mx-3 text-zinc-900 text-sm">{{ Str::limit($event->description, 95, '…') }}</p>
                <div class="flex flex-1 justify-end items-end gap-1">
                    <p class="text-zinc-600 text-sm">Manage</p>
                    <flux:icon.arrow-up-right class="size-5 text-zinc-800" />
                </div>
            </div>
        @empty
            <div class="flex flex-col justify-center items-center col-span-full py-12 text-center">
                <flux:icon.calendar class="mb-4 size-12 text-gray-400" />
                <p class="font-medium text-gray-600">No events yet</p>
                <p class="text-gray-500 text-sm">Create your first event to get started</p>
            </div>
        @endforelse
    </div>



    <flux:modal name="create-event" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create event</flux:heading>
                <flux:text class="mt-2">Fill details to create event</flux:text>
            </div>
            <form action="{{ route('event.create') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col gap-3">
                @csrf
                <flux:input label="Title" name="title" placeholder="Your event title" />
                <flux:textarea label="Description" name="description" placeholder="Your event description" />
                <flux:input.group label="Registration link">
                    <flux:input.group.prefix>eventable.id/</flux:input.group.prefix>
                    <flux:input name="slug" placeholder="your-event" />
                </flux:input.group>
                <div class="gap-2 grid grid-cols-1 md:grid-cols-2">
                    <flux:input label="Registration start" name="registration_start" type="date" class="flex-1" />

                    <flux:input label="Registration end" name="registration_end" type="date" class="flex-1" />
                </div>
                <flux:field>
                    <flux:label>Brand color (Base, Accent)</flux:label><br>
                    <sl-color-picker value="#ffffff" name="base_color" label="Select a color"></sl-color-picker>
                    <sl-color-picker value="#4a90e2" name="accent_color" label="Select a color"></sl-color-picker>
                </flux:field>
                <div class="gap-2 grid grid-cols-1 md:grid-cols-2">
                    <flux:input type="file" label="Cover" name="cover_url" badge="Optional"
                        accept="image/jpeg,image/png,image/webp" />
                    <flux:input type="file" label="Logo" name="logo_url" badge="Optional"
                        accept="image/jpeg,image/png,image/webp" />
                </div>
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary" class="cursor-pointer">Create</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <script type="module"
        src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/components/color-picker/color-picker.js">
    </script>
@endsection
