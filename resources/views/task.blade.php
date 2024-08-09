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
    <div class="max-w-7xl mx-auto p-4 ">

        @if(request()->routeIs('create-task'))
            <livewire:task.create/>
        @elseif(request()->routeIs('task'))
            <div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Creator
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deadline
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$task->title}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$task->user->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->formatted_date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$task->status}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($task->user->is(auth()->user()))
                                            <x-dropdown>
                                                <x-slot name="trigger">
                                                    <button>
                                                        Options
                                                    </button>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown-link wire:click="edit({{ $task->id }})">
                                                        {{ __('Edit') }}
                                                    </x-dropdown-link>
                                                    <x-dropdown-link wire:click="delete({{ $task }})" wire:confirm="Are you sure to delete this chirp?">
                                                        {{ __('Delete') }}
                                                    </x-dropdown-link>
                                                </x-slot>
                                            </x-dropdown>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
            <div>{{$tasks->links()}}</div>

    </div>
</x-app-layout>
