<x-app-layout>
    <x-slot name="header" >
        <div class="flex">
            <div class="sm:ms-10">
                <x-nav-link :href="route('task')" :active="request()->routeIs('task')" wire:navigate>
                    <h2>{{ __('Tasks') }}</h2>
                </x-nav-link>
            </div>
            <div class="sm:ms-10">
                <x-nav-link :href="route('create-task')" :active="request()->routeIs('create-task')" wire:navigate>
                    <h2>{{ __('Task create') }}</h2>
                </x-nav-link>
            </div>
        </div>
    </x-slot>
    <div class="max-w-5xl mx-auto p-4 ">

        @if(request()->routeIs('create-task'))
            <livewire:task.create/>
        @elseif(request()->routeIs('task'))
            <livewire:task.view/>
        @endif


    </div>
</x-app-layout>
