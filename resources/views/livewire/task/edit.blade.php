<?php

use App\Models\Task;
use Livewire\Volt\Component;

new class extends Component {
    public Task $task;
    public string $title = '';
    public string $deadline = '';

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->title = $task->title;
        $this->deadline = $task->default_date;
    }

    public function update()
    {
        $this->authorize('update', $this->task);

        $validateData = $this->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        $this->task->update($validateData);

        $this->dispatch('task-updated');
    }

    public function cancel()
    {
        $this->dispatch('task-edit-canceled');
    }
}; ?>

<tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
    <th scope="row" class="px-6 py-4 font-medium text-black-900 whitespace-nowrap dark:text-white">
        <input class="dark:text-gray-300 rounded dark:bg-gray-700" type="text" name="" id="" wire:model="title">
    </th>
    <td class="px-6 py-4">
        {{$task->user->name}}
    </td>
    <td class="px-6 py-4">
        <input class="dark:text-gray-300 rounded dark:bg-gray-700" type="date" name="" id="" wire:model="deadline">

    </td>
    <td class="px-6 py-4">
        {{$task->status}}
    </td>
    @if($task->user->is(auth()->user()))
        <td class="px-6 py-4">
            <x-primary-button wire:click="update" >Update</x-primary-button>
            <x-primary-button  wire:click="cancel">Cancel</x-primary-button>
        </td>
    @endif
</tr>

