<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index(): JsonResponse
    {
        $tasks = Task::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($tasks);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['nullable', 'string', 'in:Faible,Moyenne,Élevée'],
            'status' => ['nullable', 'string', 'in:À faire,Terminée'],
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'priority' => $validated['priority'] ?? 'Élevée',
            'status' => $validated['status'] ?? 'À faire',
        ]);

        return response()->json($task, 201);
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json($task);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['sometimes', 'string', 'in:Faible,Moyenne,Élevée'],
            'status' => ['sometimes', 'string', 'in:À faire,Terminée'],
        ]);

        $task->update($validated);

        return response()->json($task->fresh());
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(['message' => 'Tâche supprimée avec succès.']);
    }
}
