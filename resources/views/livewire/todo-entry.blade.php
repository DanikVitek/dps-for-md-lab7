<div class="p-4 rounded-md bg-gray-100 dark:bg-gray-800 shadow-md mb-4">
    <div class="flex items-center justify-between">
        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-100">
            {{ $todo->getTitle() }}
        </h3>
        <button wire:click="delete" class="rounded-md px-2 py-1 text-xs text-red-500 hover:text-red-100 hover:bg-red-500">
            Delete
        </button>
    </div>
    <p class="text-sm text-gray-600 dark:text-gray-400">
        {{ $todo->getDescription() }}
    </p>

    <div class="mt-4 flex items-center justify-between">
        <div>
               <span class="text-xs font-medium px-2 py-1 rounded-full
                   @switch($todo->getStatus()->value)
                        @case('completed') bg-green-500 text-white @break
                        @case('in_progress') bg-yellow-500 text-white @break
                        @default bg-red-500 text-white
                   @endswitch"
               >
                   {{ ucfirst(str_replace('_', ' ', $todo->getStatus()->value)) }}
               </span>
        </div>

        <div class="flex space-x-2">
            <button wire:click="updateStatus('pending')"
                    class="text-xs px-3 py-1 rounded-md bg-red-500 text-white hover:bg-red-400
                    @if ($todo->getStatus()->value === 'pending') opacity-50 @endif"
                    @if ($todo->getStatus()->value === 'pending') disabled @endif>
                Pending
            </button>

            <button wire:click="updateStatus('in_progress')"
                    class="text-xs px-3 py-1 rounded-md bg-yellow-500 text-white hover:bg-yellow-400
                    @if ($todo->getStatus()->value === 'in_progress') opacity-50 @endif"
                    @if ($todo->getStatus()->value === 'in_progress') disabled @endif>
                In Progress
            </button>

            <button wire:click="updateStatus('completed')"
                    class="text-xs px-3 py-1 rounded-md bg-green-500 text-white hover:bg-green-400
                    @if ($todo->getStatus()->value === 'completed') opacity-50 @endif"
                    @if ($todo->getStatus()->value === 'completed') disabled @endif>
                Completed
            </button>
        </div>
    </div>
</div>
