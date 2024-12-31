<?php

namespace App\Livewire;

use App\Models\Enum\TodoStatus;
use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TodoEntry extends Component
{
    // Event for responding to changes, e.g., status updates.
    protected $listeners = ['updated' => '$refresh'];

    public Todo $todo;

    public function updateStatus(string $strStatus): void
    {
        $status = TodoStatus::tryFrom($strStatus);
        if (is_null($status)) {
            return;
        }

        $this->todo->update(compact('status'));
        $this->dispatch('updated')->self();
    }

    public function delete()
    {
        if ($this->todo->delete()) {
            return redirect(route('dashboard'));
        }
        return null;
    }

    public function render(): View
    {
        return view('livewire.todo-entry', [
            'todo' => $this->todo,
        ]);
    }
}
