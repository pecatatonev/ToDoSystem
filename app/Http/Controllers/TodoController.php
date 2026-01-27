<?php

namespace App\Http\Controllers;

use App\Enums\TodoPriority;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    // public function index(Request $request)
    // {
    //     $todos = Todo::with('category')
    //         ->where('user_id', auth()->id())
    //         ->when(
    //             $request->category_id,
    //             fn($q) =>
    //             $q->where('category_id', $request->category_id)
    //         )
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return view('todos.index')->with('todos', $todos);
    //     return response()->json($todos);
    // }

    // public function create()
    // {
    //     $categories = Category::orderBy('name')
    //         ->get();

    //     return view('todos.create')->with('categories', $categories);
    // }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'priority' => 'required|in:low,medium,high',
    //         'category_id' => 'required|exists:categories,id',
    //     ]);


    //     $todo = auth()->user()->todos()->create([
    //         'title' => $data['title'],
    //         'description' => $data['description'],
    //         'priority' => TodoPriority::from($data['priority']),
    //         'category_id' => $data['category_id'],
    //     ]);
    //     return redirect()->route('todos.index');
    //     return response()->json($todo, 201);
    // }

    // public function toggle(Todo $todo)
    // {
    //     abort_if($todo->user_id !== auth()->id(), 403);


    //     $todo->update([
    //         'is_completed' => !$todo->is_completed
    //     ]);


    //     return response()->json($todo);
    // }

    // public function destroy(Todo $todo)
    // {
    //     abort_if($todo->user_id !== auth()->id(), 403);


    //     $todo->delete();


    //     return response()->json(['message' => 'Todo deleted']);
    // }
//fix api.todos make API_URL=http://localhost:8000/api in the env and in the config/services.php set 'url' => env('API_URL', 'http://localhost:8000/api'),
    public function index(Request $request)
    {
        $todos = Http::withToken(session('api_token'))
            ->get(config('app.url') . '/api/todos', [
                'category_id' => $request->category_id
            ])
            ->json();


        return view('todos.index', compact('todos'));
    }


    public function create()
    {
        $categories = Http::withToken(session('api_token'))
            ->get(config('app.url') . '/api/categories')
            ->json();


        return view('todos.create', compact('categories'));
    }


    public function store(Request $request)
    {
        Http::withToken(session('api_token'))
            ->post(config('app.url') . '/api/todos', $request->all());


        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo created successfully!');
    }

    public function toggle($id)
    {
        Http::withToken(session('api_token'))
            ->patch(config('app.url') . "/api/todos/{$id}/toggle");


        return redirect()->back();
    }


    public function destroy($id)
    {

        Http::withToken(session('api_token'))
            ->delete(config('app.url') . "/api/todos/{$id}");


        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo deleted');
    }

    public function edit($id)
    {
        $todo = Http::withToken(session('api_token'))
            ->get(config('app.url') . "/api/todos/{$id}")
            ->json();


        abort_if(!$todo, 404);


        $categories = Http::withToken(session('api_token'))
            ->get(config('app.url') . '/api/categories')
            ->json();


        return view('todos.edit', compact('todo', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
        ]);


        Http::withToken(session('api_token'))
            ->put(config('app.url') . "/api/todos/{$id}", $request->all());


        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo updated successfully!');
    }
}


