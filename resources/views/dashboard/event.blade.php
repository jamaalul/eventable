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
    <div class="gap-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($events as $event)
            <div
                class="flex flex-col gap-3 border border-zinc-200 hover:border-z-300 rounded-xl h-fit overflow-hidden transition-all duration-150">
                <div class="relative flex flex-col gap-1 p-3 border-zinc-200 border-b h-fit overflow-hidden"
                    style="background-color: {{ $event['accent_color'] }}33">
                    <h2 class="font-medium text-lg" style="color: {{ $event['accent_color'] }}">{{ $event['title'] }}</h2>
                    <div>
                        <flux:badge icon="information-circle" size="sm">{{ $event['status'] }}</flux:badge>
                    </div>
                    <div class="top-3 right-3 absolute">
                        <flux:tooltip content="Manage">
                            <flux:button href="{{ route('dashboard.event.details', ['slug' => $event->slug]) }}"
                                icon="ellipsis-horizontal" size="sm" variant="ghost" class="cursor-pointer">
                            </flux:button>
                        </flux:tooltip>
                    </div>
                </div>
                <div class="grid grid-cols-2 px-3 pt-2 pb-3">
                    <div>
                        <p class="mb-1 text-zinc-500 text-sm">Reg Close</p>
                        <p class="mb-5 font-medium text-sm">{{ $event['registration_end']->format('M d, Y') }}</p>
                        <p class="mb-1 text-zinc-500 text-sm">Max Capacity</p>
                        <p class="font-medium text-sm">NaN</p>
                    </div>
                    <div>
                        <p class="mb-1 text-zinc-500 text-sm">Event date</p>
                        <p class="mb-5 font-medium text-sm">NaD</p>
                        <p class="mb-1 text-zinc-500 text-sm">Reg Link</p>
                        <flux:button icon="link" size="xs" class="w-full cursor-pointer" variant="filled"
                            onclick="navigator.clipboard.writeText('{{ url('/') }}/{{ $event['slug'] }}'); Livewire.dispatch('toast', { message: 'Link copied to clipboard', variant: 'success' })">
                            Copy link
                        </flux:button>
                    </div>
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
                    <flux:input.group.prefix>atttract.com/</flux:input.group.prefix>
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
