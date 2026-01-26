@extends('layouts.dashboard')

@section('dashboard-content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/themes/light.css" />
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard.overview') }}" separator="slash">Dashboard</flux:breadcrumbs.item>
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
        @forelse ($events as $event)
            <div onclick="window.location.href = '{{ route('dashboard.event.details', ['slug' => $event->slug]) }}'"
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
                    <flux:icon.arrow-up-right class="size-4 text-zinc-800" />
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
