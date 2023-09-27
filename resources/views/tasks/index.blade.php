@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Tasks</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>

    <ul class="list-group">
        @foreach($tasks ?? [] as $task)
        <li class="list-group-item">
            <strong>{{ $task->title }}</strong> (Due: {{ $task->due_date }})
            <div>{{ $task->description }}</div>
            <div class="mt-2">
                <form action="{{ route('tasks.toggleComplete', $task->id) }}" method="POST">
                    @csrf
                    <button
                        type="button"
                        id="toggleCompleteBtn{{ $task->id }}"
                        class="btn btn-primary"
                        data-completed="{{ $task->is_completed }}"
                        onclick="toggleTaskCompletion(event, {{ $task->id }})">
                        {{ $task->is_completed ? 'Mark as Uncompleted' : 'Mark as Completed' }}
                    </button>

                    <span id="taskStatus{{ $task->id }}">STATUS: {{ $task->is_completed ? 'COMPLETE' : 'INCOMPLETE' }}</span>
                </form>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info">Edit</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>

@endsection
<script>
    function toggleTaskCompletion(event, taskId) {
        event.preventDefault();

        let button = document.getElementById(`toggleCompleteBtn${taskId}`);
        let status = document.getElementById(`taskStatus${taskId}`); // Get the status element
        let isCompleted = button.getAttribute("data-completed") === "1";

        fetch(`/tasks/${taskId}/toggle-complete`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    let newStatus = isCompleted ? 'INCOMPLETE' : 'COMPLETE';
                    status.innerText = `STATUS: ${newStatus}`; // Change the status text

                    button.setAttribute("data-completed", isCompleted ? "0" : "1");
                    button.innerHTML = isCompleted ? 'Mark as Completed' : 'Mark as Uncompleted';
                }
            });
    }

</script>
