<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }


    public function create()
    {
        Log::info('TaskController@create accessed!');

        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        auth()->user()->tasks()->create($data);

        return redirect()->route('tasks.index');
    }
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task->update($data);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
    public function toggleComplete(Task $task)
    {
        try {
            $task->is_completed = !$task->is_completed;
            $task->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }


    public function show($id)
    {
        $task = Task::findOrFail($id); // This will retrieve the task with the given ID or throw a 404 error if not found.

        return view('tasks.show', compact('task'));
    }

}
