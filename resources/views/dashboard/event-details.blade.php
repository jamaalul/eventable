@extends('layouts.dashboard')

@section('dashboard-content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/themes/light.css" />
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard.overview') }}" separator="slash">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('dashboard.event') }}" separator="slash">Event</flux:breadcrumbs.item>
        <flux:breadcrumbs.item separator="slash">{{ $event->title }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('success') }}" />
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <flux:callout variant="danger" icon="x-circle" heading="{{ $error }}" />
        @endforeach
    @endif
    <h1 class="font-medium text-xl">Manage {{ $event->title }}</h1>
    <div class="flex gap-5">
        <div class="flex flex-col flex-1 gap-4">
            <flux:separator />
            <h2 class="font-medium text-lg">Event Details</h2>
            <form action="{{ route('event.update', $event->slug) }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col gap-3">
                @csrf
                <flux:input readonly variant="filled" value="{{ $event->title }}" label="Title" name="title"
                    placeholder="Your event title" />
                <flux:textarea label="Description" name="description" placeholder="Your event description">
                    {{ $event->description }}</flux:textarea>
                <flux:input.group label="Registration link">
                    <flux:input.group.prefix>eventable.id/</flux:input.group.prefix>
                    <flux:input readonly variant="filled" value="{{ $event->slug }}" name="slug"
                        placeholder="your-event" />
                </flux:input.group>
                <div class="gap-2 grid grid-cols-1 md:grid-cols-2">
                    <flux:input value="{{ $event->registration_start?->format('Y-m-d') }}" label="Registration start"
                        name="registration_start" type="date" class="flex-1" />

                    <flux:input value="{{ $event->registration_end?->format('Y-m-d') }}" label="Registration end"
                        name="registration_end" type="date" class="flex-1" />
                </div>
                <flux:field>
                    <flux:label>Brand color (Base, Accent)</flux:label><br>
                    <sl-color-picker value="{{ $event->base_color }}" name="base_color"
                        label="Select a color"></sl-color-picker>
                    <sl-color-picker value="{{ $event->accent_color }}" name="accent_color"
                        label="Select a color"></sl-color-picker>
                </flux:field>
                <div class="gap-2 grid grid-cols-1 md:grid-cols-2">
                    <flux:input type="file" label="Cover" name="cover_url" badge="Optional"
                        accept="image/jpeg,image/png,image/webp" />
                    <flux:input type="file" label="Logo" name="logo_url" badge="Optional"
                        accept="image/jpeg,image/png,image/webp" />
                </div>
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" icon="circle-fading-arrow-up" variant="primary" class="cursor-pointer">
                        Update</flux:button>
                </div>
            </form>
            <flux:separator />
            <h2 class="font-medium text-lg">Registration Form Fields</h2>
            @foreach ($fields as $field)
                <div class="flex flex-col gap-2 bg-zinc-50 p-4 border border-zinc-200 rounded-lg">
                    <div class="flex gap-2 w-full">
                        <div class="flex-1">
                            <flux:input readonly value="{{ $field['label'] }}" label="Label" class="flex-1" />
                        </div>
                        <flux:input readonly
                            value="{{ match ($field['type']) {'text' => 'Short answer','textarea' => 'Paragraph','radio' => 'Multiple choices','checkbox' => 'Checkboxes',default => $field['type']} }}"
                            label="Type" />
                    </div>
                    @if (in_array($field['type'], ['radio', 'checkbox']))
                        <flux:separator />
                        <flux:label>Options</flux:label>
                        @foreach ($field['options'] ?? [] as $option)
                            <div class="flex gap-1 text-zinc-800 text-sm">
                                <flux:icon.ellipsis-vertical />
                                <p>{{ $option }}</p>
                            </div>
                        @endforeach
                    @endif
                    <flux:separator />
                    <div class="flex justify-between items-end">
                        <div class="flex gap-1 w-full h-fit">
                            @if ($field['is_required'])
                                <flux:badge size="sm" color="red">Required</flux:badge>
                            @else
                                <flux:badge size="sm">Optional</flux:badge>
                            @endif
                        </div>
                        <div class="flex gap-1">
                            @if ($field['is_mandatory'] == 0)
                                <flux:modal.trigger name="edit-field-{{ $field->id }}">
                                    <flux:button class="cursor-pointer" variant="ghost" icon:trailing="pencil-square"
                                        size="sm">
                                        Edit
                                    </flux:button>
                                </flux:modal.trigger>
                                <flux:modal.trigger name="delete-field-{{ $field->id }}">
                                    <flux:button variant="ghost" size="sm" icon:trailing="trash"
                                        class="cursor-pointer">
                                        Delete
                                    </flux:button>
                                </flux:modal.trigger>

                                <flux:modal name="delete-field-{{ $field->id }}" class="min-w-88 max-w-100">
                                    <div class="space-y-6">
                                        <div>
                                            <flux:heading size="lg">Delete Field?</flux:heading>
                                            <flux:text class="mt-2">Are you sure you want to delete this field? This
                                                action
                                                cannot be undone.</flux:text>
                                        </div>
                                        <div class="flex gap-2">
                                            <flux:spacer />
                                            <flux:modal.close>
                                                <flux:button variant="ghost" class="cursor-pointer">Cancel</flux:button>
                                            </flux:modal.close>
                                            <form action="{{ route('event.fields.destroy', [$event->slug, $field->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <flux:button type="submit" variant="danger" class="cursor-pointer">
                                                    Delete
                                                    Field</flux:button>
                                            </form>
                                        </div>
                                    </div>
                                </flux:modal>
                            @else
                                <flux:badge size="sm" color="blue">Mandatory field</flux:badge>
                            @endif
                        </div>

                        <flux:modal name="edit-field-{{ $field->id }}" class="md:w-full" x-data="editFieldModal({{ json_encode($field) }})">
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">Edit Field</flux:heading>
                                    <flux:text class="mt-2">Update registration form field.</flux:text>
                                </div>
                                <form action="{{ route('event.fields.update', [$event->slug, $field->id]) }}"
                                    method="POST" class="flex flex-col gap-4" @submit.prevent="prepareSubmit">
                                    @csrf
                                    <input type="hidden" name="options_json" x-ref="optionsJson">

                                    <div class="flex gap-2">
                                        <div class="flex-1">
                                            <flux:input x-model="label" label="Label" name="label" class="w-full"
                                                placeholder="Question" />
                                        </div>

                                        <flux:select x-model="type" label="Type" name="type"
                                            class="cursor-pointer">
                                            <flux:select.option value="text">Short answer</flux:select.option>
                                            <flux:select.option value="textarea">Paragraph</flux:select.option>
                                            <flux:select.option value="radio">Multiple choices</flux:select.option>
                                            <flux:select.option value="checkbox">Checkboxes</flux:select.option>
                                        </flux:select>
                                    </div>

                                    <!-- Options container -->
                                    <div x-show="type === 'radio' || type === 'checkbox'" class="flex flex-col space-y-2">
                                        <flux:label>Options</flux:label>
                                        <template x-for="(option, index) in options" :key="index">
                                            <div class="flex items-center gap-2">
                                                <input type="text" x-model="options[index]"
                                                    class="px-3 py-2 border-zinc-200 border-b w-full text-sm"
                                                    placeholder="Option value" />
                                                <button type="button" @click="removeOption(index)"
                                                    class="text-red-500 hover:text-red-600 cursor-pointer">
                                                    <flux:icon.x-mark class="size-4" />
                                                </button>
                                            </div>
                                        </template>
                                        <div>
                                            <flux:button type="button" @click="addOption" variant="ghost"
                                                size="sm">
                                                <flux:icon.plus class="size-3" /> Add Option
                                            </flux:button>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4 mt-2">
                                        <flux:switch name="is_required" class="cursor-pointer" x-model="is_required"
                                            label="Required" />
                                        <flux:spacer />
                                        <flux:button type="submit" class="cursor-pointer" variant="primary"
                                            icon="save">Save Changes
                                        </flux:button>
                                    </div>
                                </form>
                            </div>
                        </flux:modal>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-end">
                <flux:modal.trigger name="add-field">
                    <flux:button variant="primary" class="cursor-pointer" icon="plus">Add field</flux:button>
                </flux:modal.trigger>
            </div>




            <flux:modal name="add-field" class="md:w-full" x-data="addFieldModal()">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Add Field</flux:heading>
                        <flux:text class="mt-2">Create a new registration form field.</flux:text>
                    </div>
                    <form action="{{ route('event.fields.store', $event->slug) }}" method="POST"
                        class="flex flex-col gap-4" @submit.prevent="prepareSubmit">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="options_json" x-ref="optionsJson">

                        <div class="flex gap-2">
                            <div class="flex-1">
                                <flux:input x-model="label" label="Label" name="label" class="w-full"
                                    placeholder="Question" />
                            </div>

                            <flux:select x-model="type" label="Type" name="type" class="cursor-pointer">
                                <flux:select.option value="text">Short answer</flux:select.option>
                                <flux:select.option value="textarea">Paragraph</flux:select.option>
                                <flux:select.option value="radio">Multiple choices</flux:select.option>
                                <flux:select.option value="checkbox">Checkboxes</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Options container -->
                        <div x-show="type === 'radio' || type === 'checkbox'" class="flex flex-col space-y-2">
                            <flux:label>Options</flux:label>
                            <template x-for="(option, index) in options" :key="index">
                                <div class="flex items-center gap-2">
                                    <input type="text" x-model="options[index]"
                                        class="px-3 py-2 border-zinc-200 border-b w-full text-sm"
                                        placeholder="Option value" />
                                    <button type="button" @click="removeOption(index)"
                                        class="text-red-500 hover:text-red-600 cursor-pointer">
                                        <flux:icon.x-mark class="size-4" />
                                    </button>
                                </div>
                            </template>
                            <div>
                                <flux:button type="button" @click="addOption" variant="ghost" size="sm">
                                    <flux:icon.plus class="size-3" /> Add Option
                                </flux:button>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-2">
                            <flux:switch name="is_required" class="cursor-pointer" x-model="is_required"
                                label="Required" />
                            <flux:spacer />
                            <flux:button type="submit" class="cursor-pointer" variant="primary" icon="plus">Add
                            </flux:button>
                        </div>
                    </form>
                </div>

                <script>
                    function addFieldModal() {
                        return {
                            label: '',
                            type: 'text',
                            options: [],
                            is_required: true,

                            addOption() {
                                this.options.push('');
                            },

                            removeOption(index) {
                                this.options.splice(index, 1);
                            },

                            prepareSubmit(event) {
                                // Convert options array to JSON and store in hidden input
                                this.$refs.optionsJson.value = JSON.stringify(this.options.filter(o => o.trim() !== ''));
                                event.target.submit();
                            }
                        }
                    }

                    function editFieldModal(field) {
                        return {
                            label: field.label,
                            type: field.type,
                            options: Array.isArray(field.options) ? [...field.options] : [],
                            is_required: !!field.is_required,

                            addOption() {
                                this.options.push('');
                            },

                            removeOption(index) {
                                this.options.splice(index, 1);
                            },

                            prepareSubmit(event) {
                                // Convert options array to JSON and store in hidden input
                                this.$refs.optionsJson.value = JSON.stringify(this.options.filter(o => o.trim() !== ''));
                                event.target.submit();
                            }
                        }
                    }
                </script>
            </flux:modal>
        </div>


        {{-- phone mockup --}}
        <div class="h-[75vh] aspect-9/19">
            <div class="flex justify-start items-center space-x-1.5 bg-gray-200 px-3 rounded-t-lg w-full h-8">
                <span class="bg-red-400 rounded-full size-2"></span>
                <span class="bg-yellow-400 rounded-full size-2"></span>
                <span class="bg-green-400 rounded-full size-2"></span>
            </div>
            <div class="bg-gray-100 border-t-0 rounded-b-lg w-full h-[72vh]">
                <iframe src="{{ url('/') }}/{{ $event['slug'] }}" frameborder="0"
                    class="w-full h-full overflow-x-hidden"></iframe>
            </div>
        </div>
    </div>

    <script type="module"
        src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/components/color-picker/color-picker.js">
    </script>
@endsection
