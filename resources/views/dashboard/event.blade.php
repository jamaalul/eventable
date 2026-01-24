<?php
$events = [
    [
        'id' => 1,
        'title' => 'Curhatalks 3.0',
        'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam placeat voluptatibus, consequatur odio quisquam consequuntur?',
        'start' => '2024-01-15 10:00:00',
    ],
    [
        'id' => 2,
        'title' => 'Curhatalks 3.0',
        'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam placeat voluptatibus, consequatur odio quisquam consequuntur?',
        'start' => '2024-01-15 10:00:00',
    ],
    [
        'id' => 3,
        'title' => 'Curhatalks 3.0',
        'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam placeat voluptatibus, consequatur odio quisquam consequuntur?',
        'start' => '2024-01-15 10:00:00',
    ],
    [
        'id' => 4,
        'title' => 'Curhatalks 3.0',
        'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam placeat voluptatibus, consequatur odio quisquam consequuntur?',
        'start' => '2024-01-15 10:00:00',
    ],
    [
        'id' => 5,
        'title' => 'Curhatalks 3.0',
        'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam placeat voluptatibus, consequatur odio quisquam consequuntur?',
        'start' => '2024-01-15 10:00:00',
    ],
    [
        'id' => 6,
        'title' => 'Curhatalks 3.0',
        'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam placeat voluptatibus, consequatur odio quisquam consequuntur?',
        'start' => '2024-01-15 10:00:00',
    ],
    [
        'id' => 7,
        'title' => 'Curhatalks 3.0',
        'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam placeat voluptatibus, consequatur odio quisquam consequuntur?',
        'start' => '2024-01-15 10:00:00',
    ],
];

$colorMaps = [
    'blue' => [
        'bg' => 'bg-blue-50',
        'border' => 'border-blue-200',
        'hover_border' => 'hover:border-blue-600',
        'text_900' => 'text-blue-900',
        'text_800' => 'text-blue-800',
        'bg_500' => 'bg-blue-500',
    ],
    'emerald' => [
        'bg' => 'bg-emerald-50',
        'border' => 'border-emerald-200',
        'hover_border' => 'hover:border-emerald-600',
        'text_900' => 'text-emerald-900',
        'text_800' => 'text-emerald-800',
        'bg_500' => 'bg-emerald-500',
    ],
    'violet' => [
        'bg' => 'bg-violet-50',
        'border' => 'border-violet-200',
        'hover_border' => 'hover:border-violet-600',
        'text_900' => 'text-violet-900',
        'text_800' => 'text-violet-800',
        'bg_500' => 'bg-violet-500',
    ],
    'amber' => [
        'bg' => 'bg-amber-50',
        'border' => 'border-amber-200',
        'hover_border' => 'hover:border-amber-600',
        'text_900' => 'text-amber-900',
        'text_800' => 'text-amber-800',
        'bg_500' => 'bg-amber-500',
    ],
    'indigo' => [
        'bg' => 'bg-indigo-50',
        'border' => 'border-indigo-200',
        'hover_border' => 'hover:border-indigo-600',
        'text_900' => 'text-indigo-900',
        'text_800' => 'text-indigo-800',
        'bg_500' => 'bg-indigo-500',
    ],
    'teal' => [
        'bg' => 'bg-teal-50',
        'border' => 'border-teal-200',
        'hover_border' => 'hover:border-teal-600',
        'text_900' => 'text-teal-900',
        'text_800' => 'text-teal-800',
        'bg_500' => 'bg-teal-500',
    ],
    'cyan' => [
        'bg' => 'bg-cyan-50',
        'border' => 'border-cyan-200',
        'hover_border' => 'hover:border-cyan-600',
        'text_900' => 'text-cyan-900',
        'text_800' => 'text-cyan-800',
        'bg_500' => 'bg-cyan-500',
    ],
    'pink' => [
        'bg' => 'bg-pink-50',
        'border' => 'border-pink-200',
        'hover_border' => 'hover:border-pink-600',
        'text_900' => 'text-pink-900',
        'text_800' => 'text-pink-800',
        'bg_500' => 'bg-pink-500',
    ],
    'purple' => [
        'bg' => 'bg-purple-50',
        'border' => 'border-purple-200',
        'hover_border' => 'hover:border-purple-600',
        'text_900' => 'text-purple-900',
        'text_800' => 'text-purple-800',
        'bg_500' => 'bg-purple-500',
    ],
    'sky' => [
        'bg' => 'bg-sky-50',
        'border' => 'border-sky-200',
        'hover_border' => 'hover:border-sky-600',
        'text_900' => 'text-sky-900',
        'text_800' => 'text-sky-800',
        'bg_500' => 'bg-sky-500',
    ],
    'yellow' => [
        'bg' => 'bg-yellow-50',
        'border' => 'border-yellow-200',
        'hover_border' => 'hover:border-yellow-600',
        'text_900' => 'text-yellow-900',
        'text_800' => 'text-yellow-800',
        'bg_500' => 'bg-yellow-500',
    ],
    'lime' => [
        'bg' => 'bg-lime-50',
        'border' => 'border-lime-200',
        'hover_border' => 'hover:border-lime-600',
        'text_900' => 'text-lime-900',
        'text_800' => 'text-lime-800',
        'bg_500' => 'bg-lime-500',
    ],
];
use Carbon\Carbon;
?>


@extends('layouts.dashboard')

@section('dashboard-content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/themes/light.css" />
    <div class="flex justify-between w-full">
        <h1 class="font-medium text-xl">Your Events</h1>
        <flux:modal.trigger name="create-event">
            <flux:button variant="primary" icon="plus" class="cursor-pointer">New Event</flux:button>
        </flux:modal.trigger>
    </div>
    <div class="gap-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @php
            $colorNames = array_keys($colorMaps);
        @endphp

        @foreach ($events as $event)
            @php
                $colorName = $colorNames[abs(crc32($event['id'])) % count($colorNames)];
                $c = $colorMaps[$colorName];
            @endphp
            <div
                class="flex flex-col gap-2 {{ $c['bg'] }} h-50 overflow-hidden p-4 border {{ $c['border'] }} {{ $c['hover_border'] }} rounded-md hover:scale-[1.02] transition-all duration-150 cursor-pointer">
                <div class="flex justify-between">
                    <p class="mx-3 font-medium {{ $c['text_900'] }} text-sm">
                        {{ Carbon::parse($event['start'])->translatedFormat('d F Y') }}
                    </p>
                    <flux:icon.arrow-up-right class="size-5 {{ $c['text_800'] }}" />
                </div>
                <div class="flex items-center gap-2 {{ $c['bg_500'] }} px-3 py-2 rounded-sm">
                    <flux:icon.tag class="size-5 text-white" />
                    <h2 class="font-medium text-md text-white">{{ $event['title'] }}</h2>
                </div>
                <p class="mx-3 {{ $c['text_900'] }} text-sm">{{ Str::limit($event['description'], 100, '…') }}</p>
            </div>
        @endforeach
    </div>



    <flux:modal name="create-event" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create event</flux:heading>
                <flux:text class="mt-2">Fill details to create event</flux:text>
            </div>
            <flux:input label="Title" placeholder="Your event title" />
            <flux:input.group label="Registration link">
                <flux:input.group.prefix>eventable.id/</flux:input.group.prefix>
                <flux:input placeholder="your-event" />
            </flux:input.group>
            <flux:textarea label="Description" placeholder="Your event description" />
            <div class="gap-2 grid grid-cols-1 md:grid-cols-2">
                <flux:input label="Registration start" type="date" class="flex-1" />

                <flux:input label="Registration end" type="date" class="flex-1" />
            </div>
            <flux:field>
                <flux:label>Brand color (Primary, Secondary, Base)</flux:label><br>
                <sl-color-picker value="#4a90e2" label="Select a color"></sl-color-picker>
                <sl-color-picker value="#4a90e2" label="Select a color"></sl-color-picker>
                <sl-color-picker value="#ffffff" label="Select a color"></sl-color-picker>
            </flux:field>
            <div class="gap-2 grid grid-cols-1 md:grid-cols-2">
                <flux:input type="file" label="Logo" badge="Optional" />
                <flux:input type="file" label="Cover" badge="Optional" />
            </div>
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <script type="module"
        src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/components/color-picker/color-picker.js">
    </script>
@endsection
