<?php
$title = 'Todos';
?>

<x-app-layout>
    <h1>Todos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Створити ToDo</a>

    <table class="table">
        <thead>
        <tr>
            <th>Заголовок</th>
            <th>Опис</th>
            <th>Статус</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($todos as $todo)
            <tr>
                <td>{{ $todo->getTitle() }}</td>
                <td>{{ $todo->getDescription() }}</td>
                <td>
                    {{ $todo->getStatus()->$value }}
                </td>
                <td>
                    <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-warning">Редагувати</a>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Ви впевнені?')">
                            Видалити
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
