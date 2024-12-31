<?php

namespace App\Http\Controllers;

use App\Models\Enum\TodoStatus;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TodoController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        $statuses = TodoStatus::cases();
        return view('todos.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            Todo::TITLE => 'required|max:255',
            Todo::DESCRIPTION => 'nullable|max:1023',
            Todo::STATUS => 'nullable|in:' . implode(',', array_column(TodoStatus::cases(), 'value'))
        ]);

        Todo::create([
            Todo::USER_ID => Auth::id(),
            Todo::TITLE => $validated['title'],
            Todo::DESCRIPTION => $validated['description'] ?? null,
            Todo::STATUS => TodoStatus::tryFrom($validated[Todo::STATUS]) ?? TodoStatus::Pending,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo created successfully');
    }

    public function show(Todo $todo): View
    {
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo): View
    {
        $statuses = TodoStatus::cases();
        return view('todos.edit', compact('todo', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            Todo::TITLE => 'required|max:255',
            Todo::DESCRIPTION => 'nullable|max:1024',
            Todo::STATUS => 'in:' . implode(',', array_column(TodoStatus::cases(), 'value'))
        ]);

        $todo->update([
            Todo::TITLE => $validated['title'],
            Todo::DESCRIPTION => $validated['description'] ?? null,
            Todo::STATUS => TodoStatus::from($validated['status'])
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully.');
    }
}
