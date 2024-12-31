<?php

use App\Livewire\Forms\CreateTodoForm;
use App\View\Components\AppLayout;
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.app');
form(CreateTodoForm::class);

$createTodo = function () {
    $this->validate();
    $this->form->createTodo();
};

?>


<x-slot name="title">{{ __('messages.create_todo') }}</x-slot>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('messages.create_todo') }}
    </h2>
</x-slot>

<div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg ">
        <form wire:submit="createTodo" method="POST">
            <div>
                <x-input-label for="title" :value="__('Title')"/>
                <x-text-input wire:model="form.title" id="title" class="block mt-1 w-full" type="text" name="title"
                              required autofocus/>
                <x-input-error :messages="$errors->get('form.title')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')"/>
                <x-textarea wire:model="form.description" id="description" class="block mt-1 w-full"
                            name="description"/>
                <x-input-error :messages="$errors->get('form.description')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">{{ __('Create') }}</x-primary-button>
            </div>
        </form>
    </div>
</div>

