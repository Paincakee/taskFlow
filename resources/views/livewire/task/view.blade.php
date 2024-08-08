<?php

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public $tasks;
    public $editing;

    public function mount(): void
    {
        $this->tasks = collect(); // Initialize as an empty collection
        $this->getTasks(); // Fetch tasks
    }

    public function getTasks(): void
    {
        $this->tasks = Task::latest()->get();
    }

    public function edit(Task $task): void
    {
        $this->editing = $task;

        $this->getTasks();
    }

    #[On('task-edit-canceled')]
    #[On('task-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getTasks();
    }

    public function delete(Task $task): void
    {
        $this->authorize('delete', $task);

        $task->delete();

        $this->getTasks();
    }
}; ?>

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
                @if($task->is($editing))
                    <livewire:task.edit :task="$task" :key="$task->id"/>
                @else
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
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
