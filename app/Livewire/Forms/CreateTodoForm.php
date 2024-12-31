<?php

namespace App\Livewire\Forms;

use App\Models\Enum\TodoStatus;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateTodoForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('string|nullable|max:1023')]
    public ?string $description = null;

    #[Validate('string|nullable|in:pending,in_progress,completed')]
    public ?string $status = null;

    public function createTodo()
    {
        Todo::create([
            Todo::USER_ID => Auth::id(),
            Todo::TITLE => $this->title,
            Todo::DESCRIPTION => $this->description,
            Todo::STATUS => TodoStatus::tryFrom($this->status) ?? TodoStatus::Pending,
        ]);

        return redirect()->route('dashboard')->with('success', 'Todo created successfully');
    }
}
