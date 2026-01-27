<?php

namespace App\Http\Controllers\Api;

use App\Enums\TodoPriority;
use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = Todo::with('category')
            ->where('user_id', $request->user()->id)
            ->when(
                $request->category_id,
                fn($q) =>
                $q->where('category_id', $request->category_id)
            )
            ->latest()
            ->get();

        return response()->json($todos);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
        ]);


        $todo = $request->user()->todos()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => TodoPriority::from($data['priority']),
            'category_id' => $data['category_id'],
        ]);

        return response()->json($todo, 201);
    }

    public function show(Request $request, Todo $todo)
    {
        abort_if($todo->user_id !== $request->user()->id, 403);


        return response()->json($todo->load('category'));
    }

    public function update(Request $request, Todo $todo)
    {
        abort_if($todo->user_id !== $request->user()->id, 403);


        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'sometimes|in:low,medium,high',
            'category_id' => 'sometimes|exists:categories,id',
        ]);


        if (isset($data['priority'])) {
            $data['priority'] = TodoPriority::from($data['priority']);
        }


        $todo->update($data);


        return response()->json($todo);
    }


    public function toggle(Request $request, Todo $todo)
    {
        abort_if($todo->user_id !== $request->user()->id, 403);


        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);


        return response()->json($todo);
    }


    public function destroy(Request $request, Todo $todo)
    {
        abort_if($todo->user_id !== $request->user()->id, 403);


        $todo->delete();


        return response()->json(['message' => 'Todo deleted']);
    }
}
