<?php

namespace App\Http\Controllers;

use App\Enums\TodoPriority;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    //fix api.todos make API_URL=http://localhost:8000/api in the env and in the config/services.php set 'url' => env('API_URL', 'http://localhost:8000/api'),
    public function index(Request $request)
    {
        $categoryId = $request->query('category_id');

        $todos = Http::withToken(session('api_token'))
            ->get(config('services.api.url') . '/todos', [
                'category_id' => $categoryId
            ])
            ->json();

        $categories = Http::withToken(session('api_token'))
            ->get(config('services.api.url') . '/categories')
            ->json();

        return view('todos.index', compact('todos', 'categories', 'categoryId'));
    }


    public function create()
    {
        $categories = Http::withToken(session('api_token'))
            ->get(config('services.api.url') . '/categories')
            ->json();


        return view('todos.create', compact('categories'));
    }


    public function store(Request $request)
    {
        Http::withToken(session('api_token'))
            ->post(config('services.api.url') . '/todos', $request->all());


        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo created successfully!');
    }

    public function toggle($id)
    {
        Http::withToken(session('api_token'))
            ->patch(config('services.api.url') . "/todos/{$id}/toggle");


        return redirect()->back();
    }


    public function destroy($id)
    {

        Http::withToken(session('api_token'))
            ->delete(config('services.api.url') . "/todos/{$id}");


        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo deleted');
    }

    public function edit($id)
    {
        $todo = Http::withToken(session('api_token'))
            ->get(config('services.api.url') . "/todos/{$id}")
            ->json();


        abort_if(!$todo, 404);


        $categories = Http::withToken(session('api_token'))
            ->get(config('services.api.url') . '/categories')
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
            ->put(config('services.api.url') . "/todos/{$id}", $request->all());


        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo updated successfully!');
    }
}


