<x-app-layout>
    <x-slot name="title">{{ __('messages.dashboard') }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.dashboard') }}
        </h2>
        <a
            class="{{<<<'CLASS'
            block rounded-md px-3 py-2 bg-indigo-500 dark:bg-indigo-700 text-white dark:text-gray-100
            hover:bg-indigo-600 active:scale-95 focus:outline focus:outline-2 focus:outline-indigo-500 dark:focus:outline-indigo-700
            transition-[color,background-color,transform] duration-150
            CLASS}}"
            href="{{route('create-todo', absolute: false)}}"
            wire:navigate
        >
            {{ __('messages.create_todo') }}
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 grid gap-6" x-on:todo-deleted="$refresh">
                @foreach (\App\Models\Todo::all() as $todo)
                    <livewire:todo-entry :todo="$todo"/>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
