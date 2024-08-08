<?php

use Livewire\Volt\Component;

new class extends Component {

    public string $title = '';
    public string $deadline = '';
    public string $description = '';

    public function create()
    {
        $validateData = $this->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'required|date',
            'description' => 'nullable|string',
        ]);

        auth()->user()->tasks()->create($validateData);

        return redirect()->route('task');
    }
}; ?>
<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div>
        <form wire:submit.prevent="create" class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase dark:text-gray-300 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight"
                        id="title" type="text" placeholder="Title" wire:model="title"> <!-- Use wire:model -->
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase dark:text-gray-300 text-sm font-bold mb-2" for="deadline">Due date</label>
                    <input
                        class="appearance-none block w-full bg-white text-gray-700 border border-black rounded py-3 px-4 mb-3 leading-tight"
                        type="date" name="deadline" id="deadline" wire:model="deadline"> <!-- Use wire:model -->
                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                </div>
            </div>
            <div class="mb-4">
                <label class="block uppercase dark:text-gray-300 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="description" id="description" wire:model="description"></textarea> <!-- Use wire:model -->
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
        </form>
    </div>
</div>
